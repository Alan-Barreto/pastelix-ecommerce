<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\API;
use Controllers\AdminController;
use Controllers\APICarrito;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\UsuariosController;

$router = new Router;

//Login-logout
$router->get('/login',[LoginController::class, 'login']);
$router->post('/login',[LoginController::class, 'login']);
$router->post('/logout',[LoginController::class, 'logout']);


//Registro
$router->get('/registro',[LoginController::class, 'registro']);
$router->post('/registro',[LoginController::class, 'registro']);
$router->get('/mensaje',[LoginController::class, 'mensaje']);

//Recuperar contraseña
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/recuperar',[LoginController::class, 'recuperar']);
$router->post('/recuperar',[LoginController::class, 'recuperar']);

//AREA PRIVADA
$router->get('/usuario',[UsuariosController::class, 'usuario']);
$router->post('/usuario',[UsuariosController::class, 'usuario']);
$router->get('/usuario/pedidos',[UsuariosController::class, 'pedidos']);
$router->get('/usuario/direcciones',[UsuariosController::class, 'direcciones']);


//Cambiar datos de usuario
$router->get('/actualizar',[UsuariosController::class, 'actualizar']);
$router->get('/usuario/direcciones/crear',[UsuariosController::class, 'crear']);
$router->post('/usuario/direcciones/crear',[UsuariosController::class, 'crear']);
$router->get('/usuario/direcciones/editar',[UsuariosController::class, 'editar']);
$router->post('/usuario/direcciones/editar',[UsuariosController::class, 'editar']);
$router->post('/usuario/direcciones/borrar',[UsuariosController::class, 'borrar']);

//Area de administración
$router->get('/admin',[AdminController::class, 'admin']);
$router->get('/admin/productos',[AdminController::class, 'productos']);
$router->get('/admin/productos/crear',[AdminController::class, 'crearProducto']);
$router->post('/admin/productos/crear',[AdminController::class, 'crearProducto']);
$router->get('/admin/productos/editar',[AdminController::class, 'editarProducto']);
$router->post('/admin/productos/editar',[AdminController::class, 'editarProducto']);
$router->post('/admin/productos/borrar',[AdminController::class, 'borrarProducto']);
$router->get('/admin/resumen',[AdminController::class, 'resumen']); 
$router->get('/admin/pedidos',[AdminController::class, 'pedidos']); 



//AREA PUBLICA
$router->get('/', [PaginasController::class, 'index']);
$router->get('/tienda', [PaginasController::class, 'tienda']);
$router->get('/checkout', [PaginasController::class, 'checkout']);

//APIS
$router->get('/api/recuperarCatalogo', [APICarrito::class, 'recuperarCatalogo']);
$router->get('/api/recuperarCarrito', [APICarrito::class, 'recuperarCarrito']);
$router->post('/api/recuperarPrecio', [APICarrito::class, 'recuperarPrecio']);
$router->get('/api/añadirProducto', [APICarrito::class, 'añadirProducto']);
$router->put('/api/actualizarCantidadProductoDelCarrito', [APICarrito::class, 'actualizarCantidadProductoDelCarrito']);
$router->delete('/api/eliminarProductoDelCarrito', [APICarrito::class, 'eliminarProductoDelCarrito']);


$router->comprobarRutas();