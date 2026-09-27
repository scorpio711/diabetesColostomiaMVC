<?php

namespace Controllers;

use Model\Paciente;
use MVC\Router;

class PacientesController
{
    public static function administrarPacientes(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        esFuncionario();
        $rol = $_SESSION["rol"] ?? "profesional";
        $resultado = $_GET["resultado"] ?? "";
        $errores = [];

        // Query enriquecida con información clínica y encuestas
        $query = "SELECT pacientes.*, usuarios.email, usuarios.telefono, usuarios.imagen, 
                         usuarios.enfermedad, usuarios.encuesta_salud, usuarios.encuesta_psicologia, 
                         usuarios.encuesta_juridico, usuarios.fecha_nacimiento 
                  FROM pacientes 
                  LEFT JOIN usuarios ON pacientes.pacienteId = usuarios.id 
                  ORDER BY pacientes.id DESC;";
        $pacientes = Paciente::SQL($query);

        // Métricas clínicas calculadas
        $totalPacientes = count($pacientes);
        $totalColostomia = 0;
        $totalDiabetes = 0;
        $totalEncuestas = 0;

        foreach ($pacientes as $paciente) {
            $enf = strtolower(trim($paciente->enfermedad ?? ''));
            if ($enf === 'colostomia') {
                $totalColostomia++;
            } elseif ($enf === 'diabetes') {
                $totalDiabetes++;
            }

            if (!empty($paciente->encuesta_salud) || !empty($paciente->encuesta_psicologia) || !empty($paciente->encuesta_juridico)) {
                $totalEncuestas++;
            }
        }

        $stats = [
            'total' => $totalPacientes,
            'colostomia' => $totalColostomia,
            'diabetes' => $totalDiabetes,
            'encuestas' => $totalEncuestas
        ];

        $router->render("/admin/pacientes/administrar", [
            "pacientes" => $pacientes,
            "resultado" => $resultado,
            "errores" => $errores,
            "rol" => $rol,
            "stats" => $stats
        ]);
    }
}