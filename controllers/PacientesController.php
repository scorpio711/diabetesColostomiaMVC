<?php

namespace Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Model\Paciente;
use MVC\Router;
use Model\Usuario;
use Classes\Email;

class PacientesController
{
    public static function administrarPacientes(Router $router)
    {
        session_start();

        isAdmin();
        $pacientes = Paciente::all();
        $resultado = "";
        $errores = [];

        $router->render("/admin/pacientes/administrar", [
            "pacientes" => $pacientes,
            "resultado"=> $resultado,
            "errores" => $errores
        ]);

    }
}