<?php

namespace Controllers;

use Model\AdminCita;
use Model\Cita;
use Model\CitaServicios;
use MVC\Router;

class CitaController
{
    public static function index(Router $router)
    {

        estaAutenticado();
        session_start();

        $router->render("cita/index", [
            "nombre" => $_SESSION["nombre"],
            "id" => $_SESSION["id"],
        ]);
    }

    public static function misCitas(Router $router)
    {
        estaAutenticado();
        session_start();
        $id = $_SESSION["id"];
        
        $resultado = $_GET["resultado"];

        $consulta = "SELECT citaservicios.id as id, citas.id as citaId, citas.fecha, citas.hora, usuarios.nombre, citas.id_paciente, servicios.nombre_servicio ";
        $consulta .= "FROM citas ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.id_paciente = usuarios.id ";
        $consulta .= "LEFT OUTER JOIN citaservicios ON citaservicios.citaId = citas.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON servicios.id = citaservicios.servicioId ";
        $consulta .= "WHERE id_paciente = '${id}'";
        
        $citas = AdminCita::SQL($consulta);
        
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $idCita = $_POST["citaId"];
            $consulta2 = "SELECT * FROM citaservicios where citaId ='${idCita}';";
            $cita = CitaServicios::SQL($consulta2);
            $contador = count($cita);

            if ($contador == 1) {
                $cita = Cita::find($idCita);   
                $resultado = $cita->eleminar();

            } else {
               
                $id = $_POST["id"];
                $cita = CitaServicios::find($id);
                $resultado = $cita->eleminar();
            }

            if ($resultado) {
                header("location:/public/misCitas?resultado=1");
            }
        }

        $router->render("/cita/citasUsuario", [
            "citas" => $citas,
            "resultado" => $resultado
        ]);
    }

    public static function administrarCitas(Router $router)
    {
        isAdmin();
        session_start();

        $fecha = $_GET["fecha"] ?? date("Y-m-d", strtotime("-0 day"));

        $fechas = explode("-", $fecha);

        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /public/404");
        }

        //Consulta la base de datos
        $consulta = "SELECT citaservicios.id as id, citas.id as citaId, citas.id_paciente ,citas.fecha, citas.hora, usuarios.nombre, usuarios.email, servicios.nombre_servicio ";
        $consulta .= "FROM citas ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.id_paciente = usuarios.id ";
        $consulta .= "LEFT OUTER JOIN citaservicios ON citaservicios.citaId = citas.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON servicios.id = citaservicios.servicioId ";
        // $consulta .= "WHERE fecha = '${fecha}'";

        $citas = AdminCita::SQL($consulta);

        $router->render("/admin/citas/administrar", [
            "citas" => $citas,
            "fecha" => $fecha,
        ]);
    }

}