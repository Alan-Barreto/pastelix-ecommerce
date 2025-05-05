# Changelog

Este archivo documenta los cambios realizados en el proyecto **Pastelix Ecommerce**.

El formato sigue el esquema de versionado semántico: MAJOR.MINOR.PATCH

- MAJOR: cambios incompatibles o que rompen funcionalidades existentes
- MINOR: nuevas funcionalidades compatibles
- PATCH: correcciones o mejoras internas sin cambios visibles importantes

## [0.3.0] - 2025-05-05 
### ➕ Agregado
- Creada la tabla `direcciones` en la base de datos con sus respectivas relaciones.
- Implementado el modelo `Direccion` para interactuar con la base de datos.
- Añadidas las rutas de creación y edición de direcciones:
    - `usuario/direcciones/crear`
    - `usuario/direcciones/editar`
- Añadida la función para borrar direcciones guardadas por los usuarios.

### 📅 Pendiente
- Agregar funcionalidad para que las alertas persistan después de una redirección.

## [0.2.0] - 2025-05-02
### 🔧 Cambiado
- Migrada la lógica de confirmación de cuenta a la ruta `/actualizar`.
- Refactorizada la clase `Email` para facilitar mantenimiento y escalado futuro.

### 🧹 Eliminado
- Eliminada la columna `token` del modelo `Usuario`.
- Eliminada la columna `confirmado` del modelo `Token`.

### 🐛 Corregido
- Ajustadas funciones afectadas por los cambios en los modelos.


## [0.1.0] - 2025-05-01
### Inicial
- Tienda online de venta de postres
- Sistema de usuarios con registro, login y confirmación por correo
- Carrito de compras con interfaz funcional (sin procesamiento de pedidos aún)
- Validaciones de formularios (servidor y cliente)
- Separación por roles: cliente y administrador
- Estilos con Sass y JavaScript modular usando Webpack
- Automatización de tareas con Gulp