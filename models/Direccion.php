<?php

namespace Model;

class Direccion extends ActiveRecord{
    protected static $tabla = 'direcciones';
    protected static $columnasDB = ['id', 'usuario_id', 'nombre', 'apellido', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'pais',
                                     'telefono', 'fecha_creacion', 'fecha_actualizacion', 'predeterminada'];

    public $id;
    public $usuario_id;
    public $nombre;
    public $apellido;
    public $calle;
    public $ciudad;
    public $provincia;
    public $codigo_postal;
    public $pais;
    public $telefono;
    public $fecha_creacion;
    public $fecha_actualizacion;
    public $predeterminada;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->calle = $args['calle'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->provincia = $args['provincia'] ?? '';
        $this->codigo_postal = $args['codigo_postal'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->predeterminada = $args['predeterminada'] ?? 0;
    }

    public function setFechaCreacion(){
        $this->fecha_creacion = date('Y-m-d H:i:s');
        $this->fecha_actualizacion = date('Y-m-d H:i:s');

    }
    
    public function setFechaActualizacion(){
        $this->fecha_actualizacion = date('Y-m-d H:i:s');
    }

    public function validarFormulario(){
        if(!$this->nombre){
            self::$alertas['error'][]= 'El nombre no puede ir vacio';
        }

        if(!$this->apellido){
            self::$alertas['error'][] ='El apellido no puede ir vacio';
        }

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

        if(!$this->pais){
            self::$alertas['error'][]= 'El pais no puede ir vacio';
        }

        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono no puede ir vacio';
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
}