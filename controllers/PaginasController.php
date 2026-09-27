<?php

namespace Controllers;

use MVC\Router;
use Model\Investigacion;
use Model\Usuario;
use Model\Paciente;
use Model\Profesionales;
use Model\Cita;
use Model\BlogPost;
use Model\Servicio;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        session_start();
        $id = $_SESSION["id"] ?? null;
        $enfermedad = $_SESSION["enfermedad"] ?? null;
        $investigaciones = Investigacion::get(4, 'DESC');

        // verificar si es un funcionario
        $rolActual = $_SESSION["rol"] ?? '';
        $esFuncionario = in_array($rolActual, ['abogado', 'psicologo', 'enfermero']);

        // obtener informacion del usuario logueado
        $usuario = (!empty($_SESSION["login"]) && !empty($id)) ? Usuario::find($id) : null;

        // verificar si estan habilitadas las encuestas
        $encuestaPsicologia = intval($usuario->encuesta_psicologia ?? 0);
        $encuestaJuridico = intval($usuario->encuesta_juridico ?? 0);
        $encuestaSalud = intval($usuario->encuesta_salud ?? 0);
       
        $router->render("/paginas/index", [
            "encuestaPsicologia" => $encuestaPsicologia,
            "encuestaSalud" => $encuestaSalud,
            "encuestaJuridico" => $encuestaJuridico,
            "esFuncionario" => $esFuncionario,
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

        $stats = [
            'usuarios' => Usuario::count(),
            'pacientes' => Paciente::count(),
            'profesionales' => Profesionales::count(),
            'investigaciones' => Investigacion::count(),
            'blogs' => BlogPost::count(),
            'servicios' => Servicio::count(),
            'citas' => Cita::count(),
        ];

        $nombreAdmin = $_SESSION['nombre'] ?? 'Administrador';

        $router->render("/admin/index", [
            'stats' => $stats,
            'nombreAdmin' => $nombreAdmin
        ]);
    }

    public static function simularRol()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $esAdmin = !empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]);
        if (!$esAdmin) {
            header("Location: /public");
            exit;
        }

        $rol = $_GET["rol"] ?? 'admin';
        $redirect = $_GET["redirect"] ?? '/public';

        // Guardar respaldo de identidad original del administrador
        if (empty($_SESSION["admin_real"])) {
            $_SESSION["admin_real"] = true;
            $_SESSION["admin_id_original"] = $_SESSION["id"] ?? null;
            $_SESSION["admin_nombre_original"] = $_SESSION["nombre"] ?? 'Administrador';
        }

        switch ($rol) {
            case 'abogado':
                $_SESSION["rol"] = "abogado";
                $_SESSION["enfermedad"] = null;
                $_SESSION["simulando"] = "Abogado";
                $redirect = "/public/admin/abogados";
                break;
            case 'psicologo':
                $_SESSION["rol"] = "psicologo";
                $_SESSION["enfermedad"] = null;
                $_SESSION["simulando"] = "Psicólogo";
                $redirect = "/public/admin/psicologos";
                break;
            case 'enfermero':
                $_SESSION["rol"] = "enfermero";
                $_SESSION["enfermedad"] = null;
                $_SESSION["simulando"] = "Enfermero";
                $redirect = "/public/admin/enfermeros";
                break;
            case 'colostomia':
                $_SESSION["rol"] = "paciente";
                $_SESSION["enfermedad"] = "colostomia";
                $_SESSION["simulando"] = "Paciente Ostomizado";
                $redirect = "/public/colostomia";
                break;
            case 'diabetes':
                $_SESSION["rol"] = "paciente";
                $_SESSION["enfermedad"] = "diabetes";
                $_SESSION["simulando"] = "Paciente Diabético";
                $redirect = "/public/diabetes";
                break;
            case 'paciente_citas':
                $_SESSION["rol"] = "paciente";
                $_SESSION["simulando"] = "Paciente (Citas)";
                $redirect = "/public/citas";
                break;
            case 'admin':
            default:
                $_SESSION["rol"] = "admin";
                $_SESSION["admin"] = "1";
                $_SESSION["enfermedad"] = null;
                unset($_SESSION["simulando"]);
                $redirect = "/public/admin/index";
                break;
        }

        header("Location: " . $redirect);
        exit;
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