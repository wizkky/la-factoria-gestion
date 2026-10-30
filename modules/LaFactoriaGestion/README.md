# Módulo LaFactoriaGestion

Extensión separada para datos de propiedad, consignación y liquidación. Crear el paquete compatible con la versión instalada mediante `php artisan make:module` después del primer arranque; portar estas reglas y mantener aquí las migraciones, rutas y pruebas del módulo. No editar tablas ni archivos del núcleo a mano.

El catálogo, stock disponible, POS, caja, permisos y reportes generales ya pertenecen a NexoPOS. La extensión añadirá únicamente titularidad, acuerdos de consignación y cálculo/seguimiento de liquidaciones.

La integración del módulo en Composer se realizará por el autoloader PSR-4 de `Modules\\` documentado por NexoPOS, siguiendo su estructura generada para 6.3.0. Esta carpeta aún es un diseño de dominio, no un ZIP instalable.
