<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'telefono', 'password', 'confirmado', 'admin'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $password;
    public $password2;
    public $confirmado;
    public $admin;

    public $contraseñaActual;
    public $contraseñaNueva;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->admin = $args['admin'] ?? 0;
    }

    public function validar_registro()
    {
        if(!$this->nombre){
            self::$alertas['error'][] = 'Falta nombre';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'Falta apellido';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'Falta e-mail';
        }
        
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Formato de e-mail erroneo';
        }

        if(!$this->telefono){
            self::$alertas['error'][] = 'Falta telefono';
        }

        if(!preg_match('/^\+?[0-9\s\-\(\)]{7,20}$/', $this->telefono)){
            self::$alertas['error'][]= 'Formato de telefono erroneo';
        }

        if($this->telefono && preg_match('/^\+?[0-9\s\-\(\)]{7,20}$/', $this->telefono)){
            $telefonoNormalizado = preg_replace('/\D/', '', $this->telefono);
            if (strlen($telefonoNormalizado) < 7 || strlen($telefonoNormalizado) > 15){
                self::$alertas['error'][]= 'El telefono debe contener entre 7 y 15 numeros';
            }
        }
        if(!$this->password){
            self::$alertas['error'][] = 'Falta contraseña';
        }
        if(!$this->password2){
            self::$alertas['error'][] = 'Falta repetir contraseña';
        }
        if($this->password != $this->password2 && $this->password && $this->password2){
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        if($this->password && (strlen(trim($this->password)) < 6  || strpos(trim($this->password), ' '))){
            self::$alertas['error'][] = 'La contraseña debe de contener al menos 6 caracteres y no contener espacios';
        }

        return self::$alertas;
    }

    public function validar_correo()
    {
        if(!$this->email ){
            self::$alertas['error'][] = 'El E-mail es obligatorio';
        }
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Formato incorrecto';
        }
    
        return self::$alertas;
    }

    public function validar_login()
    {
    
        if(!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'E-mail o contraseña incorrectos';
        }
    
        return self::$alertas;
    }

    public function validar_contraseña($inputPassword)
    {
    
        if(!$inputPassword || !password_verify($inputPassword, $this->password)){
            self::$alertas['error'][] = 'E-mail o contraseña incorrectos';
        }
    
        return self::$alertas;
    }

    public function validar_nueva_contraseña()
    {
        if(!$this->password){
            self::$alertas['error'][] = 'Falta contraseña';
        }
        if(!$this->password2){
            self::$alertas['error'][] = 'Falta repetir contraseña';
        }
        if($this->password != $this->password2 && $this->password && $this->password2){
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        if($this->password && (strlen(trim($this->password)) < 6  || strpos(trim($this->password), ' '))){
            self::$alertas['error'][] = 'La contraseña debe de contener al menos 6 caracteres y no contener espacios';
        }
    
        return self::$alertas;
    }

    public function setear_cambio_contraseña($args = []){
        $this->contraseñaActual = $args['contraseñaActual'];
        $this->contraseñaNueva = $args['contraseñaNueva'];
    }

    public function validar_cambio_contraseña(){
        if(!password_verify($this->contraseñaActual, $this->password)){
            self::$alertas['error'][] = 'Contraseña incorrecta';
        }

        if(strlen($this->contraseñaNueva< 6)){
            self::$alertas['error'][] = 'La Nueva Contraseña debe contener al menos 6 caracteres';
        }
        
        if(password_verify($this->contraseñaActual, $this->password) && $this->contraseñaNueva == $this->contraseñaActual){
            self::$alertas['error'][] = 'La nueva contraseña debe ser diferente a la actual';
        }
        return self::$alertas;
    }

    public function hashearPassword(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function validarFormularioCheckout(){
        $errores = [];

        if(!$this->nombre){
            $errores['nombre'][] = 'El nombre no puede ir vacio';
        }

        if(!$this->apellido){
            $errores['apellido'][] = 'El apellido no puede ir vacio';
        }

        if(!$this->email){
            $errores['email'][] = 'El email no puede ir vacio';
        }
        
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errores['email'][] = 'Formato de e-mail erroneo';
        }

        if(!$this->telefono){
            $errores['telefono'][] = 'El telefono no puede ir vacio';
        }

        if($this->telefono &&!preg_match('/^\+?[0-9\s\-\(\)]+$/', $this->telefono)){
            $errores['telefono'][]= 'Formato de telefono erroneo. Solo se aceptan numeros, espacios y guiones';
        }

        if($this->telefono && preg_match('/^\+?[0-9\s\-\(\)]+$/', $this->telefono)){
            $telefonoNormalizado = preg_replace('/\D/', '', $this->telefono);
            if (strlen($telefonoNormalizado) < 7 || strlen($telefonoNormalizado) > 15){
                $errores['telefono'][]= 'El telefono debe contener entre 7 y 15 numeros';
            }
        }

        return $errores;
    }

}