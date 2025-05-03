<?php

namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'categoria', 'precio', 'imagen', 'miniatura'];

    public $id;
    public $nombre;
    public $categoria;
    public $precio;
    public $imagen;
    public $miniatura;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->miniatura = $args['miniatura'] ?? '';
    }
}