<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;

class AdminController{
    public static function admin(Router $router){
       if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $router->render('admin/admin',[
                'titulo' => 'Administracion - Inicio',
            ], 'adminLayout');
        }
    }

    public static function productos(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $productos = Producto::all('ASC');
       
            $router->render('admin/productos/productos',[
                'titulo' => 'Administracion - Productos',
                'productos' => $productos
            ], 'adminLayout');
        }
    }

    public static function crearProducto(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $alertas = '';
            $producto = new Producto();
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($_FILES['imagen']['tmp_name']){
                        $nombreImagen = md5(uniqid(rand(), true));
                        $imagen = $_FILES['imagen']['tmp_name'];
                        $_POST['imagen'] = $nombreImagen;   
                        $alertas = Producto::validarImagen($imagen); 
                }
                $producto->sincronizar($_POST);
                $alertas = $producto->validarProducto(true);
                if(empty($alertas)){
                        procesarImagen($imagen,$nombreImagen, true); 
                        $producto->guardar();

                        setAlertaSession('exito', 'Producto creado con exito');
                        header('Location: /admin/productos');
                        exit;
                }
            }

            $router->render('admin/productos/crear',[
                'titulo' => 'Administracion - Nuevo Producto',
                'producto' => $producto,
                'alertas' => $alertas
            ], 'adminLayout');
        } 
    }

    public static function editarProducto(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
             $alertas = '';
        $producto = Producto::validarIdProducto();
        $imagenNueva = false;
        if(!$producto){
            setAlertaSession('error', 'Producto no encontrado');
            header('Location: /admin/productos');
            exit;
        }else{
            $imagenActual = $producto->imagen;
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($_FILES['imagen']['tmp_name']){
                    $nombreImagen = md5(uniqid(rand(), true));
                    $imagen = $_FILES['imagen']['tmp_name'];
                    $_POST['imagen'] = $nombreImagen;   
                    $alertas = Producto::validarImagen($imagen); 
                    if(empty($alertas)){
                        $imagenNueva = true;
                        $ruta = __DIR__.'/../public/img/productos/'.$imagenActual;
                    }
                }
                $producto->sincronizar($_POST);
                $alertas = $producto->validarProducto();
                if(empty($alertas)){
                    if($imagenNueva){
                        borrarImagen($ruta);
                        procesarImagen($imagen, $nombreImagen , true);
                    }
                    $producto->guardar();
                    setAlertaSession('exito', 'Producto '. $producto->id . ' actualizado con exito');
                    header('Location: /admin/productos');
                    exit;
               }
            }
        }
            $router->render('admin/productos/editar',[
                'titulo' => 'Administracion - Editar Producto',
                'producto' => $producto,
                'alertas' => $alertas,
                'imagenActual' => $imagenActual
            ], 'adminLayout');
        }
    }

    public static function borrarProducto(){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $producto = Producto::validarIdProducto();
            if(!$producto){
                setAlertaSession('error', 'Producto no encontrado');
                header('Location: /admin/productos');
                exit();
           }else{
                $ruta = __DIR__.'/../public/img/productos/'.$producto->imagen;
                borrarImagen($ruta);
                $producto->delete();
                setAlertaSession('exito', 'Producto eliminado con exito');
                 header('Location: /admin/productos');
                 exit();
           }
        }
    }

    public static function resumen(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $router->render('admin/resumen',[
            'titulo' => 'Administracion - Resumen',
            ], 'adminLayout');
        }     
    }

    public static function pedidos(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
             $router->render('admin/pedidos',[
            'titulo' => 'Administracion - Pedidos',
            ], 'adminLayout');
        }
    }
}