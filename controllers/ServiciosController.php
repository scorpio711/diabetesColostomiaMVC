<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServiciosController
{
    public static function administrarServicios(Router $router)
    {
        session_start();
        isAdmin();

        $resultado = $_GET['resultado'];
        $errores = [];
        $erroresActualizacion = [];

        $servicios = Servicio::all();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['crear'])) {
                $servicioC = new Servicio($_POST);

                $errores = $servicioC->validarServicio();
                
                if (empty($errores)) {
                    $resultado = $servicioC->crear();

                    if ($resultado) {
                        header("location:/public/admin/servicios/administrar?resultado=1");
                    }
                }
            }
            if(isset($_POST['actualizar'])){
                $servicio = new Servicio($_POST);

                //Validar
                $erroresActualizacion = $servicio->validarServicio();

                if(empty($erroresActualizacion)){
                    //Actualizar el servicio si no hay errores
                    $resultado = $servicio->actualizar();

                    if ($resultado) {
                        header("location:/public/admin/servicios/administrar?resultado=2");
                    }
                }
            }
            if(isset($_POST['borrar'])){
                $id = $_POST["id"];
                $servicio = Servicio::find($id);
                $resultado = $servicio->eleminar();

                if ($resultado) {
                    header("location:/public/admin/servicios/administrar?resultado=3");
                }
            }
        }

        $router->render("/admin/servicios/administrarServicios", [
            "resultado" => $resultado,
            "servicios" => $servicios,
            "servicioC" => $servicioC,
            "errores" => $errores,
            "erroresActualizacion" => $erroresActualizacion
        ]);
    }
}
