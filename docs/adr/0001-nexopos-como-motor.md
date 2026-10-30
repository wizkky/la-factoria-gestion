# ADR 0001: NexoPOS como motor comercial

- Estado: aceptado para el prototipo
- Fecha: 2026-10-30

## Contexto

La Factoría necesita ventas presenciales, productos, inventario, caja y reportes, además de atribuir artículos en consignación a distintas colaboradoras. Rehacer el POS y el inventario multiplicaría el trabajo y el riesgo.

## Decisión

Usar NexoPOS 6.3.0 como núcleo comercial; mantener funciones propias en módulos Laravel. Respetar GPL-3.0 y conservar los avisos del upstream. No se distribuye aquí una copia del motor.

## Consecuencias

Se aprovechan catálogo, ventas, inventario y caja existentes. La compatibilidad depende de las APIs/extensiones documentadas por NexoPOS y debe comprobarse contra la versión fijada. La identidad visual se implementará mediante extensiones primero; un rediseño profundo puede requerir cambiar la estrategia o asumir mantenimiento de un fork.
