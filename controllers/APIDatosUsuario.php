<?php

namespace Controllers;

use Model\Token;
use Model\Pedido;
use Classes\Email;
use Model\Usuario;
use Model\Producto;
use Model\PedidoProducto;
use Model\PedidoDireccion;

class APIDatosUsuario{
    public static function recuperarPedido(){
        $pedidoId = $_GET['id'];

        if(!is_auth()){
            http_response_code(401);
            echo json_encode(['error' => true, 'mensaje' => 'El usuario no esta logueado']);
            exit;
        }
        if(!filter_var($pedidoId, FILTER_VALIDATE_INT)){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no es un int']);
            exit;
        }

        $pedidoBuscado = Pedido::thisWhere(['usuario_id', 'fecha', 'total', 'entrega'], 'id', $pedidoId); 

        if(empty($pedidoBuscado)){
            http_response_code(404);
            echo json_encode(['error' => true, 'mensaje' => 'No se encontró el pedido']);
            exit;
        }
        
        $UsuarioId = $pedidoBuscado[0]->usuario_id;
        if($UsuarioId !== $_SESSION['id']){
            http_response_code(403);
            echo json_encode(['error' => true, 'mensaje' => 'No tienes permiso para ver este pedido']);
            exit;
        }

        $pedidoProductos = PedidoProducto::thisWhere(['producto_id', 'cantidad', 'precio_unitario'], 'pedido_id', $pedidoId);

        if(empty($pedidoProductos)){
            http_response_code(404);
            echo json_encode(['error' => true, 'mensaje' => 'Error al buscar los productos del pedido']);
            exit;
        }
        $arrayProductosId = [];
        foreach($pedidoProductos as $producto){ 
            $arrayProductosId[] = $producto->producto_id;
        }
        $listaProductosId = implode(", ", $arrayProductosId);

        $datosProductosBuscados = Producto::thisWhere(['id', 'nombre', 'imagen'], 'id', $listaProductosId, 'IN', 'FIELD');

        $pedidoProductosReordenado = [];

        foreach($pedidoProductos as $producto){
            $pedidoProductosReordenado[$producto->producto_id] = [
                'cantidad' => $producto->cantidad,
                'precio_unitario' => $producto->precio_unitario
            ]; 
        }

        $listaProductos = [];

        foreach($datosProductosBuscados as $producto){
            $listaProductos[] = [
                'nombre' => $producto->nombre,
                'precio' => $pedidoProductosReordenado[$producto->id]['precio_unitario'],
                'cantidad' => $pedidoProductosReordenado[$producto->id]['cantidad'],
                'imagen' => $producto->imagen
            ];
        }

        $datosPedido = [
            'numeroPedido' => $pedidoId,
            'fecha' => $pedidoBuscado[0]->fecha,
            'total' => $pedidoBuscado[0]->total
        ];

        if($pedidoBuscado[0]->entrega === 'domicilio'){
            $direccionBuscada = PedidoDireccion::thisWhere(['calle', 'ciudad', 'provincia', 'codigo_postal', 'pais_nombre'], 'pedido_id',$pedidoId);

            if(!$direccionBuscada){
                 http_response_code(404);
                echo json_encode(['error' => true, 'mensaje' => 'Error al buscar la direccion del pedido']);
                exit;
            }

            $direccionPedido = [
                'calle' => $direccionBuscada[0]->calle,
                'ciudad' => $direccionBuscada[0]->ciudad,
                'provincia' => $direccionBuscada[0]->provincia,
                'codigoPostal' => $direccionBuscada[0]->codigo_postal,
                'pais' => $direccionBuscada[0]->pais_nombre
            ];
        }

        echo json_encode(['error' => false, 'datos' => ['datos' => $datosPedido, 'productos' => $listaProductos, 'direccion' => $direccionPedido ?? '']]);
        exit;
    }

    private static function validarDatos($datos){
        if(!is_auth()){
            http_response_code(401);
            echo json_encode(['error' => true, 'mensaje' => 'El usuario no esta logueado']);
            exit;
        }

        $errores = Usuario::validarCambioMisDatos($datos);

        if(!empty($errores)){
            http_response_code(422);
            echo json_encode([
                'error' => true, 
                'mensaje' => 'Error en algun campo del formulario', 
                'errores' => $errores
            ]);
            exit;
        }
    }

    public static function validarFormularioUsuario(){
        self::validarDatos($_POST);

        echo json_encode([
            'error' => false, 
            'mensaje' => 'Datos verificados con exito'
        ]);
        exit;
    }

    public static function guardarNuevosDatos(){
        self::validarDatos($_POST);
        $usuarioId = $_SESSION['id'];
        $contraseñaNueva = $_POST['contraseñaNueva'] ?? '';
        $tipoFormulario = $_POST['tipo_formulario'];

        switch($tipoFormulario){
            case 'datos':
                $usuario = Usuario::where('id', $usuarioId);
                $usuario->sincronizar($_POST);
                $usuario->guardar();
                $mensaje = 'Datos actualizados con exito';
                            
                break;

            case 'correo':
                $usuario = array_shift(Usuario::thisWhere(['nombre', 'email'],'id', $usuarioId));
                $token = new Token([
                    'usuario_id' => $usuarioId,
                    'accion' => 'Cambiar Correo',
                    'nuevoEmail' => $_POST['correo']
                ]);
                $mail = new Email($usuario->email, $usuario->nombre, $token->token, $token->selector, $token->accion);
                $mail->enviarCorreo();
                $token->hashearToken();
                $token->guardar();
                
                $mensaje = 'Se enviara un correo de confirmacion a su E-mail actual';

                break;

            case 'contraseña':
                 $usuario = array_shift(Usuario::thisWhere(['nombre', 'email'],'id', $usuarioId));

                $token = new Token([
                    'usuario_id' => $usuarioId,
                    'accion' => 'Cambiar Contraseña',
                    'nuevoPassword' => $contraseñaNueva
                ]);

                $mail = new Email($usuario->email, $usuario->nombre, $token->token, $token->selector, $token->accion);
                $mail->enviarCorreo();
                $token->hashearToken();
                $token->hashearPassword();
                $token->guardar();
            
                $mensaje = 'Se enviara un correo de confirmacion a su E-mail';
      
                break;
        }
              
        echo json_encode([
            'error' => false, 
            'mensaje' => $mensaje,
            'datos' => $usuario
        ]);
        exit;
    }
}