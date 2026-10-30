# Estrategia de actualización de NexoPOS

1. Registrar la versión usada en `.env.example` y el valor por defecto del Dockerfile; actualizar el entorno local antes de construir la imagen.
2. Antes de actualizar, leer notas de versión, avisos de seguridad, requisitos de PHP/Node/base de datos y compatibilidad del módulo.
3. Crear rama `chore/nexopos-<version>`; construir desde cero y probar en una copia desechable de datos.
4. Revisar cambios de APIs, eventos, permisos, migraciones, Vue y formato de módulos. Mantener las extensiones fuera del núcleo.
5. Ejecutar pruebas del dominio y pruebas de humo de instalación/POS/inventario; registrar diferencias en un ADR o PR.
6. Fusionar sólo con respaldo, migración probada y plan de reversión.

NexoPOS 6.3.0 es la base inicial tras el aviso de seguridad que afecta a 6.2.4 y anteriores. Esta fijación es una decisión de arranque, no una política de permanecer en esa versión.
