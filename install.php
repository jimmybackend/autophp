<?php
declare(strict_types=1);

/**
 * AutoPHP CLI installer (repository checkout -> new directory).
 * Does not execute the legacy application or connect to MySQL.
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("CLI only\n");
}

function failInstall(string $message, int $status = 1): void
{
    fwrite(STDERR, "ERROR: {$message}\n");
    exit($status);
}

function usage(): void
{
    echo "AutoPHP CLI installer\n";
    echo "  php install.php --check\n";
    echo "  php install.php --target=/absolute/path [--dry-run]\n";
    echo "The target directory must not exist. No existing files are overwritten.\n";
}

$options = getopt('', ['help', 'check', 'target:', 'dry-run']);
if (isset($options['help'])) {
    usage();
    exit(0);
}

$errors = [];
if (PHP_VERSION_ID < 80000) {
    $errors[] = 'PHP 8.0 or newer is required by this installer.';
}
foreach (['mysqli', 'zip'] as $extension) {
    if (!extension_loaded($extension)) {
        $errors[] = "Missing PHP extension: {$extension}";
    }
}
$source = __DIR__;
foreach (['index.php', 'db.php', 'dbclass.php', 'dbclass2.php'] as $required) {
    if (!is_file($source . DIRECTORY_SEPARATOR . $required)) {
        $errors[] = "Source file missing: {$required}";
    }
}
if ($errors !== []) {
    foreach ($errors as $error) {
        fwrite(STDERR, "ERROR: {$error}\n");
    }
    exit(1);
}
echo "Preflight OK: PHP " . PHP_VERSION . "; mysqli and zip available.\n";
echo "WARNING: Legacy AutoPHP is NOT security-certified for public hosting.\n";
echo "Its existing web forms use GET for database credentials and some generated SQL is unsafe.\n";
echo "Use only in a restricted development environment until these issues are fixed.\n";

if (isset($options['check'])) {
    exit(0);
}

$target = $options['target'] ?? null;
if (!is_string($target) || $target === '') {
    usage();
    failInstall('Specify --target=/absolute/path (or --check).', 2);
}
if ($target[0] !== DIRECTORY_SEPARATOR) {
    failInstall('Target must be an absolute Unix path.', 2);
}
$target = rtrim($target, DIRECTORY_SEPARATOR);
if ($target === '' || $target === $source) {
    failInstall('Invalid target directory.');
}
$parent = realpath(dirname($target));
if ($parent === false || !is_dir($parent) || !is_writable($parent)) {
    failInstall('The parent directory must exist and be writable.');
}
$target = $parent . DIRECTORY_SEPARATOR . basename($target);
if (file_exists($target) || is_link($target)) {
    failInstall('Target already exists; refusing to overwrite it.');
}
if ($target === $source || str_starts_with($target . DIRECTORY_SEPARATOR, $source . DIRECTORY_SEPARATOR)) {
    failInstall('Target must be outside the source checkout.');
}
$exclude = ['.git', '.github', 'install.php'];
$copied = 0;
$copyTree = static function (string $from, string $to) use (&$copyTree, &$copied, $exclude): void {
    $iterator = new DirectoryIterator($from);
    foreach ($iterator as $entry) {
        if ($entry->isDot() || in_array($entry->getFilename(), $exclude, true)) {
            continue;
        }
        if ($entry->isLink()) {
            throw new RuntimeException('Symlink encountered: ' . $entry->getPathname());
        }
        $destination = $to . DIRECTORY_SEPARATOR . $entry->getFilename();
        if ($entry->isDir()) {
            if (!mkdir($destination, 0750)) {
                throw new RuntimeException('Unable to create directory: ' . $destination);
            }
            $copyTree($entry->getPathname(), $destination);
        } elseif ($entry->isFile()) {
            if (!copy($entry->getPathname(), $destination)) {
                throw new RuntimeException('Unable to copy: ' . $entry->getPathname());
            }
            chmod($destination, 0640);
            $copied++;
        }
    }
};
if (isset($options['dry-run'])) {
    echo "DRY RUN: would install from {$source} to {$target}. No files modified.\n";
    exit(0);
}
$stage = $parent . DIRECTORY_SEPARATOR . '.' . basename($target) . '.staging-' . bin2hex(random_bytes(8));
$removeTree = static function (string $path) use (&$removeTree): void {
    if (!is_dir($path) || is_link($path)) {
        return;
    }
    foreach (new DirectoryIterator($path) as $entry) {
        if ($entry->isDot()) {
            continue;
        }
        if ($entry->isDir() && !$entry->isLink()) {
            $removeTree($entry->getPathname());
        } else {
            unlink($entry->getPathname());
        }
    }
    rmdir($path);
};
try {
    if (!mkdir($stage, 0750)) {
        throw new RuntimeException('Cannot create staging directory.');
    }
    $copyTree($source, $stage);
    if (file_exists($target) || !rename($stage, $target)) {
        throw new RuntimeException('Cannot finalize installation.');
    }
    echo "Installed {$copied} files into {$target}.\n";
    echo "IMPORTANT: Restrict network access; review db.php and SQL generation before deployment.\n";
} catch (Throwable $exception) {
    $removeTree($stage);
    failInstall($exception->getMessage());
}
