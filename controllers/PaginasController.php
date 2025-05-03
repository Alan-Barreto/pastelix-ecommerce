<?php
namespace Controllers;

use Model\Producto;
use MVC\Router;

class PaginasController{
    public static function index(Router $router){

        $router->render('paginas/index', [
            'titulo' => 'Pastelix'
        ]);
    }

    public static function Tienda(Router $router){
        $productos = Producto::all('ASC');


        $router->render('paginas/tienda', [
            'titulo' => 'Tienda',
            'productos' => $productos
        ]);
    }
}