<?php

namespace Controllers;

use Model\Carrito;
use Model\CarritoProducto;
use Model\Producto;
use Model\Usuario;

class APICarrito{
    public static function recuperarCatalogo(){
        //A futuro se puede agregar cosas como pagina y orden deseado para rearmar el carrito al cambiar de pagina y el orden 

        $productos = Producto::all('ASC');

        if(!$productos){
            http_response_code(404);
            echo json_encode(['error' => 'No se pudo recuperar los productos']);
            exit;
        }

        echo json_encode($productos);
        exit;
    }

    public static function recuperarCarrito(){
       if(is_auth()){
            $carrito = Carrito::where('usuario_id', $_SESSION['id']);
            if(!$carrito){
                http_response_code(404);
                echo json_encode(['error' => 'Carrito no encontrado']);
                exit;
            }
            $carritoProductos = CarritoProducto::recuperarProductos($carrito->id);
            if(empty($carritoProductos)){
                echo json_encode(['error' => 'Carrito vacio']);
                exit;
            }
            echo json_encode($carritoProductos);
            exit;
        }
            echo json_encode(['error' => 'Usuario no logueado']);
    }

    public static function añadirProducto(){
        $productoId = $_GET['id'];
        $productoId = filter_var($productoId, FILTER_VALIDATE_INT);

        if(!$productoId || $productoId < 1){
            http_response_code(400);
            echo json_encode(['error' => 'ID no válido']);
            exit;
        }
        $producto = Producto::thisWhere(['nombre', 'precio'], 'id', $productoId);
         if(!$producto){
            http_response_code(404);
            echo json_encode(['error' => 'Producto no encontrado']);
            exit;
        }
        $producto[0]->id = $productoId;
        if(is_auth()){
            $carrito = Carrito::where('usuario_id', $_SESSION['id']);
            if(!$carrito){
            http_response_code(404);
            echo json_encode(['error' => 'Carrito no encontrado']);
            exit;
            }

            $productoDuplicado = CarritoProducto::whereArray(['carrito_id' => $carrito->id,'producto_id' => $productoId]);

            if(!empty($productoDuplicado)){
                http_response_code(500);
                echo json_encode(['error' => 'Error al añadir el producto en el carrito']);
                exit;
            }

            $carritoProducto = new CarritoProducto([
                'carrito_id' => $carrito->id,
                'producto_id' => $productoId,
            ]);

            $carritoProducto->guardar();
  
        }
        
       echo json_encode($producto[0]);
       exit;
    }

    public static function recuperarPrecio(){
        
        header('Content-Type: application/json');

         $getContent =  file_get_contents('php://input');
         $input = json_decode($getContent, true);
        
        $productosIds = [];
        if(!is_array($input)){
            http_response_code(400);
            echo json_encode(['error' => 'El dato recibido no es un array']);
            exit;
        }

        foreach($input as $producto){
            if(!isset($producto['producto_id'], $producto['cantidad']) ||
            filter_var($producto['producto_id'], FILTER_VALIDATE_INT) === false ||
            filter_var($producto['cantidad'], FILTER_VALIDATE_INT) === false){

                http_response_code(400);
                echo json_encode(['error' => 'El dato recibido no contiene enteros']);
                exit;
            }
            
            if($producto['producto_id'] <= 0 || $producto['cantidad'] <= 0){
                http_response_code(422);
                echo json_encode(['error' => 'El dato recibido no es valido (menor o igual a cero)']);
                exit;
            }

            $productosIds[] = $producto['producto_id'];
        }
         $productosIds = implode(", ", $productosIds);
         $productosPrecios = Producto::thisWhere(['id', 'nombre', 'precio'], 'id', $productosIds, 'IN');
         if(!$productosPrecios){
            http_response_code(404);
            echo json_encode(['error' => 'Error al encontrar los productos']);
            exit;
         }
        echo json_encode($productosPrecios);
        exit;
    }

    public static function actualizarCantidadProductoDelCarrito(){
        header('Content-Type: application/json');

        $getContent =  file_get_contents('php://input');
        $producto = json_decode($getContent, true);

        if(is_auth()){

            if(!is_array($producto)){
                http_response_code(400);
                echo json_encode(['error' => 'El dato recibido no es un array']);
                exit;
            }

            if(!isset($producto['producto_id'], $producto['cantidad']) ||
            filter_var($producto['producto_id'], FILTER_VALIDATE_INT) === false ||
            filter_var($producto['cantidad'], FILTER_VALIDATE_INT) === false){

                http_response_code(400);
                echo json_encode(['error' => 'El dato recibido no contiene enteros']);
                exit;
            }
                
            if($producto['producto_id'] <= 0 || $producto['cantidad'] <= 0){
                http_response_code(422);
                echo json_encode(['error' => 'El dato recibido no es valido (menor o igual a cero)']);
                exit;
            }

            $carrito = Carrito::where('usuario_id', $_SESSION['id']);
            if($carrito == null){
            http_response_code(404);
            echo json_encode(['error' => 'Carrito no encontrado']);
            exit;
            }

            $productoEncontrado = CarritoProducto::whereArray(['carrito_id' => $carrito->id,'producto_id' => $producto['producto_id']]);
            if(empty($productoEncontrado)){
                http_response_code(404);
                echo json_encode(['error' => 'No se encontró  el producto en el carrito']);
                exit;
            }

            $productoEncontrado[0]->cantidad = $producto['cantidad'];
            $productoEncontrado[0]->guardar();
        }else{
            echo json_encode(['error' => false, 'mensaje' => 'El usuario no esta logueado, proceso omitido']);
            exit;
        }

        echo json_encode(['error' => false, 'mensaje' => 'Cantidad actualizada correctamente']);
        exit;
    }

    public static function eliminarProductoDelCarrito(){
        header('Content-Type: application/json');

        $getContent =  file_get_contents('php://input');
        $input = json_decode($getContent, true);
        $productoId = filter_var($input, FILTER_VALIDATE_INT);

        if(!$productoId || $productoId < 1){
            http_response_code(400);
            echo json_encode(['error' => 'ID no válido']);
            exit;
        }

        if(is_auth()){
            $carrito = Carrito::where('usuario_id', $_SESSION['id']);
            if($carrito == null){
            http_response_code(404);
            echo json_encode(['error' => 'Carrito no encontrado']);
            exit;
            }

            $productoEncontrado = CarritoProducto::whereArray(['carrito_id' => $carrito->id,'producto_id' => $productoId]);
            if(empty($productoEncontrado)){
                http_response_code(404);
                echo json_encode(['error' => 'Error al borrar el producto del carrito']);
                exit;
            }
            $productoEncontrado[0]->delete();
        }else{
            echo json_encode(['error' => false, 'mensaje' => 'El usuario no esta logueado, proceso omitido']);
            exit;
        }
       
        echo json_encode(['error' => false, 'mensaje' => 'Producto eliminado correctamente']);
        exit;
    }

  
}