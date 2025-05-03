<?php
namespace Model;

class ActiveRecord{
    protected static $db;
    protected static $tabla;
    protected static $columnasDB = [];

    protected static $alertas =[];

    public static function setDB($database){
        self::$db = $database;
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
    public static function all ($orden = 'DESC'){
        $query = " SELECT * FROM " . static::$tabla . " ORDER BY id $orden";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function where($columna,$valor){
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor' ";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado) ;
    }

    public function delete(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function guardar(){
        $atributos = $this->sanitizarAtributos();
        if(is_null($this->id)){
            $resultado = $this->crear($atributos);
        }else{
            $resultado = $this->actualizar($atributos);
            
        }

        return $resultado;
     
    }

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

    