<?php

namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'categoria', 'precio', 'imagen'];

    //Define el peso maximo de la imagen subida en MB
    protected static $MBs = 2;
    

    public $id;
    public $nombre;
    public $categoria;
    public $precio;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->precio =  isset($args['precio']) ? str_replace(',', '.', $args['precio'] ) : '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validarProducto($nuevoProducto= false){
        if(!$this->nombre){
            self::$alertas['error'][] = 'Ingrese nombre';
        }

        if(!$this->categoria){
            self::$alertas['error'][] = 'Ingrese categoria';
        }

        if(!$this->precio || !filter_var($this->precio, FILTER_VALIDATE_FLOAT) || $this->precio < 0){
            self::$alertas['error'][] = 'Ingrese un precio valido mayor a 0';
        }

        if($this->precio && filter_var($this->precio, FILTER_VALIDATE_FLOAT) && !preg_match('/^\d+(\.\d{1,2})?$/', $this->precio)){
            self::$alertas['error'][] = 'El precio debe tener maximo 2 decimales';
        }

        if($this->precio && filter_var($this->precio, FILTER_VALIDATE_FLOAT) && $this->precio > 999.99){
            self::$alertas['error'][] = 'El precio maximo es 999,99';
        }

        if($nuevoProducto){
            if(!$this->imagen){
            self::$alertas['error'][] = 'Suba una imagen';
            }
        }
        

        return self::$alertas;
    }

    public static function validarImagen ($imagen){
        $tamañoMaximo = self::$MBs * 1024 * 1024;
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $infoImagen = getimagesize($imagen);

        if(!$infoImagen){
            self::$alertas['error'][] = 'El archivo necesita ser una imagen';
        }

        if($infoImagen && !in_array($infoImagen['mime'], $tiposPermitidos)){
            self::$alertas['error'][] = 'La imagen debe ser formato .jpg, .png o .webp';
        }

        if($infoImagen && $_FILES['imagen']['size'] > $tamañoMaximo){
            self::$alertas['error'][] = 'El peso maximo del archivo es de ' . self::$MBs . 'MB';
        }

        return self::$alertas;
    }

    public static function validarIdProducto(){
        if(!isset($_GET['id']) || !ctype_digit($_GET['id'])){
            return false;
        }
        $producto = Producto::where('id', $_GET['id']);

        return $producto;
    }
}