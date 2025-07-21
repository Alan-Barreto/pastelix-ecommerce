<?php
namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Producto;
use Model\CarritoProducto;

class PaginasController{
    public static function index(Router $router){

        $router->render('paginas/index', [
            'titulo' => 'Pastelix'
        ]);
    }

    public static function tienda(Router $router){
  
        $router->render('paginas/tienda', [
            'titulo' => 'Tienda'
        ]);
    }

    public static function checkout(Router $router){   
        if(is_auth()){
            $usuario = Usuario::thisWhere(['nombre', 'apellido', 'email', 'telefono'], 'id', $_SESSION['id']);
        }

        $router->render('paginas/checkout', [
            'titulo' => 'Checkout',
            'usuario' => $usuario[0] ?? ''
        ]);
    }
}