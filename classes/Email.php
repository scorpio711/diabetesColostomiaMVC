<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

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

    public function enviarConfirmacion($destinatario)
    {
        
        //crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["EMAIL_PORT"];
        $mail->Username = $_ENV["EMAIL_USER"];
        $mail->Password = $_ENV["EMAIL_PASS"];
        
        //Quien lo envia
        $mail->setFrom("stomadiahelp@gmail.com", "stomadiahelp");
        
        //Quien recibe
        $mail->addAddress($destinatario);
        $mail->Subject = "Confirma tu cuenta";
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $rutaArchivo = "../views/correos/confirmarCorreo.php";

        // Lee el contenido del archivo
        $contenido = file_get_contents($rutaArchivo);

        // Agrega nuevas variables o contenido al principio
        // Define la variable $nombre
        $nombre = $this->nombre;
        $url = $_ENV['APP_URL'] . "/public/confirmar-cuenta?token=" . $this->token;

        // Reemplaza la variable en el contenido del archivo
        $contenidoModificado = str_replace(["<?php echo \$nombre; ?>", "<?php echo \$url; ?>"], [$nombre, $url], $contenido);

        // Guarda el contenido modificado en el archivo
        file_put_contents($rutaArchivo, $contenidoModificado);
        $mail->Body = $contenidoModificado;

        //Enviar el mail
        $mail->Send();

        // Después de enviar el correo, restablece el contenido original
        file_put_contents($rutaArchivo, $contenido);

        

    }

    public function enviarIntrucciones($destinatario)
    {
        //crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["EMAIL_PORT"];
        $mail->Username = $_ENV["EMAIL_USER"];
        $mail->Password = $_ENV["EMAIL_PASS"];

        //Quien lo envia
        $mail->setFrom("stomadiahelp@gmail.com", "stomadiahelp");

        //Quien recibe
        $mail->addAddress($destinatario);
        $mail->Subject = "Restablece tu password";

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $rutaArchivo = "../views/correos/olvidarContraseña.php";

        // Lee el contenido del archivo
        $contenido = file_get_contents($rutaArchivo);

        // Agrega nuevas variables o contenido al principio
        // Define la variable $nombre
        $nombre = $this->nombre;
        $url = $_ENV['APP_URL'] . "/public/cambio-password?token=" . $this->token;

        // Reemplaza la variable en el contenido del archivo
        $contenidoModificado = str_replace(["<?php echo \$nombre; ?>", "<?php echo \$url; ?>"], [$nombre, $url], $contenido);


        // Guarda el contenido modificado en el archivo
        file_put_contents($rutaArchivo, $contenidoModificado);
        $mail->Body = $contenidoModificado;

        //Enviar el mail
        $mail->Send();

        // Después de enviar el correo, restablece el contenido original
        file_put_contents($rutaArchivo, $contenido);
    }
}