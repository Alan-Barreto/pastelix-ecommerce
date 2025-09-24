<?php

namespace Controllers;

use MVC\Router;
use Model\Token;
use Model\Pedido;
use Classes\Email;
use Model\Usuario;
use Model\Direccion;

class UsuariosController{
    public static function usuario(Router $router){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{
            if(is_banned()){
                $_SESSION = [];
                header('Location: /');
                exit();
            }else{
                $router->render('/usuario/usuario',[
                    'titulo' => 'Mi Cuenta'
                ]);
            }
        }   
    }

    public static function actualizar(Router $router){
        $selector = filter_var($_GET['selector'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $token = Token::where('selector', $selector);
        $tokenInput = $_GET['token']; 

        if(isset($token) && $token->validarToken($tokenInput)){
            $usuario = Usuario::where('id', $token->usuario_id);
            if($token->accion === 'Confirmar Correo'){

                $alertas = Usuario::setAlerta('exito', 'Cuenta confirmada');
                $usuario->confirmado = 1;
                $usuario->guardar();
                $resultado = $token->delete();
            }else{
                if(is_auth()){
                    if($_SESSION['id'] === $token->usuario_id){

                        switch($token->accion){
                            case 'Cambiar Contraseña':
                                $usuario->password = $token->nuevoPassword;
                                $usuario->guardar();
                                $resultado = $token->delete();
                                if($resultado){ 
                                    $alertas = Token::setAlerta('exito', 'Contraseña cambiada con exito, puede cerrar esta pestaña');
                                }else{
                                    $alertas = Token::setAlerta('error', 'Hubo un error gestionando su peticion');
                                }
                            break;

                            case 'Cambiar Correo':
                                $tokenConfirmacion = new Token([
                                    'usuario_id' => $usuario->id,
                                    'accion' => 'Confirmar Correo Nuevo',
                                    'nuevoEmail' => $token->nuevoEmail
                                ]);
                
                                $mail = new Email($token->nuevoEmail, $usuario->nombre, $tokenConfirmacion->token, $tokenConfirmacion->selector, $token->accion);
                                $mail->enviarCorreo();
                                $tokenConfirmacion->hashearToken();
                    
                                $tokenConfirmacion->guardar();
                                $resultado = $token->delete();
                
                                if($resultado){ 
                                    $alertas = Token::setAlerta('exito', 'Se le enviara un correo de confirmacion a la nueva dirección, puede cerrar esta pestaña');
                                }else{
                                    $alertas = Token::setAlerta('error', 'Hubo un error gestionando su peticion');
                                }
                            break;

                            case 'Confirmar Correo Nuevo':
                                $usuario->email = $token->nuevoEmail;
                                $usuario->guardar();
                                $resultado = $token->delete();
                                //Tal vez faltaria enviar confirmacion de correo al neuvo email y no hacer el cambio hasta entonces
                                if($resultado){ 
                                    $alertas = Token::setAlerta('exito', 'Correo cambiado con exito, puede cerrar esta pestaña');
                
                                }else{
                                    $alertas = Token::setAlerta('error', 'Hubo un error gestionando su peticion');
                                }
                            break;
                        }
                    }else{
                        $alertas = Token::setAlerta('error', 'Token no valido o expirado');
                    }
                }else{
                    $alertas = Token::setAlerta('error', 'Para realizar esta accion necesitas estar logueado');
                }    
            }         
        }else{
            $alertas = Token::setAlerta('error', 'Token no valido o expirado');
        }

        $router->render('usuario/actualizar',[
            'alertas' => $alertas,
            'titulo' => 'Actualiza los datos de tu cuenta'
        ]);
    }

    public static function pedidos(Router $router){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{
            if(is_banned()){
                $_SESSION = [];
                header('Location: /');
                exit();
            }else{
                $listaPedidos = Pedido::thisWhere(['id', 'fecha', 'total', 'entrega'], 'usuario_id', $_SESSION['id']);

                $router->render('/usuario/pedidos',[
                    'titulo' => 'Mi Cuenta - Pedidos',
                    'listaPedidos' => $listaPedidos
                ]);
            }
            
        }   
    }

    public static function direcciones(Router $router){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{
            if(is_banned()){
                $_SESSION = [];
                header('Location: /');
                exit();
            }else{
                $direcciones = Direccion::allWhere('usuario_id', $_SESSION['id'], 'ASC');
            
                $router->render('/usuario/direcciones/direcciones',[
                    'titulo' => 'Mi Cuenta - Direcciones',
                    'direcciones' => $direcciones
                ]);
            }
        }   
    }

    public static function crear(Router $router){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{
            $direccion = new Direccion();
            $paisesAceptados = Direccion::getPaisesAceptados();
            $alertas = [];
           if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $direccion->sincronizar($_POST);
                $alertas = $direccion->validarFormulario();
                if(empty($alertas)){
                    $direccion->usuario_id = $_SESSION['id'];
                    $direccion->setPaisCodigo();
                    $direccion->setPaisNombre();
                    $direccion->setFechaCreacion();

                    $contadorDirecciones = Direccion::count('usuario_id', $_SESSION['id']);
                    if($contadorDirecciones === 0){
                        $direccion->predeterminada = 1;
                    }

                    $direccion->guardar();
                    setAlertaSession('exito', 'Direccion Creada con exito');
                    header('Location: /usuario/direcciones');
                }
           }
        
            $router->render('/usuario/direcciones/crear',[
                'titulo' => 'Mi Cuenta - Direcciones/crear',
                'direccion' => $direccion,
                'alertas' => $alertas,
                'paises' => $paisesAceptados
            ]);
        }   
    }

    public static function editar(Router $router){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{

           $direccion = Direccion::validarIdDireccion();
                      
           if(!$direccion){
                header('Location: /usuario/direcciones');
                exit();
           }else{
                $paisesAceptados = Direccion::getPaisesAceptados();
                $direccion->pais = $direccion->pais_codigo;
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $direccion->sincronizar($_POST);
                    $alertas = $direccion->validarFormulario();
                    if(empty($alertas)){
                        $direccion->setPaisCodigo();
                        $direccion->setPaisNombre();
                        $direccion->setFechaActualizacion();
                        $direccion->guardar();
                        setAlertaSession('exito', 'Direccion actualizada con exito');
                        header('Location: /usuario/direcciones');   
                    }
                }
           }
            
            $router->render('/usuario/direcciones/editar',[
                'titulo' => 'Mi Cuenta - Direcciones/editar',
                'direccion' => $direccion,
                'alertas' => $alertas,
                'paises' => $paisesAceptados
            ]);
        }   
    }

    public static function borrar(){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{
            $direccion = Direccion::validarIdDireccion();
            if(!$direccion){
                header('Location: /usuario/direcciones');
                exit();
           }else{
                $direccionPredeterminada = false;
                if($direccion->predeterminada == 1){
                    $direccionPredeterminada = true;

                    
                }
                $direccion->delete();
                if($direccionPredeterminada == true){
                    $nuevaDireccionPredetermianda = Direccion::where('usuario_id', $_SESSION['id']);
                    if($nuevaDireccionPredetermianda){
                        $nuevaDireccionPredetermianda->predeterminada = 1;
                        $nuevaDireccionPredetermianda->guardar();
                    } 
                }
                setAlertaSession('exito', 'Direccion eliminada con exito');
                header('Location: /usuario/direcciones');
                exit();
           }
        }
    }
}