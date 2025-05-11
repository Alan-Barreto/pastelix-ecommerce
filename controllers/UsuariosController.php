<?php

namespace Controllers;

use Classes\Email;
use Model\Direccion;
use MVC\Router;
use Model\Token;
use Model\Usuario;

class UsuariosController{
    public static function usuario(Router $router){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{
            $alertas = [];
            $nuevosDatos = [
                'nombre' => $_SESSION['nombre'],
                'apellido' => $_SESSION['apellido'],
                'email' => $_SESSION['email']
            ];
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
                if(isset($_POST['nombre'])){
                    $nuevosDatos['nombre']= $_POST['nombre'];
                    $nuevosDatos['apellido'] = $_POST['apellido'];
                    if(empty($_POST['nombre']) || empty($_POST['apellido'])){
                        $alertas = usuario::setAlerta('error', 'Ninguno de los espacios puede ir vacio');
                    }
                   
                    if(empty($alertas)){
                        $usuario = usuario::where('id', $_SESSION['id']);
                        if($_POST['nombre'] === $usuario->nombre && $_POST['apellido'] === $usuario->apellido){
                            $alertas = usuario::setAlerta('error', 'No hubo cambios en los datos, actualizacion cancelada');
                        }else{
                            $usuario->sincronizar($_POST);
                            $usuario->guardar();
                            setAlertaSession('exito', 'Datos actualizados con exito');
                            header('Location: /usuario');
                            exit;
                        }
                        
                    }
                }
                if(isset($_POST['email'])){
                    
                    if(!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $alertas = usuario::setAlerta('error', 'E-mail no valido');
                    }else{
                        $usuario = usuario::where('email', $_POST['email']);
                        if($usuario){
                        $alertas = usuario::setAlerta('error', 'El E-mail ya está en uso');
                        }else{
                            $usuario = usuario::where('email', $_SESSION['email']);
                            $token = new Token([
                                'usuario_id' => $usuario->id,
                                'accion' => 'Cambiar Correo',
                                'nuevoEmail' => $_POST['email']
                            ]);
                            $mail = new Email($usuario->email, $usuario->nombre, $token->token, $token->selector, $token->accion);
                            $mail->enviarCorreo();
                            $token->hashearToken();
                            $token->guardar();

                            setAlertaSession('exito', 'Se enviara un correo de confirmacion a su E-mail actual');
                            header('Location: /usuario');
                            exit;
                        }
                    }
                }
                if(isset($_POST['contraseñaActual'])){
                  
                    if(empty($_POST['contraseñaActual']) || empty($_POST['contraseñaNueva'])){
                        $alertas = Usuario::setAlerta('error', 'Los campos no pueden ir vacios');
                    }else{
                        $usuario = Usuario::where('id', $_SESSION['id']);
                        
                        $usuario->setear_cambio_contraseña($_POST);
                        $alertas = $usuario->validar_cambio_contraseña();
                        
                        if(empty($alertas)){
                            $token = new Token([
                                'usuario_id' => $usuario->id,
                                'accion' => 'Cambiar Contraseña',
                                'nuevoPassword' => $usuario->contraseñaNueva
                            ]);

                            $mail = new Email($usuario->email, $usuario->nombre, $token->token, $token->selector, $token->accion);
                            $mail->enviarCorreo();
                            $token->hashearToken();
                            $token->hashearPassword();
                            $token->guardar();
                        
                            setAlertaSession('exito', 'Se enviara un correo de confirmacion a su E-mail');
                            header('Location: /usuario');
                            exit;                
                        }                      
                    }
                }
            }
            $router->render('/usuario/usuario',[
                'titulo' => 'Mi Cuenta',
                'alertas' => $alertas,
                'nuevosDatos' => $nuevosDatos
            ]);
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


            $router->render('/usuario/pedidos',[
                'titulo' => 'Mi Cuenta - Pedidos'
            ]);
        }   
    }

    public static function direcciones(Router $router){
        if(!is_auth()){
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

    public static function crear(Router $router){
        if(!is_auth()){
            header('Location: /');
            exit();
        }else{
            $direccion = new Direccion();
            $alertas = [];
           if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $direccion->sincronizar($_POST);
                $alertas = $direccion->validarFormulario();
                if(empty($alertas)){
                    $direccion->usuario_id = $_SESSION['id'];
                    $direccion->setFechaCreacion();
                    $direccion->guardar();
                    setAlertaSession('exito', 'Direccion Creada con exito');
                    header('Location: /usuario/direcciones');
                }
           }
        
            $router->render('/usuario/direcciones/crear',[
                'titulo' => 'Mi Cuenta - Direcciones/crear',
                'direccion' => $direccion,
                'alertas' => $alertas
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
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $direccion->sincronizar($_POST);
                    $alertas = $direccion->validarFormulario();

                    if(empty($alertas)){
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
                'alertas' => $alertas
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
                $direccion->delete();
                setAlertaSession('exito', 'Direccion eliminada con exito');
                header('Location: /usuario/direcciones');
                exit();
           }
        }
    }
}