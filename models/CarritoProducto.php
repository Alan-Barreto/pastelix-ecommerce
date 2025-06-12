<?php

namespace Model;

use mysqli;

class CarritoProducto extends ActiveRecord{
    protected static $tabla = 'carrito_productos';
    protected static $columnasDB = ['id', 'carrito_id', 'producto_id', 'cantidad'];

    public $id;
    public $carrito_id;
    public $producto_id;
    public $cantidad;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->carrito_id = $args['carrito_id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 1;
    }

    public static function recuperarProductos($carritoId){
        $query = " SELECT cp.producto_id, p.nombre, p.precio, cp.cantidad " ;
        $query .= " FROM " . self::$tabla . " cp ";
        $query .= " JOIN productos p ON cp.producto_id = p.id ";
        $query .= " WHERE cp.carrito_id = " . $carritoId;
        $resultado = self::$db->query($query);
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);
  
        return $productos;
    }
}