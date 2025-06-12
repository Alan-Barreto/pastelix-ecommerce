<?php
namespace Controllers;

use Model\CarritoProducto;
use Model\Producto;
use MVC\Router;

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
        

        $router->render('paginas/checkout', [
            'titulo' => 'Checkout'
        ]);
    }
}