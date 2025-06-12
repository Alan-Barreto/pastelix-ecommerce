# Changelog

Este archivo documenta los cambios realizados en el proyecto **Pastelix Ecommerce**.

El formato sigue el esquema de versionado semántico: MAJOR.MINOR.PATCH

- MAJOR: cambios incompatibles o que rompen funcionalidades existentes
- MINOR: nuevas funcionalidades compatibles
- PATCH: correcciones o mejoras internas sin cambios visibles importantes

## [0.5.0] - 2025-06-12 
### ➕ Agregado
- Creada las tablas:
    - `carritos`
    - `carrito_productos`
- Creado el controlador `APICarrito.php` para gestionar las apis referentes al funcionamiento de la tienda y su carrito
- Rutas para los llamados a la api:
    - `/api/recuperarCatalogo`
    - `/api/recuperarCarrito`
    - `/api/recuperarPrecio`
    - `/api/añadirProducto` 
    - `/api/actualizarCantidadProductoDelCarrito` 
    - `/api/eliminarProductoDelCarrito` 

### 🔧 Cambiado
- Refactorizado el archivo `tienda.js` para integrar llamado a la api en su funcionamiento
- Refactorizado el archivo `tienda.php` para pasar el renderizado de la pagina a `tienda.js`
- Añadida funcion `whereArray` en el modelo `ActiveRecord`

### 🐛 Corregido
- Arreglada la funcionalidad de `/tienda`

### 📅 Pendiente
- Implementar procesamiento del pedido y pago
- Implementar funcionalidad en las siguientes rutas:
    - `checkout`
    - `admin`
    - `admin/resumen`
    - `admin/pedidos`
    - `usuario/pedidos`

## [0.4.0] - 2025-05-11 
### ➕ Agregado
- Funcionalidad para mantener las alertas persistentes tras redirecciones
- Rutas iniciales para el panel de administración:
    - `admin`
    - `admin/productos`
    - `admin/productos/crear`
    - `admin/productos/editar`
    - `admin/resumen`
    - `admin/pedidos`
- Creación del controlador `AdminController.php` para gestionar las rutas administrativas
- Integración de la librería `Intervention Image` para la conversión de imágenes al formato WebP
- Función para redimensionar y convertir imágenes subidas por el usuario a WebP
- Función para eliminar las imágenes asociadas a un producto cuando este es eliminado o se reemplaza su imagen

### 🔧 Cambiado
- Añadido parámetro `layout` en el método `render` de `Router.php` para utilizar una plantilla diferente en las rutas de administración
- Nuevas validaciones en el modelo `Producto`
- Actualización de los datos de imagen en la columna `imagen` de la tabla `productos` para unificarlos con el formato de las imágenes subidas por el usuario
- Modificado el valor de `imagen` dentro de la tabla `productos` en `database.sql` para reflejar el nuevo formato.
- Imágenes de muestra convertidas a formato WebP

### 🧹 Eliminado
- Eliminada columna `miniatura` de la tabla `productos`
- Eliminada columna `miniatura` del modelo `Producto`
- Eliminada la columna `miniatura` en la tabla `productos` del archivo `database.sql` para mantener coherencia con la nueva estructura

### 🐛 Corregido
- Solucionado un error que duplicaba las solicitudes de actualización de datos en la ruta `/usuario`
- Añadidas validaciones de acceso faltantes en rutas:
    - `olvide`
    - `recuperar`
    - `mensaje`
- Actualización del valor de `password` en la tabla `usuarios` de `database.sql` por un hash
- Corrección del llamado a imágenes en la ruta `/tienda` para ajustarse al nuevo formato de nombres y extensiones.

### 📅 Pendiente
- Implementar funcionalidad en las siguientes rutas:
    - `admin`
    - `admin/resumen`
    - `admin/pedidos`
    - `usuario/pedidos`

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