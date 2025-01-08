<?php

namespace Controllers;

use Model\EncuestaSalud;
use Model\Usuario;
use MVC\Router;

class EncuestasController
{
    public static function encuesta(Router $router)
    {
        session_start();
        estaAutenticado();
        $id = $_SESSION["id"];
        $query = "SELECT * FROM encuestasalud WHERE usuario_id = ${id};";
        $realizo_encuesta = EncuestaSalud::SQL($query);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            function convertScores($inputArray)
            {
                $convertedArray = [];
                $categorySums = [];

                foreach ($inputArray as $category => $scores) {
                    $convertedArray[$category] = [];

                    foreach ($scores as $key => $score) {
                        $scoreNumeric = intval($score);

                        if ($scoreNumeric >= 0 && $scoreNumeric <= 25) {
                            $convertedArray[$category][$key] = 4;
                        } elseif ($scoreNumeric >= 26 && $scoreNumeric <= 50) {
                            $convertedArray[$category][$key] = 3;
                        } elseif ($scoreNumeric >= 51 && $scoreNumeric <= 75) {
                            $convertedArray[$category][$key] = 2;
                        } elseif ($scoreNumeric >= 76 && $scoreNumeric <= 100) {
                            $convertedArray[$category][$key] = 1;
                        } else {
                            $convertedArray[$category][$key] = null;
                        }
                    }

                    // Sumar los valores convertidos para cada categoría
                    $categorySums[$category] = array_sum($convertedArray[$category]);
                }

                // Categorizar los resultados
                $categoryLevels = [];
                foreach ($categorySums as $category => $sum) {
                    if ($sum >= 5 && $sum <= 10) {
                        $categoryLevels[$category] = 'Bajo';
                    } elseif ($sum >= 11 && $sum <= 15) {
                        $categoryLevels[$category] = 'Medio';
                    } elseif ($sum >= 16 && $sum <= 20) {
                        $categoryLevels[$category] = 'Alto';
                    } else {
                        $categoryLevels[$category] = 'Fuera de rango';
                    }
                }

                return [
                    // 'converted_scores' => $convertedArray,
                    'category_sums' => $categorySums,
                    'category_levels' => $categoryLevels
                ];
            }

            // Ejemplo de uso
            $inputArray = $_POST;
            $result = convertScores($inputArray);
            $total = array_sum($result["category_sums"]);
            //Categorizar el puntaje total
            if ($total >= 25 && $total <= 50) {
                $categoria = "Bajo";
            } elseif ($total >= 51 && $total <= 75) {
                $categoria = "Medio";
            } elseif ($total >= 76 && $total <= 100) {
                $categoria = "Alto";
            } else {
                $categoria = "Fuera de rango";
            }

            $resultadoEncuesta = new EncuestaSalud();
            $resultadoEncuesta->usuario_id = intval($_SESSION["id"]);
            $resultadoEncuesta->cuidado_instrumental = $result["category_levels"]["intrumental"];
            $resultadoEncuesta->alimentacion = $result["category_levels"]["alimentacion"];
            $resultadoEncuesta->adaptaciones = $result["category_levels"]["adaptacion"];
            $resultadoEncuesta->actividad_fisica = $result["category_levels"]["actividad"];
            $resultadoEncuesta->signos_alarma = $result["category_levels"]["alarma"];
            $resultadoEncuesta->categoria_total = $categoria;

            $resultado = $resultadoEncuesta->crear();
        }
        $router->render("paginas/encuesta", [
            "realizo_encuesta" => $realizo_encuesta,
        ]);
    }
    public static function adminSalud($router)
    {
        session_start();
        estaAutenticado();
        $array1 = EncuestaSalud::all();

        //obtener otros datos del paciente
        $query = "SELECT usuarios.nombre, usuarios.enfermedad FROM usuarios INNER JOIN encuestasalud ON usuarios.id = encuestasalud.usuario_id;";
        $array2 = Usuario::SQL($query);
        $resultados = [];
        foreach ($array1 as $key => $value) {
            $resultados[] = [$value, $array2[$key]];
        }
        debuguear($resultados);
        $router->render("/admin/encuestas/salud", [
            "resultados" => $resultados
        ]);
    }
}