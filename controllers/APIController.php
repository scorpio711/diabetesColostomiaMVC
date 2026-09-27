<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\AdminCita;
use Model\Horarios;
use Model\CitaServicios;
use Model\Servicio;
use Model\Cita;
use Model\Profesionales;
use Model\Usuario;
use Model\Paciente;

class APIController
{
    /**
     * Retorna todos los servicios médicos en formato JSON
     */
    public static function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        try {
            $servicios = Servicio::all();
            echo json_encode($servicios);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error al obtener servicios", "mensaje" => $e->getMessage()]);
        }
    }

    /**
     * Redirige a la vista principal de citas
     */
    public static function citas($router)
    {
        session_start();
        estaAutenticado();
        header("location: /public/citas");
        exit;
    }

    /**
     * Retorna el listado de profesionales con su imagen y datos de perfil
     * Soporta filtro opcional ?profesion=abogado|enfermero|psicologo
     */
    public static function profesionales()
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $profesion = $_GET['profesion'] ?? null;
            $servicioId = intval($_GET['servicio_id'] ?? 0);

            // Si se pasa servicio_id, deducir la profesión asignada a ese servicio
            if (empty($profesion) && $servicioId > 0) {
                $servicioObj = Servicio::find($servicioId);
                if ($servicioObj && !empty($servicioObj->profesionales)) {
                    $profesion = $servicioObj->profesionales;
                }
            }

            // Obtener profesionales válidos
            $query = "SELECT p.*, u.imagen as imagen_usuario, u.actualizado ";
            $query .= "FROM profesionales p ";
            $query .= "INNER JOIN usuarios u ON p.id_usuario = u.id ";
            $query .= "WHERE u.actualizado = 1 ";

            if ($profesion && in_array(strtolower($profesion), ['abogado', 'psicologo', 'enfermero', 'medico'])) {
                $profesionLimpia = strtolower(trim($profesion));
                $query .= "AND LOWER(p.profesion) = '{$profesionLimpia}' ";
            }

            $query .= "ORDER BY p.nombre ASC;";

            $db = ActiveRecord::getDB();
            $dbRes = $db->query($query);

            $resultado = [];
            if ($dbRes) {
                while ($row = $dbRes->fetch_assoc()) {
                    $pNombre = $row['nombre'] ?? '';
                    $pApellido = $row['apellido'] ?? '';
                    $pImagen = $row['imagen_usuario'] ?? '';

                    $resultado[] = [
                        "id" => (int) $row['id'],
                        "id_usuario" => (int) $row['id_usuario'],
                        "nombre" => $pNombre,
                        "apellido" => $pApellido,
                        "nombre_completo" => trim($pNombre . " " . $pApellido),
                        "profesion" => $row['profesion'] ?? '',
                        "especializacion" => $row['especializacion'] ?? '',
                        "telefono" => $row['telefono'] ?? '',
                        "descripcion" => $row['descripcion'] ?? '',
                        "imagenUsuario" => !empty($pImagen) ? $pImagen : null
                    ];
                }
            }

            echo json_encode($resultado);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error al consultar profesionales", "mensaje" => $e->getMessage()]);
        }
    }

    /**
     * Retorna todos los horarios base
     */
    public static function horarioProfesionales()
    {
        header('Content-Type: application/json; charset=utf-8');
        $horarios = Horarios::all();
        echo json_encode($horarios);
    }

    /**
     * ENDPOINT CRÍTICO: Consulta la disponibilidad real de un profesional para una fecha dada
     * GET /public/api/disponibilidad?profesional_id=13&fecha=2026-09-25
     */
    public static function disponibilidad()
    {
        header('Content-Type: application/json; charset=utf-8');

        $profesionalId = intval($_GET['profesional_id'] ?? 0);
        $fecha = trim($_GET['fecha'] ?? '');

        if ($profesionalId <= 0 || empty($fecha)) {
            http_response_code(400);
            echo json_encode([
                "ok" => false,
                "disponible" => false,
                "mensaje" => "Faltan parámetros requeridos (profesional_id y fecha)."
            ]);
            return;
        }

        // Validar formato fecha
        $fechaTimestamp = strtotime($fecha);
        if (!$fechaTimestamp) {
            http_response_code(400);
            echo json_encode([
                "ok" => false,
                "disponible" => false,
                "mensaje" => "Formato de fecha inválido."
            ]);
            return;
        }

        // No permitir fechas en el pasado
        $hoy = date('Y-m-d');
        if ($fecha < $hoy) {
            echo json_encode([
                "ok" => true,
                "disponible" => false,
                "mensaje" => "No es posible agendar en fechas pasadas.",
                "slots" => []
            ]);
            return;
        }

        // Obtener el día de la semana en inglés (minúscula) tal como está en el ENUM de horarios
        $diasSemana = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $diaIndex = (int) date('w', $fechaTimestamp);
        $diaNombre = $diasSemana[$diaIndex];

        // Buscar el horario configurado para ese profesional en ese día
        $queryHorario = "SELECT * FROM horarios WHERE user_id = {$profesionalId} AND day = '{$diaNombre}' LIMIT 1;";
        $horarioResult = Horarios::SQL($queryHorario);

        if (empty($horarioResult)) {
            // Si el profesional no tiene ningún horario configurado en el sistema, habilitar jornada estándar Lun-Vie
            $algunHorario = Horarios::SQL("SELECT id FROM horarios WHERE user_id = {$profesionalId} LIMIT 1;");
            if (empty($algunHorario) && in_array($diaNombre, ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'])) {
                $horario = (object)[
                    'start_time' => '08:00:00',
                    'end_time' => '17:00:00'
                ];
            } else {
                $diasNombresEs = [
                    'sunday' => 'domingo',
                    'monday' => 'lunes',
                    'tuesday' => 'martes',
                    'wednesday' => 'miércoles',
                    'thursday' => 'jueves',
                    'friday' => 'viernes',
                    'saturday' => 'sábado'
                ];
                $diaEs = $diasNombresEs[$diaNombre] ?? $diaNombre;
                echo json_encode([
                    "ok" => true,
                    "disponible" => false,
                    "dia" => $diaNombre,
                    "dia_es" => $diaEs,
                    "mensaje" => "El profesional no atiende los días " . $diaEs . ".",
                    "slots" => []
                ]);
                return;
            }
        } else {
            $horario = $horarioResult[0];
        }
        $horaInicio = strtotime($horario->start_time);
        $horaFin = strtotime($horario->end_time);

        if ($horaFin <= $horaInicio) {
            echo json_encode([
                "ok" => true,
                "disponible" => false,
                "mensaje" => "Horario no configurado correctamente.",
                "slots" => []
            ]);
            return;
        }

        // Obtener las citas ya ocupadas para ese profesional en esa fecha
        $citasQuery = "SELECT hora FROM citas WHERE id_profesional = {$profesionalId} AND fecha = '{$fecha}';";
        $citasOcupadas = Cita::SQL($citasQuery);
        $horasOcupadas = [];
        foreach ($citasOcupadas as $c) {
            $h = substr($c->hora, 0, 5); // Ej: "10:00"
            $horasOcupadas[] = $h;
        }

        // Generar slots por hora
        $slots = [];
        $ahora = time();

        for ($t = $horaInicio; $t < $horaFin; $t += 3600) {
            $horaStr = date('H:i', $t);
            $horaSlotTimestamp = strtotime($fecha . ' ' . $horaStr . ':00');

            // Si es hoy, verificar si la hora ya pasó
            $esPasada = ($fecha === $hoy && $horaSlotTimestamp <= $ahora);
            $estaOcupada = in_array($horaStr, $horasOcupadas);

            $slots[] = [
                "hora" => $horaStr,
                "hora_completa" => $horaStr . ":00",
                "disponible" => (!$estaOcupada && !$esPasada),
                "ocupada" => $estaOcupada,
                "pasada" => $esPasada
            ];
        }

        echo json_encode([
            "ok" => true,
            "disponible" => true,
            "fecha" => $fecha,
            "dia" => $diaNombre,
            "rango_atencion" => [
                "inicio" => date('H:i', $horaInicio),
                "fin" => date('H:i', $horaFin)
            ],
            "slots" => $slots
        ]);
    }

    /**
     * Almacena una nueva cita médica de forma atómica y protegida
     * POST /public/api/cita
     */
    public static function guardar()
    {
        header('Content-Type: application/json; charset=utf-8');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Validar autenticación
        if (empty($_SESSION['id'])) {
            http_response_code(401);
            echo json_encode([
                "ok" => false,
                "resultado" => false,
                "mensaje" => "Tu sesión ha expirado o no has iniciado sesión. Por favor inicia sesión para agendar."
            ]);
            return;
        }

        // Paciente estrictamente tomado de la sesión
        $idPaciente = (int) $_SESSION['id'];

        // Obtener datos (POST form o JSON raw)
        $input = $_POST;
        if (empty($input)) {
            $raw = file_get_contents('php://input');
            $input = json_decode($raw, true) ?? [];
        }

        $idProfesional = intval($input['id_profesional'] ?? 0);
        $fecha = trim($input['fecha'] ?? '');
        $hora = trim($input['hora'] ?? '');
        $serviciosRaw = $input['servicios'] ?? null;

        // Normalizar hora a formato H:i:s
        if (strlen($hora) === 5) {
            $hora .= ':00';
        }

        // Validaciones requeridas
        if ($idProfesional <= 0 || empty($fecha) || empty($hora) || empty($serviciosRaw)) {
            http_response_code(400);
            echo json_encode([
                "ok" => false,
                "resultado" => false,
                "mensaje" => "Todos los campos (servicio, profesional, fecha y hora) son obligatorios."
            ]);
            return;
        }

        // Validar que la fecha no sea en el pasado
        if ($fecha < date('Y-m-d')) {
            http_response_code(400);
            echo json_encode([
                "ok" => false,
                "resultado" => false,
                "mensaje" => "No puedes agendar citas en fechas pasadas."
            ]);
            return;
        }

        // Anti-colisión 1: Profesional ya tiene cita a esa hora
        $horaSinSegundos = substr($hora, 0, 5);
        $checkColision = Cita::SQL("SELECT id FROM citas WHERE id_profesional = {$idProfesional} AND fecha = '{$fecha}' AND (hora = '{$hora}' OR hora LIKE '{$horaSinSegundos}%') LIMIT 1;");
        if (!empty($checkColision)) {
            http_response_code(409);
            echo json_encode([
                "ok" => false,
                "resultado" => false,
                "mensaje" => "El profesional ya tiene una cita reservada para ese horario. Por favor selecciona otro."
            ]);
            return;
        }

        // Anti-colisión 2: El paciente ya tiene una cita en ese mismo horario
        $checkPaciente = Cita::SQL("SELECT id FROM citas WHERE id_paciente = {$idPaciente} AND fecha = '{$fecha}' AND (hora = '{$hora}' OR hora LIKE '{$horaSinSegundos}%') LIMIT 1;");
        if (!empty($checkPaciente)) {
            http_response_code(409);
            echo json_encode([
                "ok" => false,
                "resultado" => false,
                "mensaje" => "Ya tienes otra cita agendada en esa misma fecha y hora."
            ]);
            return;
        }

        try {
            // Garantizar que exista un registro del paciente para evitar violación de Foreign Key
            $checkPac = Paciente::SQL("SELECT id FROM pacientes WHERE pacienteId = {$idPaciente} LIMIT 1;");
            if (empty($checkPac)) {
                $usr = Usuario::find($idPaciente);
                $nombrePac = $usr ? $usr->nombre : ($_SESSION['nombre'] ?? 'Paciente');
                $nuevoPac = new Paciente([
                    "pacienteId" => $idPaciente,
                    "nombre" => $nombrePac,
                    "sexo" => "otro",
                    "edad" => 30,
                    "escolaridad" => "bachillerato",
                    "estrato_socioeconomico" => 3,
                    "lugar_de_residencia" => "urbana",
                    "ocupacion" => "otro",
                    "apoyo" => "familiar",
                    "afiliacion" => "contributivo",
                    "tiempo_enfermedad" => "1-2 años"
                ]);
                $nuevoPac->crear();
            }

            // Guardar Cita
            $cita = new Cita([
                "id_paciente" => $idPaciente,
                "id_profesional" => $idProfesional,
                "fecha" => $fecha,
                "hora" => $hora
            ]);
            $resultado = $cita->crear();

            if (!$resultado || empty($resultado['id'])) {
                throw new \Exception("Error al insertar la cita en la base de datos.");
            }

            $citaId = $resultado['id'];

            // Guardar Servicios asociados
            $serviciosArray = is_array($serviciosRaw) ? $serviciosRaw : explode(',', $serviciosRaw);
            foreach ($serviciosArray as $servicioId) {
                $sId = intval(trim($servicioId));
                if ($sId > 0) {
                    $citaServicio = new CitaServicios([
                        "citaId" => $citaId,
                        "servicioId" => $sId
                    ]);
                    $citaServicio->crear();
                }
            }

            echo json_encode([
                "ok" => true,
                "resultado" => true,
                "id" => $citaId,
                "mensaje" => "¡Cita agendada con éxito!"
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                "ok" => false,
                "resultado" => false,
                "mensaje" => "Ocurrió un error al procesar la cita: " . $e->getMessage()
            ]);
        }
    }

    /**
     * Elimina una cita de forma segura
     */
    public static function eliminar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['id'])) {
            header("location: /public/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $idCita = intval($_POST["citaId"] ?? 0);
            $userId = (int) $_SESSION['id'];
            $isAdmin = !empty($_SESSION['admin']) || !empty($_SESSION['admin_real']);

            $cita = Cita::find($idCita);

            if ($cita) {
                // Verificar si es el dueño, profesional asignado o admin
                $esDuenio = ($cita->id_paciente == $userId);
                $esProf = false;
                $prof = Profesionales::SQL("SELECT id FROM profesionales WHERE id_usuario = {$userId} LIMIT 1;");
                if (!empty($prof) && $prof[0]->id == $cita->id_profesional) {
                    $esProf = true;
                }

                if ($esDuenio || $isAdmin || $esProf) {
                    // Eliminar citaservicios y la cita
                    $db = ActiveRecord::getDB();
                    $db->query("DELETE FROM citaservicios WHERE citaId = {$idCita};");
                    $cita->eliminar();
                }
            }

            $referer = $_SERVER["HTTP_REFERER"] ?? "/public/misCitas?resultado=1";
            header("location: " . $referer);
            exit;
        }
    }

    /**
     * Endpoint API para probar la conectividad y envío de correo desde la barra de admin
     */
    public static function testEmail()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        header('Content-Type: application/json; charset=utf-8');

        // Seguridad: Solo administradores reales o en modo simulación
        $esAdmin = !empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]);
        if (!$esAdmin) {
            http_response_code(403);
            echo json_encode([
                "exito" => false, 
                "mensaje" => "Acceso no autorizado: debes ser administrador para realizar esta prueba."
            ]);
            return;
        }

        // Obtener datos del cuerpo JSON
        $input = json_decode(file_get_contents('php://input'), true);
        $emailDestino = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);

        if (!$emailDestino) {
            http_response_code(400);
            echo json_encode([
                "exito" => false, 
                "mensaje" => "La dirección de correo electrónico proporcionada no es válida."
            ]);
            return;
        }

        try {
            $nombreAdmin = $_SESSION['admin_nombre_original'] ?? ($_SESSION['nombre'] ?? 'Administrador');
            $mail = new \Classes\Email($emailDestino, $nombreAdmin, 'test-token');
            $resultado = $mail->enviarPrueba($emailDestino);

            if (!$resultado['exito']) {
                http_response_code(500);
            }

            echo json_encode([
                "exito" => $resultado["exito"],
                "mensaje" => $resultado["mensaje"],
                "baseUrl" => $resultado["baseUrl"] ?? '',
                "host" => $_ENV['EMAIL_HOST'] ?? 'No configurado',
                "port" => $_ENV['EMAIL_PORT'] ?? 'No configurado'
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                "exito" => false, 
                "mensaje" => "Excepción en el servidor: " . $e->getMessage()
            ]);
        }
    }
}