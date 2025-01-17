<?php

namespace Controllers;

use MVC\router;
use Model\Investigacion;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        session_start();
        $enfermedad = $_SESSION["enfermedad"];
        $investigaciones = Investigacion::get(4, 'DESC');

        $router->render("/paginas/index", [
            "investigaciones" => $investigaciones,
            "enfermedad" => $enfermedad
        ]);
    }
    public static function investigaciones(Router $router)
    {
        $investigaciones = Investigacion::all();
        // Invertir el orden de los elementos en el array
        $investigaciones = array_reverse($investigaciones);

        $router->render("/paginas/investigaciones", [
            "investigaciones" => $investigaciones
        ]);
    }
    public static function indexAdmin(Router $router)
    {
        session_start();

        isAdmin();

        $router->render("/admin/index");
    }

    public static function medico(Router $router)
    {
        $router->render("paginas/medico");
    }

    public static function psicologico(Router $router)
    {
        $router->render("paginas/psicologico");
    }
    public static function juridico(Router $router)
    {
        $router->render("paginas/juridico");
    }
    public static function blog(Router $router)
    {
        $router->render("paginas/blog");
    }
   
    public static function contacto(Router $router)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $respuestas = $_POST["contacto"];

            //Crear instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = "sandbox.smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = "7e93aa0480d472";
            $mail->Password = "33d2f4b8179530";
            $mail->SMTPSecure = "tls"; // para que los emails vayan por un tunel seguro
            $mail->Port = 2525;

            //Configurar el contenido del email
            $mail->setFrom("admin@colostomiadiabetes.com");
            $mail->addAddress("admin@colostomiadiabetes.com", "StomaDiaHelp");
            $mail->Subject = "Tienes un nuevo mensaje";

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            //Definir el contenido
            $contenido = "<html>";
            $contenido .= "<p> Tienes un nuevo mensaje </p>";
            $contenido .= "<p> Subject: " . $respuestas["subject"] . "</p>";
            $contenido .= "<p> Mensaje: " . $respuestas["message"] . "</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
            $mail->AltBody = "Esto es texto alternativo sin html";

            //Enviar el email
            if ($mail->send()) {
                echo "Mensaje enviado correctamente";
            } else {
                echo "Mensaje no enviado";
            }
        }
        $router->render("paginas/contacto");
    }
}