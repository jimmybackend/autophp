# AutoPHP — instalador CLI (fase de preparación)

AutoPHP es una aplicación heredada en PHP que genera código a partir de tablas MySQL. Este instalador **copia el proyecto a un directorio nuevo**; no configura MySQL, no migra datos ni ejecuta el generador.

## Requisitos

- Linux/Unix; acceso a terminal con PHP 8.0 o superior
- Extensiones PHP `mysqli` y `zip`
- Permisos de escritura sobre el directorio padre del destino
- Código descargado desde este repositorio

## Uso

```bash
php install.php --check
php install.php --target=/opt/autophp --dry-run
php install.php --target=/opt/autophp
```

El directorio de destino **no debe existir**. El instalador crea un directorio provisional con permisos restrictivos (0750/0640), copia los archivos y luego lo renombra. No modifica el checkout original, no sobrescribe instalaciones y no modifica bases de datos. Excluye `.git`, `.github` e `install.php`.

## Estado y precauciones

**No se ha declarado versión estable ni se recomienda exponer AutoPHP directamente a Internet.** En el código heredado, `index.php` transmite credenciales de MySQL mediante GET; `db.php` contiene credenciales de ejemplo; y algunas operaciones construyen SQL concatenado. Antes de producción se requiere corregir autenticación, almacenamiento de secretos, validación SQL, gestión de errores y pruebas funcionales. Cambiar las credenciales de ejemplo no equivale a solucionar estos riesgos.

Este instalador no contiene un servicio web público ni concede permisos de red. Protege el despliegue contra sobrescrituras accidentales, pero no corrige por sí mismo las debilidades de la aplicación.

## Siguiente etapa de estabilización

1. Reemplazar credenciales embebidas y formularios GET por configuración segura y sesiones.
2. Revisar `dbclass.php`, `dbclass2.php` y todo código PHP generado; usar consultas preparadas para valores y listas permitidas para identificadores SQL.
3. Crear pruebas reales con una base MySQL de prueba, sin datos sensibles.
4. Emitir una versión etiquetada sólo cuando las pruebas y la revisión de seguridad aprueben.
