# Roadmap

## Fase 0 — Base de desarrollo

- [x] Confirmar NexoPOS, licencia, arquitectura modular y versión inicial.
- [x] Definir Docker Compose y convenciones del repositorio.
- [ ] Ejecutar construcción e instalación en un equipo con Docker.
- [ ] Ajustar el montaje de extensiones a la estructura real generada por NexoPOS 6.3.0.

## Fase 1 — Administración propia

- [ ] Identidad visual La Factoría sobre el dashboard NexoPOS; revisar modo oscuro y accesibilidad.
- [ ] Propietaria por producto y filtros de inventario por colaboradora, con trazabilidad.
- [ ] Acuerdos de consignación, ventas atribuibles, comisiones y liquidaciones revisables.
- [ ] Pruebas de autorización y cálculos con casos reales anonimizados.

## Fase 2 — Pagos y conciliación

- [x] Interfaz desacoplada y proveedor TUU simulado, con clave de idempotencia.
- [ ] Confirmar API y capacidades disponibles en la cuenta de Andrea.
- [ ] Confirmar modelo/firmware del terminal, asignación de terminal y flujo para débito/crédito.
- [ ] Validar consultas de estado, reintentos, devoluciones, conciliación y tratamiento de webhooks.
- [ ] Implementar sandbox/credenciales de prueba y auditoría antes de pagos reales.

## Fase 3 — Acceso móvil

- [ ] Adaptar el uso cotidiano a teléfonos y desplegar web adaptable.
- [ ] Evaluar PWA y funcionamiento con conectividad intermitente.
- [ ] Evaluar aplicación Android/iOS según impresión, acceso al terminal y necesidad de tiendas.
