<?php

namespace Model;

class UsuarioSesion extends ActiveRecord{
    protected static $tabla = 'usuario_sesion';
    protected static $columnasDB = ['id', 'usuario_id', 'token', 'fecha_creacion'];

    public $id;
    public $usuario_id;
    public $token;
    public $fecha_creacion;

    public function setUsuario(){
        $this->usuario_id = $_SESSION['id'];
    }

    public function setToken($token){
        $this->token = hash('sha256', $token);
    }

    public function setFechaCreacion(){
        $this->fecha_creacion = date('Y-m-d H:i:s');
    }
}