<?php
/**
 * AutoPHP database connection.
 * Configure AUTOPHP_DB_HOST, AUTOPHP_DB_USER, AUTOPHP_DB_PASSWORD
 * and AUTOPHP_DB_NAME as environment variables.
 */
$servidor = getenv('AUTOPHP_DB_HOST') ?: '127.0.0.1';
$usuario = getenv('AUTOPHP_DB_USER') ?: '';
$clave = getenv('AUTOPHP_DB_PASSWORD');
$basedatos = getenv('AUTOPHP_DB_NAME') ?: '';
if ($clave === false) { $clave = ''; }
if ($usuario === '' || $basedatos === '') {
    http_response_code(503);
    exit('AutoPHP database environment is not configured.');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos);
    mysqli_set_charset($db_connection, 'utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log('AutoPHP database connection failed: ' . $exception->getMessage());
    http_response_code(503);
    exit('Database connection unavailable.');
}
