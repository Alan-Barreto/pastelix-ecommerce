<?php

namespace Model;

class Direccion extends ActiveRecord{
    protected static $tabla = 'direcciones';
    protected static $columnasDB = ['id', 'usuario_id', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'pais_codigo', 'pais_nombre',
                                     'fecha_creacion', 'fecha_actualizacion', 'predeterminada'];
    
    protected static $paisesAceptados = [
                                            ['codigo' => 'ES', 'nombre' => 'España'],
                                            ['codigo' => 'PT', 'nombre' => 'Portugal'],
                                            ['codigo' => 'FR', 'nombre' => 'Francia']
                                        ];


    public $id;
    public $usuario_id;
    public $calle;
    public $ciudad;
    public $provincia;
    public $codigo_postal;
    public $pais;
    public $pais_codigo;
    public $pais_nombre;
    public $fecha_creacion;
    public $fecha_actualizacion;
    public $predeterminada;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? '';
        $this->calle = $args['calle'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->provincia = $args['provincia'] ?? '';
        $this->codigo_postal = $args['codigo_postal'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->predeterminada = $args['predeterminada'] ?? 0;
    }

    public function setFechaCreacion(){
        $this->fecha_creacion = date('Y-m-d H:i:s');
        $this->fecha_actualizacion = date('Y-m-d H:i:s');

    }
    
    public function setFechaActualizacion(){
        $this->fecha_actualizacion = date('Y-m-d H:i:s');
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

    public static function getPaisesAceptados(){
        return self::$paisesAceptados;
    }

    public function validarFormulario(){
        $codigosPais = array_column(self::$paisesAceptados, 'codigo');
       
        if(!$this->calle){
            self::$alertas['error'][] = 'La calle no puede ir vacia';
        }

        if(!$this->ciudad){
            self::$alertas['error'][] = 'La ciudad no puede ir vacia';
        }

        if(!$this->provincia){
            self::$alertas['error'][] = 'La provincia no puede ir vacia';
        }

        if(!$this->codigo_postal){
            self::$alertas['error'][] = 'El codigo postal no puede ir vacio';
        }

        if(!$this->pais || $this->pais == ""){
            self::$alertas['error'][]= 'Debe seleccionar un país';
        }

        if($this->pais && !in_array($this->pais, $codigosPais)){
            self::$alertas['error'][]= 'Error con la opcion elegida, recargue la pagina e intentelo de nuevo';
        }

        return self::$alertas;
    }

    public static function validarIdDireccion(){
        if(!isset($_GET['id']) || !ctype_digit($_GET['id'])){
            return false;
        }
        $direccion = Direccion::where('id', $_GET['id']);

        if(!$direccion || $direccion->usuario_id !== $_SESSION['id']){
            return false;
        }
        return $direccion;
    }

    public function validarFormularioCheckout(){
        $codigosPais = array_column(self::$paisesAceptados, 'codigo');
        $errores = [];

        if(!$this->calle){
            $errores['calle'][] = 'La calle no puede ir vacia';
        }

        if(!$this->ciudad){
            $errores['ciudad'][] = 'La ciudad no puede ir vacia';
        }

        if(!$this->provincia){
            $errores['provincia'][] = 'La provincia no puede ir vacia';
        }

        if(!$this->codigo_postal){
            $errores['codigo_postal'][] = 'El codigo postal no puede ir vacio';
        }

        if(!$this->pais){
            $errores['pais'][]= 'Debe seleccionar un país';
        }

        if($this->pais && !in_array($this->pais, $codigosPais)){
            $errores['pais'][]= 'Error con la opcion elegida, recargue la pagina e intentelo de nuevo';
        }

        return $errores;
    }
}