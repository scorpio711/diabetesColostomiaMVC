<?php

namespace Controllers;

use Model\AdminCita;
use Model\CitaServicios;
use Model\Servicio;
use Model\Cita;


class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar()
    {
        //almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->crear();

        $id = $resultado['id'];

        //Almacena la Cita y el Servio
        $idServicios = explode(',', $_POST['servicios']);

        foreach ($idServicios as $idServicio) {
            $args = [
                "citaId" => $id,
                "servicioId" => $idServicio
            ];

            $citaServicio = new CitaServicios($args);
            $citaServicio->crear();
        }

        //retornamos una respuesta

        echo json_encode(["resultado" => $resultado]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
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
                    header("location:" . $_SERVER["HTTP_REFERER"]);
                }
            }
        }
    }
}