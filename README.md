# La Factoría — Gestión

Plataforma administrativa para el taller textil y la vitrina colaborativa de Andrea. NexoPOS es el motor comercial; este repositorio reúne módulos propios y configuración de desarrollo sin mantener una copia modificada del núcleo.

## Estado

Inicio de desarrollo. La base propuesta fija NexoPOS `v6.3.0` (GPL-3.0), con Docker para desarrollo local. El adaptador TUU empieza exclusivamente en modo simulado: no envía solicitudes de cobro ni usa credenciales reales.

## Alcance de la primera fase

- Arranque local repetible con Docker Compose y MySQL.
- Mantener ventas, caja, productos, inventario general, usuarios y reportes en NexoPOS.
- Añadir el concepto de propietaria del producto y el esqueleto de consignaciones/liquidaciones como módulo propio.
- Probar el contrato de pagos con un simulador TUU. La conexión real queda bloqueada hasta validar acceso a API, modelo de terminal y proceso de conciliación de la cuenta de Andrea.
- Personalizar la experiencia administrativa con identidad La Factoría; evolucionar desde web adaptable/PWA y evaluar clientes Android/iOS después.

## Requisitos

- Docker Desktop con Docker Compose v2
- Git

## Inicio rápido

1. Copiar `.env.example` como `.env` y cambiar las contraseñas locales.
2. Ejecutar `docker compose up --build`.
3. Abrir <http://localhost:8080> y completar el asistente de instalación de NexoPOS.

La primera construcción descarga NexoPOS `6.3.0` desde Composer. Las versiones del motor y PHP quedan declaradas en `.env.example`. Las credenciales TUU permanecen vacías y el modo es `mock`.

## Desarrollo y pruebas

```powershell
php tests/run.php
```

El conjunto de pruebas es puro PHP y no requiere instalar dependencias. Comprueba invariantes del modelo de titularidad y el comportamiento simulado de pagos. No prueba conexión con TUU ni reemplaza pruebas de integración dentro de una instalación real de NexoPOS.

## Estructura

- `docker/`: imágenes y configuración del entorno local.
- `modules/LaFactoriaGestion/`: extensión propia; las funciones comerciales comunes permanecen en NexoPOS.
- `src/Payments/`: contrato de proveedor y simulador sin efectos externos.
- `src/Inventory/`: reglas de propiedad del producto.
- `docs/adr/`: decisiones de arquitectura.
- `docs/ROADMAP.md`: hitos y dependencias.
- `tests/`: pruebas automatizadas del dominio independiente.

## Rama y revisión

- `main` debe permanecer desplegable.
- Ramas: `feat/<tema>`, `fix/<tema>`, `docs/<tema>`.
- Cada cambio funcional debe incluir pruebas y documentación cuando cambien contratos o decisiones.
- Integrar mediante pull request; exigir revisión y CI verde antes de fusionar.
- Commits con prefijos `feat:`, `fix:`, `docs:`, `test:`, `build:` o `chore:`.

## Upstream y licencia

NexoPOS se distribuye bajo GPL-3.0. Si se distribuye una obra derivada que incorpora el motor, hay que respetar sus avisos y obligaciones de licencia; revisar el alcance con asesoría antes de distribuirla. El proyecto evita editar el código del motor: fija una versión de Composer y mantiene capacidades propias como módulos separados. Ver [actualización de upstream](docs/UPSTREAM.md).

## Seguridad

No guardar claves, tokens, datos de tarjetas ni archivos `.env` en Git. Los pagos se identifican con referencias internas; no se almacena PAN/CVV. La conciliación debe conservar trazabilidad e idempotencia. No activar `TUUPOS_MODE=live` hasta completar la revisión de seguridad y habilitación correspondiente.
