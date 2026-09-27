<?php

namespace Controllers;

use MVC\Router;
use Model\Profesionales;
use Model\Usuario;
use Model\Horarios;
use Classes\Email;
use Intervention\Image\ImageManagerStatic as Image;


class ProfesionalesController
{
    public static function administrarProfesionales(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        $resultado = $_GET["resultado"] ?? null;
        $errores = [];

        // Objetos por defecto para el formulario de creación (evita Undefined variable en GET)
        $profesionalC = new Profesionales();
        $usuariosC = new Usuario();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // ==========================================
            // ACCIÓN: CREAR PROFESIONAL
            // ==========================================
            if (isset($_POST["crear"])) {
                $profesionalC = new Profesionales($_POST);
                $usuariosC = new Usuario($_POST);

                // Relacionar los datos con los usuarios
                $usuariosC->nombre = trim($profesionalC->nombre);
                $usuariosC->email = trim($profesionalC->email);
                $usuariosC->fecha_nacimiento = $_POST["fecha_nacimiento"] ?? '';
                $usuariosC->sexo = $profesionalC->sexo;
                $usuariosC->rol = $profesionalC->profesion;

                // Validar entidades
                $erroresProf = $profesionalC->validarProfesional();
                $erroresUser = $usuariosC->validarProfesional();
                $errores = array_unique(array_merge($erroresProf, $erroresUser));

                $contrasena = trim($_POST["contraseña"] ?? '');
                if (empty($contrasena)) {
                    $errores[] = "Debes asignar una contraseña para la cuenta del profesional";
                } elseif (strlen($contrasena) < 6) {
                    $errores[] = "La contraseña debe contener al menos 6 caracteres";
                }

                // Validar si ya existe un usuario con este correo
                $existeUsuario = $usuariosC->existeUsuario();
                if ($existeUsuario && $existeUsuario->num_rows) {
                    $errores[] = "El correo electrónico ya se encuentra registrado por otro usuario";
                }

                if (empty($errores)) {
                    // Calcular la edad de manera segura
                    $fechaNacimiento = $_POST["fecha_nacimiento"] ?? null;
                    $edad = 0;
                    if (!empty($fechaNacimiento)) {
                        try {
                            $nac = new \DateTime($fechaNacimiento);
                            $hoy = new \DateTime();
                            $edad = $nac->diff($hoy)->y;
                        } catch (\Throwable $e) {
                            $edad = 0;
                        }
                    }
                    $profesionalC->edad = $edad;
                    $profesionalC->email = $usuariosC->email;

                    // Administrar el password
                    $usuariosC->password = $contrasena;
                    $usuariosC->hashPassword();

                    // Generar token y enviar confirmación por email
                    $usuariosC->crearToken();

                    try {
                        $email = new Email($usuariosC->email, $usuariosC->nombre, $usuariosC->token);
                        $email->enviarConfirmacion($usuariosC->email);
                    } catch (\Throwable $e) {
                        // Continuar si el servicio de correo no está disponible localmente
                    }

                    // Crear usuario
                    $usuariosC->crear();

                    // Vincular el id_usuario recién creado
                    $usuarioCreado = Usuario::findEmail($usuariosC->email);
                    if ($usuarioCreado) {
                        $profesionalC->id_usuario = $usuarioCreado->id;
                    }

                    $resProf = $profesionalC->crear();

                    if ($resProf) {
                        header("location: /public/admin/profesionales/administrar?resultado=1");
                        exit;
                    }
                }
            }

            // ==========================================
            // ACCIÓN: ACTUALIZAR PROFESIONAL (DESDE MODAL)
            // ==========================================
            elseif (isset($_POST["actualizar"])) {
                $id = intval($_POST["id"] ?? 0);
                $profesional = Profesionales::find($id);

                if ($profesional) {
                    $profesional->nombre = trim($_POST["nombre"] ?? $profesional->nombre);
                    $profesional->apellido = trim($_POST["apellido"] ?? $profesional->apellido);
                    $profesional->telefono = trim($_POST["telefono"] ?? $profesional->telefono);
                    $profesional->email = trim($_POST["email"] ?? $profesional->email);
                    $profesional->profesion = trim($_POST["profesion"] ?? $profesional->profesion);
                    $profesional->especializacion = trim($_POST["especializacion"] ?? $profesional->especializacion);
                    $profesional->sexo = trim($_POST["sexo"] ?? $profesional->sexo);

                    $errores = $profesional->validarProfesional();

                    if (empty($errores)) {
                        $profesional->actualizar();

                        // Sincronizar usuario correspondiente si existe
                        if (!empty($profesional->id_usuario)) {
                            $usuarioVinculado = Usuario::find($profesional->id_usuario);
                            if ($usuarioVinculado) {
                                $usuarioVinculado->nombre = $profesional->nombre;
                                $usuarioVinculado->email = $profesional->email;
                                $usuarioVinculado->telefono = $profesional->telefono;
                                $usuarioVinculado->sexo = $profesional->sexo;
                                $usuarioVinculado->rol = $profesional->profesion;
                                if (!empty($_POST["fecha_nacimiento"])) {
                                    $usuarioVinculado->fecha_nacimiento = $_POST["fecha_nacimiento"];
                                }
                                $usuarioVinculado->actualizar();
                            }
                        }

                        header("location: /public/admin/profesionales/administrar?resultado=2");
                        exit;
                    }
                }
            }

            // ==========================================
            // ACCIÓN: ELIMINAR PROFESIONAL
            // ==========================================
            elseif (isset($_POST["borrar"])) {
                $id = intval($_POST["id"] ?? 0);
                $profesional = Profesionales::find($id);

                if ($profesional) {
                    $idProf = (int) $profesional->id;
                    $idUsuario = (int) ($profesional->id_usuario ?? 0);

                    // 1. Eliminar horarios asociados
                    Horarios::eliminar_horarios("DELETE FROM horarios WHERE user_id = {$idProf};");

                    // 2. Limpiar citas y citaservicios para evitar llaves rotas o registros huérfanos
                    Horarios::eliminar_horarios("DELETE FROM citaservicios WHERE id_cita IN (SELECT id FROM citas WHERE id_profesional = {$idProf});");
                    Horarios::eliminar_horarios("DELETE FROM citas WHERE id_profesional = {$idProf};");

                    // 3. Eliminar registro del profesional
                    $profesional->eliminar();

                    // 4. Si tiene usuario asignado, eliminar cuenta de acceso
                    if ($idUsuario > 0) {
                        $usuarioVinculado = Usuario::find($idUsuario);
                        if ($usuarioVinculado) {
                            $usuarioVinculado->eliminar();
                            if (!empty($usuarioVinculado->imagen) && file_exists(CARPETA_IMAGENES_USUARIOS . $usuarioVinculado->imagen)) {
                                @unlink(CARPETA_IMAGENES_USUARIOS . $usuarioVinculado->imagen);
                            }
                        }
                    }

                    header("location: /public/admin/profesionales/administrar?resultado=3");
                    exit;
                }
            }
        }

        // Obtener lista completa de profesionales con datos de usuario (imagen, estado)
        $query = "SELECT p.*, u.imagen as imagen, u.actualizado as usuario_actualizado, u.confirmado as usuario_confirmado, u.fecha_nacimiento as fecha_nacimiento 
                  FROM profesionales p 
                  LEFT JOIN usuarios u ON p.id_usuario = u.id 
                  ORDER BY p.id DESC";
        $profesionales = Profesionales::SQL($query);

        $router->render("/admin/profesionales/administrar", [
            "profesionales" => $profesionales,
            "errores" => $errores,
            "usuariosC" => $usuariosC,
            "profesionalC" => $profesionalC,
            "resultado" => $resultado
        ]);
    }
    public static function perfilProfesionales(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        esfuncionario();
        //obtener datos de la sesion
        $id = $_SESSION["id"] ?? 0;
        $resultado = $_GET['resultado'] ?? null;

        $usuario = Usuario::find($id);
        if (!$usuario) {
            header("location: /public/login");
            exit;
        }

        //buscar el profesional
        $query = "SELECT * FROM profesionales WHERE id_usuario = " . $usuario->id . ";";
        $profesionalesList = Profesionales::SQL($query);
        if (empty($profesionalesList)) {
            $nuevoProf = new Profesionales([
                "id_usuario" => $usuario->id,
                "nombre" => $usuario->nombre,
                "apellido" => "",
                "email" => $usuario->email,
                "profesion" => $usuario->rol,
                "especializacion" => "General",
                "telefono" => "",
                "descripcion" => "Especialista asistencial"
            ]);
            $resCrear = $nuevoProf->crear();
            $nuevoProf->id = $resCrear['id'] ?? 0;
            $profesional = $nuevoProf;
        } else {
            $profesional = $profesionalesList[0];
        }
        $idProfesional = (int) $profesional->id;

        //horarios
        $query = "SELECT * FROM horarios WHERE user_id = {$idProfesional};";
        $horarios = Horarios::SQL($query);

        // Verificamos qué días están activos
        $diasCheck = array_map(function ($horario) {
            return $horario->day;
        }, $horarios);

        $horarios_por_dia = [];
        foreach ($horarios as $horario) {
            $horarios_por_dia[$horario->day] = $horario;
        }

        //crear una nueva instancia de profesional para poder guardarlos en memoria temporal
        $profesionalC = new Profesionales($_POST);

        //Almacenar los errores
        $errores = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['guardarHorario'])) {
                $days = $_POST['days'] ?? [];

                // Eliminar horarios anteriores para reemplazarlos limpiamente
                $query = "DELETE FROM horarios WHERE user_id = {$idProfesional};";
                Horarios::eliminar_horarios($query);

                $diasValidos = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                $guardados = 0;

                if (!empty($days)) {
                    foreach ($days as $day) {
                        if (!in_array($day, $diasValidos)) continue;

                        $startTime = trim($_POST["start-time-{$day}"] ?? '08:00');
                        $endTime = trim($_POST["end-time-{$day}"] ?? '17:00');

                        // Normalizar formato
                        if (strlen($startTime) === 5) $startTime .= ':00';
                        if (strlen($endTime) === 5) $endTime .= ':00';

                        // Solo guardar si hora fin es estrictamente posterior a hora inicio
                        if (strtotime($endTime) > strtotime($startTime)) {
                            $horarioNuevo = new Horarios([
                                "day" => $day,
                                "start_time" => $startTime,
                                "end_time" => $endTime,
                                "user_id" => $idProfesional
                            ]);
                            $horarioNuevo->crear();
                            $guardados++;
                        }
                    }

                    header("location: /public/perfil/profesionales?resultado=1#horario");
                    exit;
                } else {
                    // Se desmarcaron todos los días -> Queda sin horarios
                    header("location: /public/perfil/profesionales?resultado=2#horario");
                    exit;
                }
            } else {
                // Actualización o registro del perfil del profesional
                $profesional->sincronizar($_POST);
                if (isset($_POST['telefono'])) {
                    $profesional->telefono = trim($_POST['telefono']);
                }
                if (isset($_POST['especializacion'])) {
                    $profesional->especializacion = trim($_POST['especializacion']);
                }
                if (isset($_POST['descripcion'])) {
                    $profesional->descripcion = trim($_POST['descripcion']);
                }
                if (!empty($_POST['nombre'])) {
                    $usuario->nombre = trim($_POST['nombre']);
                    $profesional->nombre = $usuario->nombre;
                }

                $errores = $profesional->validarActualizacionPerfil();

                if (empty($errores)) {
                    // Subida de imagen opcional
                    if (!empty($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
                        if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                            mkdir(CARPETA_IMAGENES_USUARIOS, 0777, true);
                        }

                        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                        $imagenPrevia = $_POST["imagenPrevia"] ?? $usuario->imagen;

                        $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(400, 400);
                        if ($image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen)) {
                            if (!empty($imagenPrevia) && file_exists(CARPETA_IMAGENES_USUARIOS . $imagenPrevia)) {
                                unlink(CARPETA_IMAGENES_USUARIOS . $imagenPrevia);
                            }
                            $usuario->setImagen($nombreImagen);
                            $_SESSION["imagen"] = $usuario->imagen;
                        }
                    }

                    // Cálculo seguro de edad
                    $edad = 0;
                    $fechaNac = $usuario->fecha_nacimiento ?: ($_SESSION["fecha_nacimiento"] ?? null);
                    if (!empty($fechaNac) && $fechaNac !== '0' && $fechaNac !== '0000-00-00') {
                        try {
                            $nac = new DateTime($fechaNac);
                            $hoy = new DateTime();
                            $edad = $nac->diff($hoy)->y;
                        } catch (\Throwable $e) {
                            $edad = 0;
                        }
                    }
                    $profesional->edad = $edad;
                    $profesional->email = $usuario->email ?? '';

                    $usuario->telefono = $profesional->telefono;
                    $usuario->actualizado = "1";
                    $usuario->actualizar();

                    $_SESSION["actualizado"] = 1;
                    $_SESSION["nombre"] = $usuario->nombre;

                    $profesional->actualizar();

                    header("location: /public/perfil/profesionales?resultado=perfil_ok");
                    exit;
                }
            }
        }

        $router->render("/admin/profesionales/perfil", [
            "resultado" => $resultado,
            "horarios_por_dia" => $horarios_por_dia,
            "diasCheck" => $diasCheck,
            "usuario" => $usuario,
            "profesional" => $profesional,
            "profesionalC" => $profesionalC,
            "errores" => $errores
        ]);
    }
}