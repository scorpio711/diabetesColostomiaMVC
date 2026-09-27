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
     * Obtiene la URL base de forma inteligente:
     * 1. Prioriza APP_URL o SERVER_HOST si están definidos con un dominio real.
     * 2. Si se ejecuta desde un servidor web en producción, detecta HTTPS y el dominio automáticamente desde la petición.
     * 3. Fallback a APP_URL o localhost:3000 para desarrollo local.
     */
    private function obtenerBaseUrl(): string
    {
        // 1. Revisar variables de entorno (APP_URL o SERVER_HOST) en $_ENV, $_SERVER o getenv()
        $envUrl = $_ENV['APP_URL'] 
            ?? $_SERVER['APP_URL'] 
            ?? $_ENV['SERVER_HOST'] 
            ?? $_SERVER['SERVER_HOST'] 
            ?? (getenv('APP_URL') ?: (getenv('SERVER_HOST') ?: ''));

        if (!empty($envUrl) && strpos($envUrl, 'localhost') === false) {
            return rtrim($envUrl, '/');
        }

        // 2. Detección automática por cabeceras HTTP de la petición web
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'] 
            ?? $_SERVER['HTTP_HOST'] 
            ?? $_SERVER['SERVER_NAME'] 
            ?? '';

        // Separar puerto si viene en el host (ej: dominio.com:80)
        if (!empty($host) && strpos($host, 'localhost') === false) {
            $isHttps = (!empty($_SERVER['HTTPS']) && strpos($_SERVER['HTTPS'], 'off') === false)
                || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
                || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')
                || (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);

            $scheme = $isHttps ? 'https://' : 'http://';
            return $scheme . $host;
        }

        // 3. Fallback para entorno local de desarrollo
        return rtrim($_ENV['APP_URL'] ?? $_SERVER['APP_URL'] ?? 'http://localhost:3000', '/');
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
            $baseUrl = $this->obtenerBaseUrl();
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
            $baseUrl = $this->obtenerBaseUrl();
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

    /**
     * Enviar correo de prueba para verificar conectividad SMTP y URL base
     */
    public function enviarPrueba($destinatario)
    {
        $mail = $this->configurarMailer();
        try {
            $mail->addAddress($destinatario, $this->nombre ?: 'Administrador');
            $mail->Subject = "Prueba de Servidor de Correo - CAREFULNESS";

            $baseUrl = $this->obtenerBaseUrl();
            $fecha = date('d/m/Y H:i:s');
            $host = $_ENV['EMAIL_HOST'] ?? 'No configurado';
            $port = $_ENV['EMAIL_PORT'] ?? 'No configurado';

            $cuerpo = "
            <div style='font-family: Arial, sans-serif; max-width: 580px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);'>
                <div style='background-color: #059669; padding: 24px; text-align: center;'>
                    <h1 style='color: #ffffff; margin: 0; font-size: 20px; font-weight: bold;'>🩺 CAREFULNESS</h1>
                    <p style='color: #a7f3d0; margin: 6px 0 0 0; font-size: 13px;'>Prueba de Conectividad SMTP Exitosa</p>
                </div>
                <div style='padding: 28px 24px; color: #334155; line-height: 1.6; font-size: 14px;'>
                    <p style='font-size: 16px; font-weight: bold; color: #0f172a; margin-top: 0;'>¡El servicio de correo está funcionando a la perfección! 🎉</p>
                    <p>Este correo confirma que tu servidor SMTP y la resolución de dominios están correctamente configurados.</p>
                    <div style='background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; margin: 20px 0;'>
                        <table style='width: 100%; border-collapse: collapse; font-size: 13px;'>
                            <tr><td style='padding: 6px 0; color: #64748b;'>Servidor SMTP:</td><td style='padding: 6px 0; font-weight: bold; color: #0f172a;'>{$host}</td></tr>
                            <tr><td style='padding: 6px 0; color: #64748b;'>Puerto SMTP:</td><td style='padding: 6px 0; font-weight: bold; color: #0f172a;'>{$port}</td></tr>
                            <tr><td style='padding: 6px 0; color: #64748b;'>URL Base detectada:</td><td style='padding: 6px 0; font-weight: bold; color: #059669;'><a href='{$baseUrl}' style='color: #059669; text-decoration: underline;'>{$baseUrl}</a></td></tr>
                            <tr><td style='padding: 6px 0; color: #64748b;'>Fecha de envío:</td><td style='padding: 6px 0; font-weight: bold; color: #0f172a;'>{$fecha}</td></tr>
                        </table>
                    </div>
                    <p style='color: #64748b; font-size: 12px; margin-bottom: 0;'>Mensaje de diagnóstico enviado desde la barra rápida de administración.</p>
                </div>
            </div>";

            $mail->Body = $cuerpo;
            $mail->AltBody = "Prueba de correo exitosa desde CAREFULNESS.\nServidor: {$host}:{$port}\nURL Base: {$baseUrl}\nFecha: {$fecha}";

            $mail->send();
            return [
                "exito" => true,
                "mensaje" => "Correo de prueba enviado con éxito a " . htmlspecialchars($destinatario),
                "baseUrl" => $baseUrl
            ];
        } catch (Exception $e) {
            $errorInfo = $mail->ErrorInfo ? $mail->ErrorInfo : $e->getMessage();
            return [
                "exito" => false,
                "mensaje" => "Error SMTP: " . $errorInfo,
                "baseUrl" => $this->obtenerBaseUrl()
            ];
        }
    }
}