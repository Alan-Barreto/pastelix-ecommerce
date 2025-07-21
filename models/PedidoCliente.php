<?php

namespace Model;

class PedidoCliente extends ActiveRecord{

    protected static $tabla = 'pedido_cliente';
    protected static $columnasDB = ['id', 'pedido_id', 'nombre', 'apellido', 'email', 'telefono'];

    public $id;
    public $pedido_id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->pedido_id = $args['pedido_id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function setPedidoId($pedido_id){
        $this->pedido_id = $pedido_id;
    }

    public function setPedidoTelefono($telefono){
        $this->telefono = $telefono;
    }
}