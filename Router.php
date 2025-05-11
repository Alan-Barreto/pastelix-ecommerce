<?php

namespace MVC;

class Router{
    public array $rutasGET = [];
    public array $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if($fn){
            call_user_func($fn, $this);
        }
    }

    public function render($view, $datos = [], $layout = 'layout')
    {
        foreach($datos as $key => $value){
            $$key = $value;
        }

        
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();    

        
        include_once __DIR__ . "/views/". $layout .".php";  //Agregar luego la verificacion de si es pagina de admin o no y así cambiar al layout correspondiente
        
    }

}