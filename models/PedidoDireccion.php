<?php

namespace Model;

class PedidoDireccion extends ActiveRecord{
    protected static $tabla = 'pedido_direccion';
    protected static $columnasDB = ['id', 'pedido_id', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'pais_codigo', 'pais_nombre'];

    public $id;
    public $pedido_id;
    public $calle;
    public $ciudad;
    public $provincia;
    public $codigo_postal;
    public $pais;
    public $pais_codigo;
    public $pais_nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->pedido_id = $args['pedido_id'] ?? '';
        $this->calle = $args['calle'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->provincia = $args['provincia'] ?? '';
        $this->codigo_postal = $args['codigo_postal'] ?? '';
        $this->pais = $args['pais'] ?? '';
    }

    public function setPedidoId($pedido_id){
        $this->pedido_id = $pedido_id;
    }

    public function setPaisCodigo(){
        $this->pais_codigo = $this->pais;
    }

    public function setPaisNombre(){
        switch($this->pais){
            case 'ES':
                $this->pais_nombre = 'España';
                break;

            case 'PT':
                $this->pais_nombre = 'Portugal';
                break;

            case 'FR':
                $this->pais_nombre = 'Francia';
                break;
        }
    }
}