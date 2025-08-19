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

    /**
     * Devuelve los los productos junto a la cantidad ventida y dinero ganado por cada uno
     * 
     * @param string    $columna Cual columna se usará para ordenar los resultados
     * @param string    $orden 'ASC' o 'DESC'.Define si se mostraran de forma ascendente o decendente.
     * @param int       $limit Define la cantidad de elementos que se devolveran
     * @param int       $offset Define desde que indice se recuperaran los elementos
     * @param string    $fechaInicio Define en que rango de fecha antes de hoy buscar los pedidos. Ej: '1 DAY', '1 MONTH'
     * @param string    $fechaFin Define hasta que rango de fecha buscar los pedidos. Ej: '1 DAY', '1 MONTH'
     *  
     */
    public static function paginacionVentas(string $columna,string $orden, int $limit, int $offset, string $fechaInicio = '', string $fechaFin = '1 DAY'){

        $query = " SELECT p.id, p.nombre, "; 
        $query .= " IFNULL(SUM(CASE
                            WHEN pe.fecha BETWEEN (CURDATE() - INTERVAL $fechaInicio) 
                                           AND (CURDATE() + INTERVAL $fechaFin) 
                            THEN pp.cantidad ELSE 0 END), 0) AS cantidad_vendida, ";
        

        $query .= " IFNULL(SUM(CASE
                            WHEN pe.fecha BETWEEN (CURDATE() - INTERVAL $fechaInicio) 
                                           AND (CURDATE() + INTERVAL $fechaFin) 
                            THEN pp.cantidad * pp.precio_unitario ELSE 0 END), 0) AS dinero_recaudado ";
        
        $query .= " FROM " . self::$tabla ." p ";
        $query .=  " LEFT JOIN pedido_productos pp ";
        $query .=  " ON pp.producto_id = p.id ";
        $query .=  " LEFT JOIN pedidos pe "; 
        $query .=  " ON pe.id = pp.pedido_id ";
        $query .= " GROUP BY p.id, p.nombre ";
        $query .= " ORDER BY $columna $orden ";
        $query .= " LIMIT $limit OFFSET $offset;";

        $resultado = self::$db->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

     public static function paginacionVentasAll(string $columna,string $orden, int $limit, int $offset){

        $query = " SELECT p.id, p.nombre, "; 
        $query .= " IFNULL(SUM(pp.cantidad), 0) AS cantidad_vendida, ";
        $query .= " IFNULL(SUM(pp.cantidad * pp.precio_unitario), 0) AS dinero_recaudado";     
        $query .= " FROM " . self::$tabla ." p ";
        $query .=  " LEFT JOIN pedido_productos pp ";
        $query .=  " ON pp.producto_id = p.id ";
        $query .=  " LEFT JOIN pedidos pe "; 
        $query .=  " ON pe.id = pp.pedido_id ";
        $query .= " GROUP BY p.id, p.nombre ";
        $query .= " ORDER BY $columna $orden ";
        $query .= " LIMIT $limit OFFSET $offset;";

        $resultado = self::$db->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public static function masVendido(string $fechaInicio = '', string $fechaFin = '1 DAY'){
        $query = " SELECT p.id, p.nombre, ";
        $query .=  " SUM(pp.cantidad) AS cantidad_vendida, ";
        $query .=  " SUM(pp.cantidad * pp.precio_unitario) AS dinero_recaudado ";
        $query .=  " FROM " . self::$tabla ." p ";
        $query .=  " LEFT JOIN pedido_productos pp ";
        $query .=  " ON pp.producto_id = p.id ";
        $query .=  " LEFT JOIN pedidos pe ";
        $query .=  " ON pe.id = pp.pedido_id ";
        $query .=  " WHERE pe.fecha >= CURDATE() ";

        if($fechaInicio !== ''){
             $query .= "- INTERVAL $fechaInicio ";
        }

        $query .= " AND pe.fecha <= CURDATE() + INTERVAL $fechaFin ";
        $query .=  " GROUP BY p.id, p.nombre ";
        $query .= " ORDER BY cantidad_vendida DESC ";
        $query .= " LIMIT 1; ";

        $resultado = self::$db->query($query);
        return $resultado->fetch_assoc();
    }

    public static function masVendidoAll(){
        $query = " SELECT p.id, p.nombre, ";
        $query .=  " SUM(pp.cantidad) AS cantidad_vendida, ";
        $query .=  " SUM(pp.cantidad * pp.precio_unitario) AS dinero_recaudado ";
        $query .=  " FROM " . self::$tabla ." p ";
        $query .=  " LEFT JOIN pedido_productos pp ";
        $query .=  " ON pp.producto_id = p.id ";
        $query .=  " LEFT JOIN pedidos pe ";
        $query .=  " ON pe.id = pp.pedido_id ";
        $query .=  " GROUP BY p.id, p.nombre ";
        $query .= " ORDER BY cantidad_vendida DESC ";
        $query .= " LIMIT 1; ";

        $resultado = self::$db->query($query);
        return $resultado->fetch_assoc();
    }
    
}