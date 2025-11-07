<?php

namespace Controllers;

use MVC\Router;
use Model\Token;
use Classes\Email;
use Model\Usuario;
use Model\UsuarioSesion;


class LoginController{
    public static function login(Router $router){
        if(is_auth()){
            header('Location: /usuario');
            exit();
            
        }else{
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $reenviarConfirmacion = false;
                $usuario = new Usuario($_POST);
                $alertas= $usuario->validar_login();
                if(empty($alertas)){
                    $usuario = Usuario::where('email', $usuario->email);
                    if($usuario){
                        $alertas= $usuario->validar_contraseña($_POST['password']);
                        if(empty($alertas)){
                            if($usuario->confirmado == 1){
                                if($usuario->baneo == 1){
                                    $alertas = Usuario::setAlerta('error', 'La cuenta en la que intenta loguearse se encuentra baneada');
                                }else{
                                    session_start();
                                    session_regenerate_id(true);
                                    $_SESSION['id'] = $usuario->id;
                                    $_SESSION['nombre'] = $usuario->nombre;
                                    $_SESSION['apellido'] =  $usuario->apellido;
                                    $_SESSION['email'] = $usuario->email;
                                    $_SESSION['telefono'] = $usuario->telefono;
                                    if($usuario->admin == 1){
                                        $_SESSION['rol'] = 'admin';
                                    }else{
                                        $_SESSION['rol'] = 'usuario';
                                    }

                                    if(isset($_POST['recuerdame']) && $_POST['recuerdame'] == 'si'){
                                        $token = bin2hex(random_bytes(32));
                                        $recordarSesion = new UsuarioSesion();
                                        $recordarSesion->setUsuario();
                                        $recordarSesion->setToken($token);
                                        $recordarSesion->setFechaCreacion();
                                        $recordarSesion->guardar();
                                         
                                        setcookie('recordarme', $token, time() + (86400 * 30), "/", "", false, true);
                                    }

                                    if(is_admin()){
                                        header('Location: /admin');
                                    }else{
                                        header('Location: /usuario');
                                    }
                                }
                                
                            }else{
                                $alertas = Usuario::setAlerta('error', 'Cuenta no confirmada, desea que le reenviemos la confirmacion?');
                                $reenviarConfirmacion = true;
                            }                       
                        }else{
                            $alertas = Usuario::setAlerta('error', 'E-mail o contraseña incorrectos');
                        }
                    }else{
                        $alertas = Usuario::setAlerta('error', 'E-mail o contraseña incorrectos');
                    }
    
                }
            }
            $router->render('auth/login',[
                'titulo' => 'Iniciar Sesión',
                'usuario' => $usuario,
                'alertas' => $alertas,
                'reenviarConfirmacion' => $reenviarConfirmacion
            ]);
        }  
    }

    public static function reenviarConfirmacion(){
        if(is_auth()){
            header('Location: /usuario');
            exit();
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = array_shift(Usuario::thisWhere(['id', 'nombre'], 'email', $_POST['email']));

            if($usuario){
                $token = new Token(
                    ['usuario_id' => $usuario->id,
                    'accion' => 'Confirmar Correo']
                );
            
                $mail = new Email($_POST['email'], $usuario->nombre, $token->token, $token->selector, $token->accion);
                $mail->enviarCorreo();

                $token->hashearToken();
                $resultado = $token->guardar();
                if($resultado){
                    header('Location: /mensaje');
                }   
            }

                                 
        }
    }

    public static function logout(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            if(isset($_COOKIE['recordarme'])){
                $tokenHash = hash('sha256', $_COOKIE['recordarme']);
                $sesionExistente = UsuarioSesion::where('token', $tokenHash);
                if($sesionExistente){
                    $sesionExistente->delete();
                    setcookie('recordarme', '', time() - 3600, '/');
                }
            }

            $_SESSION = [];
            
            header('Location: /');
            exit();
        }

    }
    public static function registro(Router $router){
        if(is_auth()){
            header('Location: /usuario');
            exit();
            
        }else{
            $errores = [];
            $usuario = new Usuario();
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $usuario->sincronizar($_POST);
                $errores = $usuario->validar_registro();
                if(empty($errores)){
                    $resultado = $usuario->where('email', $usuario->email);
                    if($resultado){
                        $errores['email'] = 'E-mail ya registrado';
                    }else{
                        $usuario->hashearPassword();    
                        $usuario->setFechaCreacion();
                        $resultado = $usuario->guardar();

                        $token = new Token(
                            ['usuario_id' => $resultado['id'],
                            'accion' => 'Confirmar Correo']
                        );
                  
                        $mail = new Email($usuario->email, $usuario->nombre, $token->token, $token->selector, $token->accion);
                        $mail->enviarCorreo();

                        $token->hashearToken();
                        $resultado = $token->guardar();
                        if($resultado){
                            header('Location: /mensaje');
                        }                        
                    }
                }
            }
            $router->render('auth/registro',[
            'titulo' => 'Registro',
            'usuario' => $usuario,
            'errores' => $errores
        ]);
        }
        
    }

    public static function mensaje(Router $router){
        if(is_auth()){
            header('Location: /usuario');
            exit();
        }
        
        $router->render('auth/mensaje',[
            'titulo' => 'Termina tu registro',
        ]);
    }

    public static function olvide(Router $router){
        if(is_auth()){
            header('Location: /usuario');
            exit();
        }
        $usuario = new Usuario();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_correo();

            if(empty($alertas)){
                $alertas = Usuario::setAlerta('exito', 'Si el E-mail es valido se le enviará un correo con las instrucciones');
                $usuario = $usuario->where('email', $usuario->email);
                if($usuario){
                    $token = new Token([
                        'usuario_id' => $usuario->id,
                        'accion' => 'Recuperar contraseña'
                    ]);
                    $mail = new Email($usuario->email, $usuario->nombre , $token->token, $token->selector, $token->accion);
                    $mail->enviarCorreo();  
                    $token->hashearToken();
                    $token->guardar();
                }
            }
        }
        $router->render('auth/olvide',[
            'titulo' => 'Recupera tu contraseña',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router){
        if(is_auth()){
            header('Location: /usuario');
            exit();
        }

        $selector = filter_var($_GET['selector'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $token = Token::where('selector', $selector);   
        $tokenInput = $_GET['token']; 
        $tokenValido = true;
        $iniciarSesion = false;

        if(isset($token) && $token->validarToken($tokenInput)){
            $usuario = Usuario::where('id', $token->usuario_id);
            if($usuario){
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $usuario->sincronizar($_POST);

                    $alertas = $usuario->validar_nueva_contraseña();
        
                    if(empty($alertas)){
                        $alertas = Usuario::setAlerta('exito', 'Nuevo password seteado correctamente');
                        $usuario->hashearPassword();
                        $usuario->confirmado = 1;
                        $usuario->guardar();
                        $resultado = $token->delete();
                        $tokenValido = false;
                        $iniciarSesion = true;
                    }
                }
            }else{
                $alertas = Usuario::setAlerta('error', 'Token no valido o expirado');
                $tokenValido = false;
            }
        }else{
           $alertas = Usuario::setAlerta('error', 'Token no valido o expirado');
           $tokenValido = false;
        }
        
        $router->render('auth/recuperar',[
            'titulo' => 'Recupera tu contraseña',
            'alertas' => $alertas,
            'tokenValido' => $tokenValido,
            'iniciarSesion' => $iniciarSesion
        ]);
    }
}