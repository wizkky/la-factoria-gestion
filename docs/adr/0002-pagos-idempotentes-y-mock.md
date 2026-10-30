# ADR 0002: Pagos mediante adaptador e idempotencia

- Estado: aceptado para el prototipo
- Fecha: 2026-10-30

## Decisión

El dominio depende de `PaymentProvider`; la primera implementación es un simulador local que no hace solicitudes de red. Cada intento usa una clave de idempotencia y conserva referencia interna, importe CLP, estado, proveedor y marcas de tiempo en el futuro registro de auditoría.

La API de sincronización/conciliación tendrá identificador de comercio, referencia de venta, referencia del proveedor, importe, moneda, estado, hora de origen y hora de recepción. Los eventos entrantes se deduplicarán por ID de evento del proveedor más terminal y cuenta. Nunca guardar datos completos de tarjeta.

## Consecuencias

La conexión real permanece deshabilitada hasta confirmar documentación, credenciales y terminal de Andrea. Ninguna respuesta de la interfaz equivale por sí sola a un pago aprobado; sólo un estado confirmado por TUU podrá marcar la venta pagada.
