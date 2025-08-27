<?php

namespace MVC;

class Router{
    public array $rutasGET = [];
    public array $rutasPOST = [];
    public array $rutasPUT = [];
    public array $rutasDELETE = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function put($url, $fn){
        $this->rutasPUT[$url] = $fn;
    }

    public function delete($url, $fn){
        $this->rutasDELETE[$url] = $fn;
    }

    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch($metodo){
            case 'GET':
                $fn = $this->rutasGET[$urlActual] ?? null; 
                break;

            case 'POST':
                $fn = $this->rutasPOST[$urlActual] ?? null;
                
                break;

            case 'PUT':
                $fn = $this->rutasPUT[$urlActual] ?? null;
                break;

            case 'DELETE':
                $fn = $this->rutasDELETE[$urlActual] ?? null;            
                break;
        }
        // if($metodo === 'GET'){
        //     $fn = $this->rutasGET[$urlActual] ?? null;
        // }else{
        //     $fn = $this->rutasPOST[$urlActual] ?? null;
        // }

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

        
        include_once __DIR__ . "/views/". $layout .".php";
        
    }

}