<?php
namespace Model;

class ActiveRecord{
    protected static $db;
    protected static $tabla;
    protected static $columnasDB = [];

    protected static $alertas =[];

    public static function setDB($database){
        self::$db = $database;
        //mysqli_report(MYSQLI_REPORT_OFF);
    }

    public static function getDB(){
       return static::$db;
    }

    public static function getTabla(){
       return static::$tabla;
    }

    public static function getColumnasDB(){
       return static::$columnasDB;
    }

    public static function consultarSQL($query){

        $resultado = self::$db->query($query);

        $array= [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free();

        return $array;
    }
    
    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists( $objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    public function validar(){
        static::$alertas = [];
        return static::$alertas;
    }

    public static function setAlerta($tipo, $mensaje){
        static::$alertas[$tipo] = [$mensaje];
        return static::$alertas;
    }

    public static function getAlertas(){
        return static::$alertas;
    }
    
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key=>$value){
            if(is_string($value)){
                $value = strip_tags(trim($value));
            }
            $sanitizado[$key] = self::$db->escape_string($value);
    
        }
        return $sanitizado;
    }

    /**
    * Devuelve todo el contenido de la tabla
    */
    
    public static function all ($orden = 'ASC'){
        $query = " SELECT * FROM " . static::$tabla . " ORDER BY id $orden";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

  
    /**
    * Devuelve todo el contenido de la tabla desde el punto marcado por el offset y hasta lo que deje el limit
    *
    * @param int $limit   Numero maximo de elementos que se devolveran.
    * @param int $offset   Indice por el que se comenzará a devolver los elementos buscados.
    * @param string $orden  Nombre de la columna por la que se ordenaran los elementos devueltos.
    * @param string $sentido  Sentido en el que se ordenadan los elementos devueltos. 'ASC' o 'DESC'.
    */

    public static function allPaginated($limit, $offset, $orden = 'id', $sentido = 'ASC'){
        $query = " SELECT * FROM " . static::$tabla;
        $query .= " ORDER BY $orden $sentido ";
        $query .= "LIMIT $limit OFFSET $offset";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

     /**
    * Devuelve el contenido solicitado de la tabla desde el punto marcado por el offset y hasta lo que deje el limit
    *
    * @param int $limit   Numero maximo de elementos que se devolveran.
    * @param int $offset   Indice por el que se comenzará a devolver los elementos buscados.
    * @param string $orden  Nombre de la columna por la que se ordenaran los elementos devueltos.
    * @param string $sentido  Sentido en el que se ordenadan los elementos devueltos. 'ASC' o 'DESC'.
    * @param array $datos  Nombre de la o las columnas que se desea recuperar. (Ej: ['id', 'nombre', 'precio', 'imagen']).
    */

    public static function thisPaginated(int $limit, int $offset, string $orden = 'id',  string $sentido = 'ASC', 
                                            array $datos){
        $query = " SELECT ";
        $query .= join(", ", array_values($datos)) ; 
        $query .= " FROM " . static::$tabla;
        $query .= " ORDER BY $orden $sentido ";
        $query .= "LIMIT $limit OFFSET $offset";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
    * Devuelve el contenido solicitado de los elementos que cumplan la condicion desde el punto marcado por el offset y hasta lo que deje el limit
    *
    * @param int $limit   Numero maximo de elementos que se devolveran.
    * @param int $offset   Indice por el que se comenzará a devolver los elementos buscados.
    * @param string $orden  Nombre de la columna por la que se ordenaran los elementos devueltos.
    * @param string $sentido  Sentido en el que se ordenadan los elementos devueltos. 'ASC' o 'DESC'.
    * @param array $datos  Nombre de la o las columnas que se desea recuperar. (Ej: ['id', 'nombre', 'precio', 'imagen']).
    * @param string $columna  Nombre de la columna que revisará la condicion (Ej: 'id').
    * @param string $valores  Valor o valores a buscar (Ej: '1' o '1, 2, 3').
    * @param string $operador  Operador SQL permitido: '=', '!=', 'IN', 'NOT IN', 'IS NULL', 'IS NOT NULL'.
    */

    public static function thisWherePaginated(int $limit, int $offset, string $orden = 'id',  string $sentido = 'ASC', 
                                            array $datos,string $columna, string $valores, string $operador = '='){
        $query = " SELECT ";
        $query .= join(", ", array_values($datos)) ; 
        $query .= " FROM " . static::$tabla;
        $query .= " WHERE $columna $operador ";

        if($operador === '=' || $operador === '!='){
            $query .= " '$valores' ";
        }
        if($operador === 'IN' || $operador === 'NOT IN'){
            $query .= " ($valores) ";
        }
        $query .= " ORDER BY $orden $sentido ";
        $query .= "LIMIT $limit OFFSET $offset";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
    * Devuelve el primer elemento de la tabla que cumpla la condicion
    */

    public static function where($columna,$valor){
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor' ";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado) ;
    }

    /**
    * Devuelve el todos los elementos de la tabla que cumplan la condicion
    */

    public static function allWhere ($columna, $valor ,$orden = 'ASC'){
        $query = " SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor' ORDER BY id $orden";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
    * Devuelve solo los datos pedidos de todos los elementos de la tabla
    *
    * @param array $datos   Nombre de la o las columnas que se desea recuperar. (Ej: ['id', 'nombre', 'precio', 'imagen']).
    */

    public static function this(array $datos){
        $query = "SELECT ";
        $query .= join(", ", array_values($datos)) ; 
        $query .= " FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado ;
    }

    /**
    * Devuelve solo los datos pedidos de los elementos que cumplan la condicion
    *
    * @param array $datos   Nombre de la o las columnas que se desea recuperar. (Ej: ['id', 'nombre', 'precio', 'imagen']).
    * @param string $columna   Nombre de la columna que revisará la condicion (Ej: 'id').
    * @param string $valores Valor o valores a buscar (Ej: '1' o '1, 2, 3').
    * @param string $operador  Operador SQL permitido: '=', 'IN', 'IS NULL', 'IS NOT NULL'.
    * @param string $orden  'FIELD' o nombre de una de las columnas de la tabla.
    */

    public static function thisWhere(array $datos, string $columna, string $valores, string $operador = '=', string $orden = '' ){
        $query = "SELECT ";
        $query .= join(", ", array_values($datos)) ; 
        $query .= " FROM " . static::$tabla . " WHERE $columna $operador ";
        if($operador === '='){
            $query .= " '$valores' ";
        }
        if($operador === 'IN'){
            $query .= " ($valores) ";
        }

        if($orden !== ''){
            if(in_array($orden, static::$columnasDB)){
                $query .= " ORDER BY $orden ";
            }else if($orden === 'FIELD'){
                $query .= " ORDER BY $orden($columna ,$valores)";

            }else{
               throw new \InvalidArgumentException("Parametro Invalido \$orden: '$orden'.");
            }
        }
        $resultado = self::consultarSQL($query);
        return $resultado ;
    }


    /**
    * Busqueda Where con Multiples opciones
    *
    * @param array $Array Estructura [columna => valor, columna => valor], puede ser 1 o varios
    */

     public static function whereArray($array = []) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ";
        foreach($array as $key => $value){
            if($key == array_key_last($array)){
                $query .= " $key = '$value'";
            }else{
                $query .= " $key = '$value' AND";
            }
        }
        $resultado = self::consultarSQL($query);
        return $resultado ;
    }


    /**
    * Cuenta todos los elementos de la tabla que cumplan la condicion
    */

    public static function count($columna,$valor, $operador = '='){
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla . " WHERE $columna $operador '$valor' ";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return (int)$total['total'];
    }

    /**
    * Cuenta todos los elementos de la tabla
    */

    public static function countAll(){
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return (int)$total['total'];
    }


    /**
    * Cuenta todos los elementos de la tabla que esten dentro del rango de fechas establecido
    *
    * @param string $columnaFecha   Nombre de la columna que contiene la fecha a revisar (ej. 'fecha, fecha_creacion').
    * @param string $fechaInicial Cuanto tiempo antes de hoy, dejar vacio si es solo el ultimo dia (Ej: 1 DAY, 2 WEEK, 3 MONTH).
    * @param string $fechaFinal  Cuanto tiempo desde hoy, dejar vacio si es solo el ultimo dia (Ej: 1 DAY, 2 WEEK, 3 MONTH).
    */

    public static function countByDate(string $columnaFecha, string $fechaInicial = '', string $fechaFinal = '1 DAY'){
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla ;
         $query .= " WHERE $columnaFecha >= CURDATE() ";
        if($fechaInicial !== ''){
             $query .= "- INTERVAL $fechaInicial ";
        }
        $query .= " AND $columnaFecha <= CURDATE() + INTERVAL $fechaFinal";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return (int)$total['total'];
    }


    /**
    * Devuelve solo los datos pedidos de los elementos que esten dentro del rango de fechas establecido
    *
    * @param array $datos   Nombre de la o las columnas que se desea recuperar. Ej: ['id', 'nombre', 'precio', 'imagen'].
    * @param string $columnaFecha   Nombre de la columna que contiene la fecha a revisar (ej. 'fecha, fecha_creacion').
    * @param string $fechaInicial Cuanto tiempo antes de hoy, dejar vacio si es solo el ultimo dia (Ej: 1 DAY, 2 WEEK, 3 MONTH).
    * @param string $fechaFinal  Cuanto tiempo desde hoy, dejar vacio si es solo el ultimo dia (Ej: 1 DAY, 2 WEEK, 3 MONTH).
    */

    public static function thisByDate(array $datos, string $columnaFecha, string $fechaInicial = '', string $fechaFinal = '1 DAY' ){
        $query = "SELECT ";
        $query .= join(", ", array_values($datos)) ; 
        $query .= " FROM " . static::$tabla;
        $query .= " WHERE $columnaFecha >= CURDATE() ";
        if($fechaInicial !== ''){
             $query .= "- INTERVAL $fechaInicial ";
        }
        $query .= " AND $columnaFecha <= CURDATE() + INTERVAL $fechaFinal";
      
        $resultado = self::consultarSQL($query);
        return $resultado ;
    }

    /**
    * Borra el elemento de la tabla al que se apunta
    */

    public function delete(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    /**
    * Revisa la existencia del elemento para actualizarlo o crearlo
    */
    public function guardar(){
        $atributos = $this->sanitizarAtributos();
        if(is_null($this->id)){
            $resultado = $this->crear($atributos);
        }else{
            $resultado = $this->actualizar($atributos);
            
        }

        return $resultado;
     
    }

    /**
    * Guarda varios elementos en una tabla usando una unica consulta
    *
    * Debe ser llamado desde el modelo que trabaja con la tabla en la que se quiere guardar
    *
    * @param array $Array Un array que guarde varios objetos a guardar
    */

    public static function guardarVarios($datos = []){
        $datosSanitizados = [];
        $valores = [];
        $tabla = $datos[0]->getTabla();
        $columnas = $datos[0]->getColumnasDB();
        $columnasBuscadas = array_diff($columnas, ['id']);
        foreach($datos as $dato){
            $datosSanitizados [] = $dato->sanitizarAtributos();
        }

        foreach($datosSanitizados as $dato){
            $valores[] = "('".join("', '", array_values($dato)) ."')";
        }

        $query = "INSERT INTO " . $tabla . " (";
        $query .= join(", ", array_values($columnasBuscadas));
        $query .= ") VALUES ";
        $query .= join(", ", array_values($valores));
        
        $resultado =  self::$db->query($query);

        return $resultado;
    }

    
    //Crea un nuevo elemento en la tabla
    public function crear($atributos){

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ", array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos)) ."') ";
        
        
        $resultado =  self::$db->query($query);

        return [
            'resultado' => $resultado,
            'id' => self::$db->insert_id
        ];
    }

    //Actualiza los datos de un elemento en la tabla
    public function actualizar($atributos){
            $nuevosDatos = [];
        foreach($atributos as $key=>$value){
            $nuevosDatos []= "$key = '$value'";
        }
        $query = "UPDATE " . static::$tabla. " SET ";
        $query .= join(', ', $nuevosDatos);
        $query .= " WHERE id = ". self::$db->escape_string($this->id);
        $query .= " LIMIT 1";
    
        

        $resultado =  self::$db->query($query);

        return [
            'resultado' => $resultado,
            'id' => self::$db->insert_id
        ];
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args = []){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}

    