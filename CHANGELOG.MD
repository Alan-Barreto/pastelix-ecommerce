# Changelog

Este archivo documenta los cambios realizados en el proyecto **Pastelix Ecommerce**.

El formato sigue el esquema de versionado semántico: MAJOR.MINOR.PATCH

- MAJOR: cambios incompatibles o que rompen funcionalidades existentes
- MINOR: nuevas funcionalidades compatibles
- PATCH: correcciones o mejoras internas sin cambios visibles importantes

## [0.6.0] - 2025-07-21 
### ➕ Agregado
- Creada las tablas:
    - `pedidos`
    - `pedido_productos`
    - `pedido_direccion`
    - `pedido_cliente`
- Implementado los modelos:
    - `Pedido`
    - `PedidoCliente`
    - `PedidoProducto`
    - `PedidoDireccion`
- Creado el controlador `APICheckout.php` para gestionar las apis referentes al funcionamiento de la ruta `checkout`
- Rutas para los llamados a la api:
    - `/api/verificarLogin`
    - `/api/recuperarDirecciones`
    - `/api/guardarNuevaDireccion`
    - `/api/recuperarDatosProductos` 
    - `/api/validarDatosFormulario` 
    - `/api/guardarDatosPedido` 
    - `/api/orders` 
    - `/api/orders/capture` 
- Creada ruta para tramitar el pago `/checkout`
- Creado archivo `checkout.js` para dar dinamismo a la ruta `/checkout` 
- Agregadas imágenes de muestra tipo `thumb`
- Integración de `paypal-server-sdk` para el manejo de los pagos
- Creado el controlador `PaypalController.php` para gestionar la integración de paypal
- Integrado el sdk de paypal para gestionar los pagos
- Añadida funcion `count` en el modelo `ActiveRecord`

### 🔧 Cambiado
- Modificados los archivos `direcciones.php` y `formularioDireccion.php` para mantener coherencia con la nueva estructura del modelo `Direccion`
- Añadida funcion `validarFormularioCheckout` en el modelo `Direccion`
- Añadida la columna `telefono` en la tabla `usuario`
- Modificado el modelo `Usuario` para mantener coherencia con la nueva estructura
- Añadida funcion  `validarFormularioCheckout` en el modelo `Usuario`
- Modificado el archivo `.env` y `.env.example` para agregar las credenciales de paypal `PAYPAL_CLIENT_ID` y `PAYPAL_CLIENT_SECRET`
- Añadida las columnas `pais_codigo` y `pais_nombre` en la tabla `direcciones`
- Modificado el modelo `Direccion` para mantener coherencia con la nueva estructura
- Añadida las columnas `pais_codigo` y `pais_nombre` en la tabla `pedido_direccion`
- Modificado el modelo `PedidoDireccion` para mantener coherencia con la nueva estructura
- Modificado el archivo `database.sql` para mantener coherencia con la nueva estructura

### 🧹 Eliminado
- Eliminadas las columnas `nombre`, `apellido`, `telefono` y `pais` de la tabla `direcciones`
- Eliminada la columna `pais` de la tabla `pedido_direccion`

### 📅 Pendiente
- Arreglar las funciones de guardar/editar direcciones del usuario para mantener coherencia con la nueva estructura de la tabla `direcciones`
- Arreglar el mensaje de pago completado en la ruta `checkout`

## [0.5.0] - 2025-06-12 
### ➕ Agregado
- Creada las tablas:
    - `carritos`
    - `carrito_productos`
- Implementado los modelos:
    - `Carrito`
    - `CarritoProducto`
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
- Arreglada la funcionalidad de la ruta `/tienda`

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