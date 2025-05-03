<?php

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