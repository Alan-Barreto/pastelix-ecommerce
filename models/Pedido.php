<?php

namespace Model;

class Pedido extends ActiveRecord{
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'usuario_id', 'fecha', 'total', 'entrega', 'estado', 'pedido_id_paypal'];

    public $id;
    public $usuario_id;
    public $fecha;
    public $total;
    public $entrega;
    public $estado;
    public $pedido_id_paypal;
    


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->total = $args['total'] ?? '';
        $this->entrega = $args['entrega'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->pedido_id_paypal = $args['pedido_id_paypal'] ?? '';
    }

    public function setUsuarioId($usuario_id){
        $this->usuario_id = $usuario_id;
    }
    public function setFechaCreacion(){
        $this->fecha = date('Y-m-d H:i:s');
    }

     public function setTotalPagado($total){
        $this->total = $total;
    }

    public function setEntrega($entrega){
        $this->entrega = $entrega;
    }

     public function setEstadoPedido($estado){
        $this->estado = $estado;
    }

     public function setPedidoIdPaypal($pedido_id_paypal){
        $this->pedido_id_paypal = $pedido_id_paypal;
    }
}