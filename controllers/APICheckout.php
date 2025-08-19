<?php

namespace Controllers;

use Exception;
use Model\Carrito;
use Model\CarritoProducto;
use Model\Pedido;
use Model\Usuario;
use Model\Producto;
use Model\Direccion;
use Model\PedidoCliente;
use Model\PedidoDireccion;
use Model\PedidoProducto;

class APICheckout{

    //Revisa si el usuario esta logueado y devuelve true o false segun el resultado
    public static function verificarLogin(){
        if(is_auth()){
            echo json_encode(true);
            exit;
        }else{
            echo json_encode(false);
            exit;
        }
    }

    public static function recuperarDirecciones(){
        $usuarioId = $_SESSION['id'];
        $direcciones = Direccion::thisWhere(['id', 'calle', 'ciudad','provincia', 'codigo_postal', 'pais_nombre','predeterminada'],'usuario_id', $usuarioId);
        if(empty($direcciones)){   
            echo json_encode(['error'  => false, 'mensaje' => 'No se pudo recuperar las direcciones', 'direcciones' => $direcciones]);
            exit;
        }

        foreach($direcciones as $direccion){
            $direccion->pais = $direccion->pais_nombre;
            unset($direccion->usuario_id);
            unset($direccion->fecha_creacion);
            unset($direccion->fecha_actualizacion);
            unset($direccion->pais_codigo);
            unset($direccion->pais_nombre);
        }

        echo json_encode(['error' => false, 'mensaje' => 'Direcciones recuperadas exitosamente', 'direcciones' => $direcciones]);
        exit;
    }

    public static function guardarNuevaDireccion(){
        if(!is_auth()){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'El Usuario no esta logueado']);
            exit;
        }
        $direccion = new Direccion($_POST);
        $errores = $direccion->validarFormularioCheckout();

        if(!empty($errores)){
            http_response_code(422);
            echo json_encode(['error' => true, 'mensaje' => 'Error en algun campo del formulario', 'errores' => $errores]);
            exit;
        }
        
        $direccion->usuario_id = $_SESSION['id'];
        $direccion->setFechaCreacion();
        $direccion->setPaisCodigo();
        $direccion->setPaisNombre();

        $direccionesExistentes = Direccion::count('usuario_id', $_SESSION['id']);

        if($direccionesExistentes === 0){
            $direccion->predeterminada = 1;
        }
        $resultado = $direccion->guardar();
        if(!$resultado['resultado']){
            http_response_code(500);
            echo json_encode(['error' => true, 'mensaje' => 'Error al guardar']);
            exit;
        }
        $direccion->id = $resultado['id'];

        //Reformo $direccion para evitar enviar datos sin necesidad y mantener la estructura que espera el front
        $direccion->pais = $direccion->pais_nombre;

        unset($direccion->usuario_id);
        unset($direccion->fecha_creacion);
        unset($direccion->fecha_actualizacion);
        unset($direccion->pais_codigo);
        unset($direccion->pais_nombre);
    
        http_response_code(201);
        echo json_encode(['error' => false, 'mensaje' => 'Direccion guardada con exito', 'direccion' => $direccion]);
        exit;
    }

    public static function recuperarDatosProductos(){
        header('Content-Type: application/json');

        $getContent =  file_get_contents('php://input');
        $input = json_decode($getContent, true);

        $productosIds = [];
        if(!is_array($input)){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no es un array']);
            exit;
        }

        foreach($input as $producto){
            if(!isset($producto['producto_id']) || filter_var($producto['producto_id'], FILTER_VALIDATE_INT) === false){
                http_response_code(400);
                echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no contiene enteros']);
                exit;
            }
                
            if($producto['producto_id'] <= 0){
                http_response_code(422);
                echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no es valido (menor o igual a cero)']);
                exit;
            }

            $productosIds[] = $producto['producto_id'];
        }

        $productosIds = implode(", ", $productosIds);
        $productosDatos = Producto::thisWhere(['id', 'nombre', 'precio', 'imagen'], 'id', $productosIds, 'IN');


        echo json_encode(['error' => false, 'mensaje' => 'Datos recuperados con exito', 'productos' => $productosDatos]);
        exit;
    }

    public static function validarDatosFormulario(){
        $errores = [];
        $datosUsuario = new Usuario($_POST);
        $errores = $datosUsuario->validarFormularioCheckout();

        if($_POST['entrega'] === 'domicilio'){
            $direccionUsuario = new Direccion();
            if(is_auth()){
                if(!isset($_POST['direccionElegida'])){
                    $errores['direccionElegida'][] = 'Elija una dirección de envio o cree una nueva';
                }else{
                    if(!filter_var($_POST['direccionElegida'],FILTER_VALIDATE_INT) || ((int) $_POST['direccionElegida']) <= 0 ){
                        $errores['direccionElegida'][] = 'La direccion elegida es invalida por favor recargue la pagina o intente con otra';
                    }else{
                        $direccionBuscada = Direccion::whereArray(['id' => $_POST['direccionElegida'], 'usuario_id' => $_SESSION['id']]);
                        if(empty($direccionBuscada[0])){ 
                            http_response_code(404);
                            echo json_encode(['error' => true, 'mensaje' => 'La direccion buscada no existe o no pertenece al usuario']);
                            exit;
                        }

                        $direccionBuscada[0]->pais = $direccionBuscada[0]->pais_codigo;
                        
                        $direccionUsuario = $direccionBuscada[0];
                    
                    }  
                }
                
            }else{
                $direccionUsuario = new Direccion($_POST);
                $errores += $direccionUsuario->validarFormularioCheckout();

            }

            

            $direccionUsuarioNormalizada = [
                "calle" => $direccionUsuario->calle,
                "ciudad" => $direccionUsuario->ciudad,
                "codigo_postal" => $direccionUsuario->codigo_postal,
                "provincia" => $direccionUsuario->provincia,
                "pais" => $direccionUsuario->pais,
            ];
        }else if($_POST['entrega'] !== 'tienda'){
            $errores['entrega'][] = 'La opcion de entrega es invalida por favor recargue la pagina o intentelo mas tarde';
        }

        if(!empty($errores)){
            http_response_code(422);
            echo json_encode(['error' => true, 'mensaje' => 'Error en algun campo del formulario', 'errores' => $errores]);
            exit;
        }

        $datosCliente = new PedidoCliente($_POST);

        
        echo json_encode([
            'error' => false, 
            'mensaje' => 'Datos verificados con exito', 
            'datosCliente' => $datosCliente, 
            'direccionCliente' => $direccionUsuarioNormalizada ?? [], 
            'tipoEntrega' => $_POST['entrega']]);
        exit;
    }

    public static function guardarDatosPedido(){
        header('Content-Type: application/json');

        $getContent =  file_get_contents('php://input');
        $input = json_decode($getContent, true);

        if(!is_array($input)){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no es un array']);
            exit;
        }

        
        if(empty($input)){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'Los datos estan vacios']);
            exit;
        }

        if(!isset($input['datosCarrito']) || empty($input['datosCarrito'])){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'El carrito no existe o esta vacio']);
            exit;
        }

        if(!isset($input['datosCliente']) || empty($input['datosCliente'])){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'Los datos del cliente no existen o estan vacios']);
            exit;
        }

        if(!isset($input['tipoEntrega'])){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'El tipo de entrega no existe']);
            exit;
        }

        foreach($input['datosCliente'] as $dato=>$valor){
            if(trim($valor) == ''){
                http_response_code(400);
                echo json_encode(['error' => true, 'mensaje' => 'Los datos del cliente contienen elementos vacios']);
                exit;
            }else{
                switch($dato){
                    case 'email':
                        if(!filter_var($valor, FILTER_VALIDATE_EMAIL)){
                            http_response_code(400);
                            echo json_encode(['error' => true, 'mensaje' => 'El correo del cliente tiene un formato invalido']);
                            exit;
                        }
                    break;

                    case 'telefono':    
                        $telefonoNormalizado = preg_replace('/\D/', '', $valor);
                        if(trim($telefonoNormalizado) == '' || strlen($telefonoNormalizado) < 7 || strlen($telefonoNormalizado) > 15){
                            http_response_code(400);
                            echo json_encode(['error' => true, 'mensaje' => 'El telefono  del cliente tiene un formato invalido']);
                            exit;
                        }
                    break;
                }
            }
        }

        switch($input['tipoEntrega']){
            case 'tienda':
                //Dejo esto aqui por si al final agrego direcciones de tienda a futuro
                $pedidoDireccion = [];
            break;

            case 'domicilio':
                foreach($input['direccionCliente'] as $dato){
                    if(trim($dato) == ''){
                        http_response_code(400);
                        echo json_encode(['error' => true, 'mensaje' => 'Los datos de la direccion contienen elementos vacios']);
                        exit;
                    } 
                }
                //definir pedido_direccion
            break;

            default:
                http_response_code(400);
                echo json_encode(['error' => true, 'mensaje' => 'Tipo de entrega invalido']);
                exit;
            break;
        }


        $productosIdsArray = [];

        foreach($input['datosCarrito'] as $producto){
            if(!isset($producto['producto_id']) || filter_var($producto['producto_id'], FILTER_VALIDATE_INT) === false
               || !isset($producto['cantidad']) || filter_var($producto['cantidad'], FILTER_VALIDATE_INT) === false
            ){
                http_response_code(400);
                echo json_encode(['error' => true, 'mensaje' => 'Los datos de los productos no contienen enteros']);
                exit;
            }
            if($producto['producto_id'] <= 0 || $producto['cantidad'] <= 0){
                http_response_code(422);
                echo json_encode(['error' => true, 'mensaje' => 'Los datos de los productos no son validos (menor o igual a cero)']);
                exit;
            }
            $productosIdsArray[] = $producto['producto_id'];
        }

        $productosIds = implode(", ", $productosIdsArray);
        
        $preciosRecuperados = Producto::thisWhere(['id', 'precio'], 'id', $productosIds , 'IN');
       

        if(count($productosIdsArray) !== count($preciosRecuperados)){
            http_response_code(404);
            echo json_encode(['error' => true, 'mensaje' => 'No se pudo encontrar algún elemento del carrito']);
            exit;
        }

        $preciosReordenados = [];

        foreach($preciosRecuperados as $precioUnitario){
            $preciosReordenados[$precioUnitario->id]= [
                'precio' => $precioUnitario->precio
            ];
        }
        
        $totalPagado = 0;
        $carritoRearmado = [];

        foreach($input['datosCarrito'] as $producto){
            $totalPagado += $producto['cantidad'] * $preciosReordenados[$producto['producto_id']]['precio'];
            $carritoRearmado[] = [
                'pedido_id' => '',
                'producto_id' =>  $producto['producto_id'],
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $preciosReordenados[$producto['producto_id']]['precio']
            ];
        }
    

            $db = Pedido::getDB();
            $db->autocommit(false);
        try {
            
            $pedidoNuevo = new Pedido([
                'usuario_id' => $_SESSION['id'] ?? 1,
                'total' => $totalPagado,
                'entrega' => $input['tipoEntrega'],
                'estado' => 'pagado',
                'pedido_id_paypal' => $input['pedidoIdPaypal']
            ]);
            
            $pedidoNuevo->setFechaCreacion();

           $resultadoQuery1 = $pedidoNuevo->guardar();
            if (!$resultadoQuery1['resultado']) {
                throw new Exception("Error al guardar el pedido");
            }
            $pedidoCliente = new PedidoCliente($input['datosCliente']);
            $pedidoCliente->setPedidoTelefono($telefonoNormalizado);
            $pedidoCliente->setPedidoId($resultadoQuery1['id']);

            $resultadoQuery2 = $pedidoCliente->guardar();
            if (!$resultadoQuery2['resultado']) {
                throw new Exception("Error al guardar los datos del cliente");
            }

            foreach($carritoRearmado as &$producto){
                $producto['pedido_id'] = $resultadoQuery1['id'];
            }
            unset($producto);
            $arrayCarritoRearmado = [];
            foreach($carritoRearmado as $producto){
                $arrayCarritoRearmado[] = new PedidoProducto($producto);
            }
            $resultadoQuery3 = PedidoProducto::guardarVarios($arrayCarritoRearmado);
            if (!$resultadoQuery3) {
                throw new Exception("Error el carrito del pedido");
            }

            if(is_auth()){
                //Se revisa si el usuario esta logueado y de estarlo se busca su carrito
                $carritoId = Carrito::where('usuario_id', $_SESSION['id']);
                if (!$carritoId) {
                    throw new Exception("Error al buscar el carrito del usuario");
                }
                //Al encontrar el carrito se usa esa referencia para limpiar su contenido
                $resultadoQuery4 = CarritoProducto::limparCarrito($carritoId->id);
                if (!$resultadoQuery4){
                    throw new Exception("Error al limpiar el carrito del usuario");
                }
            }

            if($input['tipoEntrega'] == 'domicilio'){
                $direccionCliente = new PedidoDireccion($input['direccionCliente']);
                $direccionCliente->setPedidoId($resultadoQuery1['id']);
                $direccionCliente->setPaisCodigo($resultadoQuery1['id']);
                $direccionCliente->setPaisNombre($resultadoQuery1['id']);
                $resultadoQuery5 = $direccionCliente->guardar();

                if (!$resultadoQuery5['resultado']) {
                throw new Exception("Error al guardar la direccion del pedido");
                }
            }

            $db->commit();
        } catch (Exception  $e) {
            $db->rollback(); // Si algo falla, cancelamos todo
            http_response_code(500);
            echo json_encode(['error' => true, 'mensaje' => 'Error al guardar el pedido', 'detalles' => $e->getMessage()]);
            exit;
        }

        echo json_encode(['error' => false, 'mensaje' => 'Pedido guardado con exito']);
        exit;
    }

}