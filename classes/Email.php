<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $correo;
    public $nombre;
    public $token;
    public $selector;
    public $accion;

    public function __construct($correo, $nombre, $token, $selector, $accion) {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->token = $token;
        $this->selector = $selector;
        $this->accion = $accion;
    }

    public function configurarCorreo(){
        $mail = new PHPMailer();
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['EMAIL_HOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV['EMAIL_USER'];                     //SMTP username
        $mail->Password   = $_ENV['EMAIL_PASS'];                               //SMTP password
        $mail->Port       = $_ENV['EMAIL_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('no_reply@pastelix.com', 'Pastelix');
        $mail->addAddress($this->correo, $this->nombre);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

    public function crearCorreo(){
        $mail = $this->configurarCorreo();
        $contenido = '<html>';
        switch($this->accion){
            case 'Confirmar Correo':
                $mail->Subject = 'Confirma tu cuenta de Pastelix';

                $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en Pastelix; pero es necesario confirmarla</p>";
                $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/actualizar?token=" . $this->token . '&selector=' . $this->selector . "'>Confirmar Cuenta</a>";       
                $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
            break;

            case 'Cambiar Correo':
                $mail->Subject = 'Cambio de correo';

                $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado cambiar tu correo, sigue el siguiente enlace para confirmarlo.</p>";
                $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/actualizar" . "?token=" . $this->token . '&selector=' . $this->selector . "'>Actualizar Correo</a>";       
                $contenido .= "<p>Si tu no pediste el cambio; puedes ignorar el mensaje</p>";
            break;
            
            //Por si se quiere enviar un correo de E-mail cambiado correctamente"
            // case 'Confirmar Correo Nuevo':
            
            // break;

            case 'Recuperar contraseña':
                $mail->Subject = 'Recupera tu contraseña';

                $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
                $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/recuperar?token=" . $this->token . '&selector=' . $this->selector . "'>Reestablecer Constraseña</a>";       
                $contenido .= "<p>Si tu no pediste el cambio; puedes ignorar el mensaje</p>";
            break;

            case 'Cambiar Contraseña':
                $mail->Subject = 'Cambio de contraseña';

                $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado cambiar tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
                $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/actualizar?token=" . $this->token . '&selector=' . $this->selector . "'>Actualizar Contraseña</a>";       
                $contenido .= "<p>Si tu no pediste el cambio; puedes ignorar el mensaje</p>";
            break;
        }

        $contenido .= '</html>';
        $mail->Body = $contenido;

        return $mail;
    }

    public function enviarCorreo(){
        $mail = $this->crearCorreo();
        $mail->send();
    }

   
}