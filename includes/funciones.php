<?php

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

date_default_timezone_set('Europe/Madrid');

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
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