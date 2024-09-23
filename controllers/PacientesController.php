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
        // debuguear($_SESSION);
        $rol = $_SESSION["rol"];

        esFuncionario();
        $query = "SELECT pacientes.*,usuarios.email,usuarios.telefono,usuarios.imagen FROM pacientes LEFT JOIN usuarios ON pacientes.pacienteId = usuarios.id;";
        $pacientes = Paciente::SQL($query);
        $resultado = "";
        $errores = [];

        $router->render("/admin/pacientes/administrar", [
            "pacientes" => $pacientes,
            "resultado"=> $resultado,
            "errores" => $errores,
            "rol" => $rol
        ]);

    }
}