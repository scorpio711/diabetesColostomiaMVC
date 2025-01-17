<?php

namespace Controllers;

use Model\encuestaJuridica;
use Model\encuestaPsicologia;
use Model\EncuestaSalud;
use Model\Usuario;
use MVC\Router;

class EncuestasController
{
    public static function encuestaSalud(Router $router)
    {
        session_start();
        estaAutenticado();
        $id = $_SESSION["id"];
        $conteo = EncuestaSalud::contarPorId("usuario_id", $id);
        $usuario = Usuario::find($id);
        $encuestaHabilitada = intval($usuario->encuesta_salud);

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
            $resultadoEncuesta->intento = $conteo + 1;
            debuguear($resultadoEncuesta);
            $usuario->encuesta_salud = 1;
            $usuario->actualizar();

            $resultado = $resultadoEncuesta->crear();
            if ($resultado) {
                header("location:/public");
            }
        }
        $router->render("paginas/encuestaSalud", [
            "encuestaHabilitada" => $encuestaHabilitada
        ]);
    }
    public static function adminSalud($router)
    {
        session_start();
        estaAutenticado();
        $rol = $_SESSION["rol"];
        $encuestas = Usuario::unirTabla("usuarios", "encuestasalud", "id", "usuario_id");
        $resultado = $_GET["resultado"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = intval($_POST["investigacion"]["id"]);
            $usuario = Usuario::find($id);
            $usuario->encuesta_salud = 0;

            $resultado = $usuario->actualizar();

            if ($resultado) {
                header("location:/public/admin/encuestaSalud?resultado=2");
            }
        }

        $router->render("/admin/encuestas/salud", [
            "rol" => $rol,
            "encuestas" => $encuestas,
            "resultado" => $resultado
        ]);
    }
    public static function encuestaPsicologia(Router $router)
    {
        session_start();
        estaAutenticado();
        $id = $_SESSION["id"];
        $conteo = encuestaPsicologia::contarPorId("usuario_id", $id);
        $usuario = Usuario::find($id);
        $encuestaHabilitada = intval($usuario->encuesta_psicologia);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $tristeza_depresion = (intval($_POST["pregunta4"]) + intval($_POST["pregunta7"]) + intval($_POST["pregunta10"]) + intval($_POST["pregunta16"])) / 4;
            $ansiedad = (intval($_POST["pregunta1"]) + intval($_POST["pregunta5"]) + intval($_POST["pregunta9"]) + intval($_POST["pregunta13"])) / 4;
            $ira_hostilidad = (intval($_POST["pregunta2"]) + intval($_POST["pregunta8"]) + intval($_POST["pregunta11"]) + intval($_POST["pregunta14"])) / 4;
            $alegria = (intval($_POST["pregunta3"]) + intval($_POST["pregunta6"]) + intval($_POST["pregunta12"]) + intval($_POST["pregunta15"])) / 4;

            $resultadoEncuesta = new encuestaPsicologia();
            $resultadoEncuesta->usuario_id = intval($_SESSION["id"]);
            $resultadoEncuesta->tristeza_depresion = $tristeza_depresion;
            $resultadoEncuesta->ansiedad = $ansiedad;
            $resultadoEncuesta->ira_hostilidad = $ira_hostilidad;
            $resultadoEncuesta->alegria = $alegria;
            $resultadoEncuesta->intento = $conteo + 1;
            $usuario->encuesta_psicologia = 1;
            $usuario->actualizar();

            $resultado = $resultadoEncuesta->crear();

            if ($resultado) {
                header("location:/public");
            }
        }
        $router->render("paginas/encuestaPsicologia", [
            "encuestaHabilitada" => $encuestaHabilitada
        ]);
    }
    public static function adminPsicologia($router)
    {
        session_start();
        estaAutenticado();
        $rol = $_SESSION["rol"];
        $encuestas = Usuario::unirTabla("usuarios", "encuestapsicologia", "id", "usuario_id");
        $resultado = $_GET["resultado"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = intval($_POST["investigacion"]["id"]);
            $usuario = Usuario::find($id);
            $usuario->encuesta_psicologia = 0;

            $resultado = $usuario->actualizar();

            if ($resultado) {
                header("location:/public/admin/encuestaPsicologia?resultado=2");
            }
        }

        $router->render("/admin/encuestas/psicologia", [
            "rol" => $rol,
            "encuestas" => $encuestas,
            "resultado" => $resultado
        ]);
    }
    public static function encuestaJuridica(Router $router)
    {
        session_start();
        estaAutenticado();
        $id = $_SESSION["id"];
        $conteo = encuestaJuridica::contarPorId("usuario_id", $id);
        $usuario = Usuario::find($id);
        $encuestaHabilitada = intval($usuario->encuesta_juridico);

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

            $resultadoEncuesta = new encuestaJuridica();
            $resultadoEncuesta->usuario_id = intval($_SESSION["id"]);
            $resultadoEncuesta->fundamental = $result["category_levels"]["fundamental"];
            $resultadoEncuesta->salud = $result["category_levels"]["salud"];
            $resultadoEncuesta->peticion = $result["category_levels"]["peticion"];
            $resultadoEncuesta->proceso = $result["category_levels"]["proceso"];
            $resultadoEncuesta->tutela = $result["category_levels"]["tutela"];
            $resultadoEncuesta->dignidad = $result["category_levels"]["dignidad"];
            $resultadoEncuesta->categoria_total = $categoria;
            $resultadoEncuesta->intento = $conteo + 1;
            $usuario->encuesta_juridico = 1;
            $usuario->actualizar();

            $resultado = $resultadoEncuesta->crear();
            if ($resultado) {
                header("location:/public");
            }
        }
        $router->render("paginas/encuestaJuridica", [
            "encuestaHabilitada" => $encuestaHabilitada
        ]);
    }
    public static function adminJuridica($router)
    {
        session_start();
        estaAutenticado();
        $rol = $_SESSION["rol"];
        $encuestas = Usuario::unirTabla("usuarios", "encuestajuridica", "id", "usuario_id");
        $resultado = $_GET["resultado"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = intval($_POST["investigacion"]["id"]);
            $usuario = Usuario::find($id);
            $usuario->encuesta_juridico = 0;

            $resultado = $usuario->actualizar();

            if ($resultado) {
                header("location:/public/admin/encuestaJuridica?resultado=2");
            }
        }

        $router->render("/admin/encuestas/juridica", [
            "rol" => $rol,
            "encuestas" => $encuestas,
            "resultado" => $resultado
        ]);
    }
}