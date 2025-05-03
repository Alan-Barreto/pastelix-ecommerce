<?php

namespace Model;

use DateTime;

class Token extends ActiveRecord{
    protected static $tabla = 'tokens';
    protected static $columnasDB = ['id', 'usuario_id', 'selector', 'token', 'accion', 'nuevoEmail', 'nuevoPassword', 'fecha_creacion', 'fecha_expiracion'];

    public $id;
    public $usuario_id;
    public $selector;
    public $token;
    public $accion;
    public $nuevoEmail;
    public $nuevoPassword;
    public $fecha_creacion;
    public $fecha_expiracion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? '';
        $this->selector = bin2hex(random_bytes(8));
        $this->token = bin2hex(random_bytes(32));
        $this->accion = $args['accion'] ?? '';
        $this->nuevoEmail = $args['nuevoEmail'] ?? null;
        $this->nuevoPassword = $args['nuevoPassword'] ?? null;
        $this->fecha_creacion = date('Y-m-d H:i:s');
        $this->fecha_expiracion = date('Y-m-d H:i:s', strtotime('+10 minutes'));
    }

    public function hashearToken(){
        $this->token = password_hash($this->token, PASSWORD_DEFAULT);
    }

    public function hashearPassword(){
        $this->nuevoPassword = password_hash($this->nuevoPassword, PASSWORD_DEFAULT);
    }

    public function validarToken($token){
        $fechaActual = new DateTime();
        $expiracion = new DateTime($this->fecha_expiracion);

        return password_verify($token, $this->token) && $fechaActual < $expiracion;
    }
}