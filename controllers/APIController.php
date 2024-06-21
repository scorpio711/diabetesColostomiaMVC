<?php

namespace Controllers;

use Model\AdminCita;
use Model\CitaServicios;
use Model\Servicio;
use Model\Cita;
use Model\Profesionales;
use Model\Usuario;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function citas($router)
    {
        session_start();
        estaAutenticado();

        $router->render("/cita/citas", [
        ]);
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

    public static function profesionales()
    {
        $query1 = "SELECT id, imagen FROM usuarios WHERE actualizado = 1 AND rol IN ('abogado', 'psicologo', 'enfermero');";
        $usuarios = Usuario::SQL($query1);

        $ids = [];
        $imagenUsuarios = [];
        foreach ($usuarios as $usuario) {
            $ids[] = $usuario->id;
            // Obtener la dirección de la imagen
            $imagenUsuarios[$usuario->id] = $usuario->imagen; // Guardar la imagen usando el ID como clave
        }

        // Convertir el arreglo de IDs en un string separado por comas
        $ids_string = implode(',', $ids);

        // Segunda consulta usando el string de IDs
        $query2 = "SELECT * FROM profesionales WHERE id_usuario IN ($ids_string);";

        // Ejecutar la segunda consulta
        $profesionales = Profesionales::SQL($query2);

        // Agregar la imagen al objeto de cada profesional
        foreach ($profesionales as &$profesional) {
            $id_usuario = $profesional->id_usuario;
            if (isset($imagenUsuarios[$id_usuario])) {
                $profesional->imagenUsuario = $imagenUsuarios[$id_usuario];
            } else {
                // Si no se encuentra la imagen, puedes establecer un valor por defecto o dejarlo como null
                $profesional->imagenUsuario = null;
            }
        }

        // Codificar el resultado como JSON
        echo json_encode($profesionales);

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