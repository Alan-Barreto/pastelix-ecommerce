<?php

namespace Model;

class PedidoProducto extends ActiveRecord{
    protected static $tabla = 'pedido_productos';
    protected static $columnasDB = ['id', 'pedido_id', 'producto_id', 'cantidad', 'precio_unitario'];

    public $id;
    public $pedido_id;
    public $producto_id;
    public $cantidad;
    public $precio_unitario;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->pedido_id = $args['pedido_id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 1;
        $this->precio_unitario = $args['precio_unitario'] ?? '';
    }

  

    public static function sanitizarVarios($pedidoProductos){

        $valoresSanitizados = [];
        $i = 0;
        foreach($pedidoProductos as $producto){
            
            foreach($producto as &$value){
                if(is_string($value)){
                    $value = strip_tags(trim($value));
                }
                $valoresSanitizados[$i][] = self::$db->escape_string($value);
            }   
            $i++;
        }
        return $valoresSanitizados;
    }

    public static function guardarVarios($pedidoProductos){
        $columnas = "(pedido_id, producto_id, cantidad, precio_unitario)";
        $pedidoSanitizado = self::sanitizarVarios($pedidoProductos);

        $valores = [];

        foreach($pedidoSanitizado as $pedido){
            $valores[] = "(" . implode(', ', $pedido) . ")";
        }

        $query = "INSERT INTO ". self::$tabla. " " . $columnas;
        $query .= " VALUES ";
        $query .= implode(', ', $valores);
        $query .= ";";
        
        //return $query;

        $resultado =  self::$db->query($query);

        return [
            'resultado' => $resultado,
            'id' => self::$db->insert_id
        ];
    }
}