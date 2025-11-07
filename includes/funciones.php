<?php

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Model\Usuario;
use Model\UsuarioSesion;

date_default_timezone_set('Europe/Madrid');

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function verificarSesion(){
    $tokenHash = hash('sha256', $_COOKIE['recordarme']);
    $sesionExistente = UsuarioSesion::where('token', $tokenHash);

    if($sesionExistente){
        $usuario = array_shift(Usuario::thisWhere(['id', 'nombre', 'apellido', 'email', 'telefono', 'admin'], 'id', $sesionExistente->usuario_id));
        if($usuario){
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
        }
    }
}

function is_auth(){
    if(!isset($_SESSION)){
        session_start();
        session_regenerate_id(true);
    }
    return isset($_SESSION['id']) && !empty($_SESSION);
}

function is_admin(){
    if(!isset($_SESSION)){
        session_start();
        session_regenerate_id(true);
    }
    return isset($_SESSION['rol']) && !empty($_SESSION['rol'] && $_SESSION['rol'] === 'admin');
}

function is_banned(){
    $usuario = Usuario::thisWhere(['baneo'], 'id', $_SESSION['id']);
    $usuario = array_shift($usuario);
    
    return $usuario->baneo == 1;
}


 
function setAlertaSession($tipo, $mensaje){
    if(!isset($_SESSION)){
        session_start();
        session_regenerate_id(true);
    }

    $_SESSION['alerta'][$tipo][]= $mensaje;
}

function getAlertaSession(){
        $alerta = $_SESSION['alerta'];
        unset($_SESSION['alerta']);
       return $alerta;
}

function procesarImagen ($imagenOriginal, $nombreImagen, $crearMiniatura = false){
    $ruta = __DIR__ . '/../public/img/productos';   
    $manager = new ImageManager(new Driver());
    $miniatura = '';

    $imagen = $manager->read($imagenOriginal);
    $imagen->resize(500,500);
    $imagen->toWebp(90);
    $imagen->save($ruta.'/'.$nombreImagen. '.webp');

    if($crearMiniatura){
        $miniatura = $manager->read($imagenOriginal);
        $miniatura->resize(200,200);
        $miniatura->toWebp(80);
        $miniatura->save($ruta.'/'.$nombreImagen. '_thumb.webp');
    }
                    
}

function borrarImagen ($ruta){
    if(file_exists($ruta . '.webp')){
        unlink($ruta . '.webp');
    }

     if(file_exists($ruta . '_thumb.webp')){
        unlink($ruta . '_thumb.webp');
    }
}

function rutaActual($ruta, $admin = false){
    $actual = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if($admin == false){
        $clase = 'ruta_actual';
    }else{
        $clase = 'ruta_actual--admin';
    }

    return $actual === $ruta ? $clase : '';
}