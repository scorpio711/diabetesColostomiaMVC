<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    /**
     * Configura y retorna una instancia lista de PHPMailer
     */
    private function configurarMailer()
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"] ?? 'smtp-relay-offshore-southamerica-east-v2.sendinblue.com';
        $mail->SMTPAuth = true;
        $mail->Port = intval($_ENV["EMAIL_PORT"] ?? 2525);
        $mail->Username = $_ENV["EMAIL_USER"] ?? '';
        $mail->Password = $_ENV["EMAIL_PASS"] ?? '';

        // Remitente oficial de la plataforma
        $mail->setFrom("stomadiahelp@gmail.com", "CAREFULNESS");
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

    /**
     * Enviar correo de confirmación de cuenta nueva
     */
    public function enviarConfirmacion($destinatario)
    {
        try {
            $mail = $this->configurarMailer();
            $mail->addAddress($destinatario, $this->nombre);
            $mail->Subject = "Confirma tu cuenta en CAREFULNESS";

            $nombre = $this->nombre;
            $baseUrl = rtrim($_ENV['APP_URL'] ?? 'http://localhost:3000', '/');
            $url = $baseUrl . "/public/confirmar-cuenta?token=" . urlencode($this->token);

            // Renderizado seguro en memoria con output buffering (sin tocar el disco)
            ob_start();
            include __DIR__ . "/../views/correos/confirmarCorreo.php";
            $cuerpoHTML = ob_get_clean();

            $mail->Body = $cuerpoHTML;
            $mail->AltBody = "Hola {$nombre},\n\nGracias por registrarte en CAREFULNESS. Confirma tu cuenta ingresando al siguiente enlace:\n{$url}\n\nSi no creaste esta cuenta, puedes ignorar este mensaje.";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar correo de confirmación: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Enviar correo con instrucciones para restablecer contraseña
     */
    public function enviarIntrucciones($destinatario)
    {
        try {
            $mail = $this->configurarMailer();
            $mail->addAddress($destinatario, $this->nombre);
            $mail->Subject = "Restablece tu contraseña - CAREFULNESS";

            $nombre = $this->nombre;
            $baseUrl = rtrim($_ENV['APP_URL'] ?? 'http://localhost:3000', '/');
            $url = $baseUrl . "/public/cambio-password?token=" . urlencode($this->token);

            // Renderizado seguro en memoria con output buffering (sin tocar el disco)
            ob_start();
            include __DIR__ . "/../views/correos/olvidarContraseña.php";
            $cuerpoHTML = ob_get_clean();

            $mail->Body = $cuerpoHTML;
            $mail->AltBody = "Hola {$nombre},\n\nHas solicitado restablecer tu contraseña en CAREFULNESS. Hazlo en el siguiente enlace:\n{$url}\n\nSi no realizaste esta solicitud, puedes ignorar este correo.";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar correo de recuperación: " . $e->getMessage());
            return false;
        }
    }
}