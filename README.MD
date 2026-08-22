# AutoPHP

### Schema-driven PHP code generator · MySQL introspection · CRUD automation

AutoPHP is an experimental PHP development tool created to automate repetitive web application development from an existing MySQL database schema.

> **Historical project:** the software was originally developed before this GitHub repository was created. The repository preserves a later snapshot of that work. AutoPHP was eventually left as a historical/experimental project as generative AI changed the way code-generation problems could be approached.

## What AutoPHP does

AutoPHP connects to a local or remote MySQL database, inspects the structure and metadata of its tables, and uses that information to generate PHP application code automatically.

The generator was designed around the common operations required by data-driven applications:

- Create / Add
- Update
- Delete
- Select / List
- Search

Instead of manually creating the same CRUD structures for every database table, AutoPHP reads the schema and generates files using **PHP, MySQL/SQL, HTML, CSS and JavaScript**.

## How it works

The project uses MySQL metadata as input for deterministic code generation.

Conceptually:

```text
MySQL database
      │
      ▼
Schema / table introspection
      │
      ▼
Fields · types · keys · relationships
      │
      ▼
Generation rules
      │
      ▼
PHP + HTML + SQL application files
      │
      ▼
CRUD application package / ZIP
```

The implementation examines database field metadata and uses it to decide how application code and HTML controls should be generated. Numeric fields, strings, dates, times, large text/blob fields, passwords, primary keys and related fields can therefore influence the generated output.

The project also contains logic for generating complete sets of PHP files and packaging generated application structures into ZIP files.

## Why this project matters

AutoPHP represents an early stage of my work with **software automation and code generation**.

The central idea was simple:

> A developer should not have to manually rewrite predictable code when the database already contains enough structural information to generate much of it.

AutoPHP approached that problem with deterministic rules: inspect structured metadata, interpret it, and generate working application components.

Years later, generative AI and large language models changed this problem substantially. A model can work not only from database structure but also from natural-language requirements, application context, architecture, validation rules and existing source code.

For that reason, AutoPHP was not continued as my primary direction. The underlying interest did continue: **automating repetitive development and allowing software to use context to produce useful work.** That direction is now reflected in my work with AI systems, agents, retrieval, memory and automation.

## Historical status

AutoPHP should be read as a **historical experimental codebase**, not as a current production framework.

The source reflects the PHP/MySQL practices and experiments of the period in which it was developed. It has not been modernized to represent current security or production-development standards.

If the concept were rebuilt today, I would use modern PHP practices, PDO/prepared statements, stronger input validation, explicit schema models, safer credential handling, tests and AI-assisted generation where appropriate.

## Technology

- PHP
- MySQL / SQL
- HTML
- CSS
- JavaScript
- Database schema introspection
- Metadata-driven code generation
- ZIP generation

## Author

**Jimmy Backend**  
Backend · Cloud · AI Systems

GitHub: **@jimmybackend**
