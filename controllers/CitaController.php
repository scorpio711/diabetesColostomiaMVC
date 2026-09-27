<?php

namespace Controllers;

use DateTime;
use Model\ActiveRecord;
use Model\AdminCita;
use Model\Cita;
use Model\CitaServicios;
use Model\Profesionales;
use Model\Usuario;
use MVC\Router;

class CitaController
{
    /**
     * Muestra la interfaz para agendar una cita
     */
    public static function view(Router $router)
    {
        session_start();
        estaAutenticado();

        $id = (int) $_SESSION["id"];
        $nombre = $_SESSION["nombre"] ?? "Paciente";

        // Consultar si el paciente actual tiene una cita próxima activa (a partir de hoy)
        $query = "SELECT c.*, p.nombre as prof_nombre, p.apellido as prof_apellido, p.profesion as prof_profesion ";
        $query .= "FROM citas c ";
        $query .= "LEFT JOIN profesionales p ON c.id_profesional = p.id ";
        $query .= "WHERE c.id_paciente = {$id} AND c.fecha >= CURDATE() ";
        $query .= "ORDER BY c.fecha ASC, c.hora ASC LIMIT 1;";

        $citasFuturas = Cita::SQL($query);
        $tieneCitaActiva = !empty($citasFuturas);
        $citaActiva = $tieneCitaActiva ? $citasFuturas[0] : null;

        $router->render("bookings/bookingsView", [
            "ocupado" => $tieneCitaActiva,
            "citaActiva" => $citaActiva,
            "nombre" => $nombre,
            "id" => $id,
        ]);
    }

    /**
     * Listado y gestión de citas del paciente autenticado
     */
    public static function misCitas(Router $router)
    {
        session_start();
        estaAutenticado();

        $id = (int) $_SESSION["id"];
        $resultado = $_GET["resultado"] ?? null;

        // Cancelar cita si se envía solicitud POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $idCita = intval($_POST["citaId"] ?? 0);
            if ($idCita <= 0) {
                $rawInput = json_decode(file_get_contents('php://input'), true);
                if (!empty($rawInput['citaId'])) {
                    $idCita = intval($rawInput['citaId']);
                }
            }

            $cita = Cita::find($idCita);
            $userId = (int) $_SESSION["id"];
            $esAdmin = !empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]);
            $esAjax = !empty($_POST['ajax'])
                || (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
                || (!empty($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false);

            if ($cita && ((int) $cita->id_paciente === $userId || $esAdmin)) {
                $db = ActiveRecord::getDB();
                $db->query("DELETE FROM citaservicios WHERE citaId = {$idCita};");
                $cita->eliminar();

                if ($esAjax) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode([
                        "ok" => true,
                        "mensaje" => "Cita médica cancelada con éxito."
                    ]);
                    exit;
                }

                header("location: /public/misCitas?resultado=1");
                exit;
            } else {
                if ($esAjax) {
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(400);
                    echo json_encode([
                        "ok" => false,
                        "mensaje" => "No se pudo cancelar la cita. Verifica que la cita esté activa."
                    ]);
                    exit;
                }
            }
        }

        // Consultar citas del paciente
        $consulta = "SELECT citaservicios.id as id, citas.id as citaId, citas.fecha, citas.hora, usuarios.nombre, citas.id_paciente, citas.id_profesional, servicios.nombre_servicio ";
        $consulta .= "FROM citas ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.id_paciente = usuarios.id ";
        $consulta .= "LEFT OUTER JOIN profesionales ON citas.id_profesional = profesionales.id ";
        $consulta .= "LEFT OUTER JOIN citaservicios ON citaservicios.citaId = citas.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON servicios.id = citaservicios.servicioId ";
        $consulta .= "WHERE citas.id_paciente = '{$id}' ";
        $consulta .= "ORDER BY citas.fecha DESC, citas.hora DESC;";

        $citas = AdminCita::SQL($consulta);

        // Enriquecer datos de cada cita
        $hoy = date('Y-m-d');
        $ahoraTime = time();
        $totalProximas = 0;
        $totalPasadas = 0;

        foreach ($citas as $cita) {
            $profesional = Profesionales::find($cita->id_profesional);
            if ($profesional) {
                $cita->nombre_profesional = trim($profesional->nombre . " " . $profesional->apellido);
                $cita->profesion = $profesional->profesion ?? '';
                $cita->especializacion = $profesional->especializacion ?? '';
                $cita->telefono_profesional = $profesional->telefono ?? '';
                $cita->email_profesional = !empty($profesional->email) ? $profesional->email : '';

                if (!empty($profesional->id_usuario)) {
                    $uProf = Usuario::find($profesional->id_usuario);
                    $cita->imagen_profesional = !empty($uProf->imagen) ? $uProf->imagen : null;
                    if (empty($cita->email_profesional) && !empty($uProf->email)) {
                        $cita->email_profesional = $uProf->email;
                    }
                } else {
                    $cita->imagen_profesional = null;
                }
            } else {
                $cita->nombre_profesional = "Profesional de la salud";
                $cita->profesion = "";
                $cita->especializacion = "";
                $cita->telefono_profesional = "";
                $cita->email_profesional = "";
                $cita->imagen_profesional = null;
            }

            // Estado de la cita: Próxima / Hoy / Pasada
            $citaTimestamp = strtotime($cita->fecha . ' ' . $cita->hora);
            if ($cita->fecha < $hoy || ($cita->fecha === $hoy && $citaTimestamp < $ahoraTime)) {
                $cita->estado = 'pasada';
                $cita->estado_texto = 'Finalizada';
                $totalPasadas++;
            } elseif ($cita->fecha === $hoy) {
                $cita->estado = 'hoy';
                $cita->estado_texto = 'Para Hoy';
                $totalProximas++;
            } else {
                $cita->estado = 'proxima';
                $cita->estado_texto = 'Confirmada';
                $totalProximas++;
            }

            try {
                $fechaHora = $cita->fecha . " " . $cita->hora;
                $dateTime = new DateTime($fechaHora);
                $cita->fechaHora = $dateTime->format('d/m/Y, H:i');

                $diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                $meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                $diaSemana = $diasSemana[(int) $dateTime->format('w')];
                $diaMes = $dateTime->format('d');
                $mes = $meses[(int) $dateTime->format('n')];
                $anio = $dateTime->format('Y');
                $horaFormateada = $dateTime->format('h:i A');

                $cita->fechaFormateada = "{$diaSemana}, {$diaMes} {$mes} {$anio}";
                $cita->horaFormateada = $horaFormateada;
            } catch (\Exception $e) {
                $cita->fechaHora = $cita->fecha . " " . $cita->hora;
                $cita->fechaFormateada = $cita->fecha;
                $cita->horaFormateada = substr($cita->hora, 0, 5);
            }
        }

        $rol = $_SESSION["rol"] ?? "paciente";
        $nombre = $_SESSION["nombre"] ?? "Paciente";
        $enfermedad = $_SESSION["enfermedad"] ?? null;

        $router->render("/cita/citasUsuario", [
            "citas" => $citas,
            "resultado" => $resultado,
            "rol" => $rol,
            "nombre" => $nombre,
            "enfermedad" => $enfermedad,
            "totalProximas" => $totalProximas,
            "totalPasadas" => $totalPasadas
        ]);
    }

    /**
     * Vista de administración de citas para el rol administrador
     */
    public static function administrarContacto(Router $router)
    {
        session_start();
        isAdmin();
        $rol = $_SESSION["rol"] ?? "admin";

        $fecha = $_GET["fecha"] ?? date("Y-m-d");

        $fechas = explode("-", $fecha);
        if (count($fechas) !== 3 || !checkdate((int) $fechas[1], (int) $fechas[2], (int) $fechas[0])) {
            $fecha = date("Y-m-d");
        }

        // Consultar citas
        $consulta = "SELECT citaservicios.id as id, citas.id as citaId, citas.id_paciente, citas.fecha, citas.hora, usuarios.nombre, usuarios.email, servicios.nombre_servicio ";
        $consulta .= "FROM citas ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.id_paciente = usuarios.id ";
        $consulta .= "LEFT OUTER JOIN citaservicios ON citaservicios.citaId = citas.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON servicios.id = citaservicios.servicioId ";
        $consulta .= "WHERE citas.fecha = '{$fecha}' ";
        $consulta .= "ORDER BY citas.hora ASC;";

        $citas = AdminCita::SQL($consulta);

        $router->render("/admin/citas/contacto", [
            "citas" => $citas,
            "fecha" => $fecha,
            "rol" => $rol
        ]);
    }

    /**
     * Vista de administración de citas para el rol profesional (médico, abogado, etc.)
     */
    public static function administrarCitas(Router $router)
    {
        session_start();
        esFuncionario();

        $resultado = $_GET["resultado"] ?? null;
        $rol = $_SESSION["rol"] ?? "";
        $id = (int) ($_SESSION["id"] ?? 0);

        // Buscar el ID del profesional
        $query = "SELECT id FROM profesionales WHERE id_usuario = {$id} LIMIT 1;";
        $profesional = Profesionales::SQL($query);
        $profesional_id = !empty($profesional) ? intval($profesional[0]->id) : 0;

        // Eliminar cita si se envía POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $idCita = intval($_POST["citaId"] ?? 0);
            $cita = Cita::find($idCita);

            if ($cita && (intval($cita->id_profesional) === $profesional_id || !empty($_SESSION['admin']))) {
                CitaServicios::SQL("DELETE FROM citaservicios WHERE citaId = {$idCita};");
                $cita->eliminar();
                header("location: /public/admin/citas?resultado=1");
                exit;
            }
        }

        // Consulta de citas asignadas a este profesional
        $consulta = "SELECT citaservicios.id as id, citas.id as citaId, citas.fecha, citas.hora, usuarios.nombre, citas.id_paciente, citas.id_profesional, servicios.nombre_servicio ";
        $consulta .= "FROM citas ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.id_paciente = usuarios.id ";
        $consulta .= "LEFT OUTER JOIN profesionales ON citas.id_profesional = profesionales.id ";
        $consulta .= "LEFT OUTER JOIN citaservicios ON citaservicios.citaId = citas.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON servicios.id = citaservicios.servicioId ";
        $consulta .= "WHERE citas.id_profesional = '{$profesional_id}' ";
        $consulta .= "ORDER BY citas.fecha ASC, citas.hora ASC;";

        $citas = AdminCita::SQL($consulta);

        // Enriquecer datos del paciente
        foreach ($citas as $cita) {
            $paciente = Usuario::find($cita->id_paciente);
            $cita->email_paciente = $paciente->email ?? "No registrado";
            $cita->telefono = $paciente->telefono ?? "No registrado";
            $cita->condicion = $paciente->enfermedad ?? "General";

            try {
                $fechaHora = $cita->fecha . " " . $cita->hora;
                $dateTime = new DateTime($fechaHora);
                $cita->fechaHora = $dateTime->format('d/m/Y, H:i');
            } catch (\Exception $e) {
                $cita->fechaHora = $cita->fecha . " " . $cita->hora;
            }
        }

        $router->render("admin/citas/admincitas", [
            "citas" => $citas,
            "resultado" => $resultado,
            "rol" => $rol
        ]);
    }
}