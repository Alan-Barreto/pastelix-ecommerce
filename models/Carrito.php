<?php

namespace Model;

class Carrito extends ActiveRecord{
    protected static $tabla = 'carritos';
    protected static $columnasDB = ['id', 'usuario_id'];

    public $id;
    public $usuario_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? null;
    }
}