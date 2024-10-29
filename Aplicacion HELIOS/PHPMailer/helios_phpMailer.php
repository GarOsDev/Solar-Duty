<?php


// Mostrar errores PHP (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir la libreria PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function phpmailer($asunto,$cuerpoMensaje,$destinatario,$nombreDestinatario)
{

    // Inicio
    $mail = new PHPMailer(true);

    try {
        // Configuracion SMTP
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                         // Mostrar salida (Desactivar en producción)
        $mail->isSMTP();                                               // Activar envio SMTP
        $mail->Host  = 'smtp.gmail.com';                     // Servidor SMTP
        $mail->SMTPAuth  = true;                                       // Identificacion SMTP
        $mail->Username  = '';                  // Usuario SMTP
        $mail->Password  = '';              // Contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port  = 587;
        $mail->setFrom('heliosrequests@gmail.com', 'HELIOS Support');                // Remitente del correo
        $mail->addReplyTo('heliosrequests@gmail.com', 'HELIOS Support Assistant');

        // Destinatarios
        $mail->addAddress($destinatario, $nombreDestinatario);  // Email y nombre del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body  = $cuerpoMensaje;
        $mail->AltBody = 'Alerta generada. Niveles de produccion solar por debajo del limite establecido';
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->send();
        echo 'El mensaje se ha enviado';
    } catch (Exception $e) {
        echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
    }
}
