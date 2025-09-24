<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'telefono', 'password', 'fecha_registro', 'confirmado', 'admin', 'baneo'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $password;
    public $password2;
    public $fecha_registro;
    public $confirmado;
    public $admin;
    public $baneo;

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
        $this->baneo = $args['baneo'] ?? 0;
    }

    public function setFechaCreacion(){
        $this->fecha_registro = date('Y-m-d H:i:s');
    }

    public function validar_registro(){
        $errores = [];
        
        if(!$this->nombre){
            $errores['nombre'] = 'Falta nombre';
        }

        if(!$this->apellido){
            $errores['apellido'] = 'Falta apellido';
        }
        if(!$this->email){
            $errores['email'] = 'Falta e-mail';
        }
        
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errores['email'] = 'Formato de e-mail erroneo';
        }

        if(!$this->telefono){
            $errores['telefono'] = 'Falta telefono';
        }

        if($this->telefono &&!preg_match('/^\+?[0-9\s\-\(\)]{7,20}$/', $this->telefono)){
            $errores['telefono'] = 'Formato de telefono erroneo';
        }

        if($this->telefono && preg_match('/^\+?[0-9\s\-\(\)]{7,20}$/', $this->telefono)){
            $telefonoNormalizado = preg_replace('/\D/', '', $this->telefono);
            if (strlen($telefonoNormalizado) < 7 || strlen($telefonoNormalizado) > 15){
                $errores['telefono']= 'El telefono debe contener entre 7 y 15 numeros';
            }
        }
        if(!$this->password){
            $errores['password'] = 'Falta contraseña';
        }
        if(!$this->password2){
            $errores['password2'] = 'Falta repetir contraseña';
        }
        if($this->password != $this->password2 && $this->password && $this->password2){
            $errores['password'] = 'Las contraseñas no coinciden';
        }

        if($this->password && (strlen(trim($this->password)) < 6  || strpos(trim($this->password), ' '))){
            $errores['password'] = 'La contraseña debe de contener al menos 6 caracteres y no contener espacios';
        }
        
        return $errores;
        // if(!$this->nombre){
        //     self::$alertas['error'][] = 'Falta nombre';
        // }
        // if(!$this->apellido){
        //     self::$alertas['error'][] = 'Falta apellido';
        // }
        // if(!$this->email){
        //     self::$alertas['error'][] = 'Falta e-mail';
        // }
        
        // if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
        //     self::$alertas['error'][] = 'Formato de e-mail erroneo';
        // }

        // if(!$this->telefono){
        //     self::$alertas['error'][] = 'Falta telefono';
        // }

        // if(!preg_match('/^\+?[0-9\s\-\(\)]{7,20}$/', $this->telefono)){
        //     self::$alertas['error'][]= 'Formato de telefono erroneo';
        // }

        // if($this->telefono && preg_match('/^\+?[0-9\s\-\(\)]{7,20}$/', $this->telefono)){
        //     $telefonoNormalizado = preg_replace('/\D/', '', $this->telefono);
        //     if (strlen($telefonoNormalizado) < 7 || strlen($telefonoNormalizado) > 15){
        //         self::$alertas['error'][]= 'El telefono debe contener entre 7 y 15 numeros';
        //     }
        // }
        // if(!$this->password){
        //     self::$alertas['error'][] = 'Falta contraseña';
        // }
        // if(!$this->password2){
        //     self::$alertas['error'][] = 'Falta repetir contraseña';
        // }
        // if($this->password != $this->password2 && $this->password && $this->password2){
        //     self::$alertas['error'][] = 'Las contraseñas no coinciden';
        // }

        // if($this->password && (strlen(trim($this->password)) < 6  || strpos(trim($this->password), ' '))){
        //     self::$alertas['error'][] = 'La contraseña debe de contener al menos 6 caracteres y no contener espacios';
        // }

        // return self::$alertas;
    }

    public function validar_correo(){
        if(!$this->email ){
            self::$alertas['error'][] = 'El E-mail es obligatorio';
        }
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Formato incorrecto';
        }
    
        return self::$alertas;
    }

    public function validar_login(){
    
        if(!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'E-mail o contraseña incorrectos';
        }
    
        return self::$alertas;
    }

    public function validar_contraseña($inputPassword){
    
        if(!$inputPassword || !password_verify($inputPassword, $this->password)){
            self::$alertas['error'][] = 'E-mail o contraseña incorrectos';
        }
    
        return self::$alertas;
    }

    public function validar_nueva_contraseña(){
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

    public function validarCambioDatos($datosNuevos){
        $errores = [];
        $nombreNuevo = $datosNuevos['nombre'];
        $apellidoNuevo = $datosNuevos['apellido'];
        $telefonoNuevo = $datosNuevos['telefono'];

        if($nombreNuevo == ''){
            $errores['nombre'] = 'Falta nombre';
        }

        if($apellidoNuevo == ''){
            $errores['apellido'] = 'Falta apellido';
        }

        if($telefonoNuevo == ''){
            $errores['telefono'] = 'Falta telefono';
        }

       if($telefonoNuevo != '' && !preg_match('/^\+?[0-9\s\-\(\)]+$/', $telefonoNuevo)){
            $errores['telefono'] = 'Formato de telefono erroneo. Solo se aceptan numeros, espacios y guiones';
        }

        if($telefonoNuevo != '' && preg_match('/^\+?[0-9\s\-\(\)]+$/', $telefonoNuevo)){
            $telefonoNormalizado = preg_replace('/\D/', '', $telefonoNuevo);
            if (strlen($telefonoNormalizado) < 7 || strlen($telefonoNormalizado) > 15){
                $errores['telefono']= 'El telefono debe contener entre 7 y 15 numeros';
            }
        }

        if($nombreNuevo == $this->nombre && $apellidoNuevo == $this->apellido && $telefonoNuevo == $this->telefono){
            $errores['general']= 'No se detectaron cambios. Actualiza algún campo antes de guardar';
            
        }

        return $errores;
    }

    public function validarCambioCorreo($correoNuevo){
        $errores = [];

        if($correoNuevo == ''){
            $errores['correo'] = 'Ingrese un E-mail';
        }

        if($correoNuevo != '' && !filter_var($correoNuevo, FILTER_VALIDATE_EMAIL)){
            $errores['correo'] = 'Formato de E-mail erroneo';
        }else {
            
        }

        if($correoNuevo == $this->email){
            $errores['correo'] = 'El E-mail no cambió';
        }

        if(empty($errores)){
            $correoOcupado = Usuario::where('email', $correoNuevo);
            if($correoOcupado){
                $errores['correo'] = 'El E-mail ya está en uso';
            }
        }

        return $errores;
    }

    public function setearCambioContraseña($args = []){
        $this->contraseñaActual = $args['contraseñaActual'];
        $this->contraseñaNueva = $args['contraseñaNueva'];
    }

    public function validarCambioContraseña(){
        $errores = [];
        if($this->contraseñaActual == ''){
            $errores['contraseñaActual'] = 'Ingrese la contraseña';
        }

        if($this->contraseñaActual != '' && !password_verify($this->contraseñaActual, $this->password)){
            $errores['contraseñaActual'] = 'Contraseña incorrecta';
        }

        if($this->contraseñaNueva == ''){
            $errores['contraseñaNueva'] = 'Ingrese la nueva contraseña';
        }

        if(strlen($this->contraseñaNueva) > 0 && strlen($this->contraseñaNueva) < 6){
            $errores['contraseñaNueva'] = 'La nueva contraseña debe contener al menos 6 caracteres';
        }
       
        if(password_verify($this->contraseñaNueva, $this->password)){
            $errores['contraseñaNueva'] = 'La nueva contraseña debe ser diferente a la actual';
        }
        return $errores;
    }

    public static function validarCambioMisDatos($args = []){
        $errores = [];
        $usuarioId = $_SESSION['id'];

        switch($args['tipo_formulario']){
            case 'datos':
                $datosActuales = Usuario::thisWhere(['nombre', 'apellido', 'telefono'], 'id', $usuarioId);
                $datosActuales = array_shift($datosActuales);
                $errores = $datosActuales->validarCambioDatos($args);
                break;

            case 'correo':
                $correoActual = Usuario::thisWhere(['email'], 'id', $usuarioId);
                $correoActual = array_shift($correoActual);
                $errores = $correoActual->validarCambioCorreo($args['correo']);
                break;

            case 'contraseña':
                $datos = Usuario::thisWhere(['password'], 'id', $usuarioId);
                $datos = array_shift($datos);
                $datos->setearCambioContraseña($args);
                $errores = $datos->validarCambioContraseña();
                break;
        }

        return $errores;
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

    public static function contarRegistros($fecha = 'all'){
        $query = "SELECT COUNT(*) AS total_usuarios, ";
        $query .= " SUM(CASE WHEN confirmado = 1 THEN 1 ELSE 0 END) AS usuarios_confirmados, ";
        $query .= " SUM(CASE WHEN confirmado = 0 THEN 1 ELSE 0 END) AS usuarios_no_confirmados ";
        $query .= " FROM " . static::$tabla ;
        $query .= " WHERE admin = 0 ";
        $query .= " AND id != 1";

        if($fecha != 'all'){
            $query .= " AND fecha_registro >= CURDATE() ";
            if($fecha !== ''){
                $query .= "- INTERVAL $fecha ";
            }
            $query .= " AND fecha_registro <= CURDATE() + INTERVAL 1 DAY";
        }

        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return $total;
    }
}