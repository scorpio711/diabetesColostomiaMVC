<?php

namespace Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Model\Paciente;
use Model\Cita;
use MVC\Router;
use Model\Usuario;
use Classes\Email;
use Model\CitaServicios;

class UsuariosController
{
    public static function administrarUsuarios(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        //administrar los datos del usuario
        $usuarios = Usuario::all();
        $usuario = new Usuario();
        $usuariosC = new Usuario();
        $resultado = $_GET["resultado"] ?? null;

        //arreglo con mensajes de errores
        $errores = Usuario::getErrores();
        $erroresActualizacion = Usuario::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['crear'])) {
                //Crea una nueva instancia
                $usuariosC = new Usuario($_POST);
                /**SUBIDA DE ARCHIVOS**/

                //  //Crear la carpeta para subir imagenes
                //  if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                //     mkdir(CARPETA_IMAGENES_USUARIOS);
                // }

                // //generar un nombre unico
                // $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                // //Setear la imagen
                // //Realiza un resize a la imagen con intervention
                // if ($_FILES["imagen"]["tmp_name"]) {
                //     $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                //     $usuariosC->setImagen($nombreImagen);
                // }

                //Validar
                $errores = $usuariosC->validarNuevaCuenta();

                //validar rol
                if (!$usuariosC->enfermedad) {
                    $errores[] = "Debes seleccionar un condicion";
                }

                $existeUsuario = $usuariosC->existeUsuario();

                if ($existeUsuario->num_rows) {
                    $errores = Usuario::getErrores();
                }

                //revisar que errores este vacio
                if (empty($errores)) {
                    //hashear el password
                    $usuariosC->hashPassword();

                    //Generar un token unico
                    $usuariosC->crearToken();

                    //Enviar el email
                    $email = new Email($usuariosC->email, $usuariosC->nombre, $usuariosC->token);

                    $email->enviarConfirmacion($usuariosC->email);

                    //Crear el usuario
                    $resultado = $usuariosC->crear();
                    //Guarda la imagen en el servidor
                    // $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);

                    if ($resultado) {
                        //redireccionar al usuario
                        header("location:/public/admin/usuarios/administrar?resultado=1");
                    }

                }
            } elseif (isset($_POST['actualizar'])) {

                $usuario = new Usuario($_POST["usuario"]);
                $infoPreviaUsuario = Usuario::find($usuario->id);

                //asignar los atributos
                $args = $_POST["usuario"];

                //Subida de archivos
                if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                    mkdir(CARPETA_IMAGENES_USUARIOS);
                }

                //generar nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $imagenPrevia = $_POST["imagenPrevia"];

                if (isset($_FILES["usuario"]["tmp_name"]["imagen"]) && $_FILES["usuario"]["error"]["imagen"] === UPLOAD_ERR_OK) {
                    // Verificar que el archivo se envió correctamente y no hubo errores
                    $image = Image::make($_FILES["usuario"]["tmp_name"]["imagen"])->fit(800, 600);

                    // Guardar la imagen con el nuevo nombre
                    if ($image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen)) {
                        $usuario->setImagen($nombreImagen);
                        unlink(CARPETA_IMAGENES_USUARIOS . $imagenPrevia);
                        $bool = true;
                    } else {
                        // Manejar el error al guardar la imagen
                        $bool = false;
                    }
                } else {
                    $usuario->setImagen($imagenPrevia);
                    $bool = false;
                }

                //Verificar si el password esta vacio
                if (empty($_POST["usuario"]["password"])) {
                    $usuario->password = $infoPreviaUsuario->password;
                } else {
                    //hashear nuevo password
                    $usuario->password = $_POST["usuario"]["password"];
                    $usuario->hashPassword();
                }

                $usuario->sincronizar($args);

                //Validacion
                $erroresActualizacion = $usuario->validarNuevaCuenta();

                //revisar que erroresAc$erroresActualizacion este vacio
                if (empty($erroresActualizacion)) {

                    //Datos previos del usuario
                    $confirmado = $infoPreviaUsuario->confirmado;
                    $actualizado = $infoPreviaUsuario->actualizado;
                    $rol = $infoPreviaUsuario->rol;

                    $usuario->confirmado = $confirmado;
                    $usuario->actualizado = $actualizado;
                    $usuario->rol = $rol;

                    if ($bool) {
                        $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);
                    }

                    $resultado = $usuario->actualizar();
                    if ($resultado) {
                        //redireccionar al usuario
                        header("location:/public/admin/usuarios/administrar?resultado=2");
                        exit;
                    }
                }
            } elseif (isset($_POST['borrar'])) {
                $id = intval($_POST["id"] ?? 0);

                $usuario = Usuario::find($id);
                if ($usuario) {
                    $resultado = $usuario->eliminar();

                    if (!empty($usuario->imagen) && file_exists(CARPETA_IMAGENES_USUARIOS . $usuario->imagen)) {
                        unlink(CARPETA_IMAGENES_USUARIOS . $usuario->imagen);
                    }

                    if ($resultado) {
                        header("location:/public/admin/usuarios/administrar?resultado=3");
                        exit;
                    }
                }
            }
        }

        // Calcular métricas
        $totalUsuarios = count($usuarios);
        $totalPacientes = 0;
        $totalProfesionales = 0;
        $totalConfirmados = 0;

        foreach ($usuarios as $u) {
            $r = strtolower(trim($u->rol ?? ''));
            if ($r === 'paciente') {
                $totalPacientes++;
            } elseif ($r === 'abogado' || $r === 'enfermero' || $r === 'psicologo') {
                $totalProfesionales++;
            }
            if (intval($u->confirmado ?? 0) === 1) {
                $totalConfirmados++;
            }
        }

        $stats = [
            'total' => $totalUsuarios,
            'pacientes' => $totalPacientes,
            'profesionales' => $totalProfesionales,
            'confirmados' => $totalConfirmados
        ];

        $router->render("/admin/usuarios/administrar", [
            "usuarios" => $usuarios,
            "usuariosC" => $usuariosC,
            "usuario" => $usuario,
            "resultado" => $resultado,
            "errores" => $errores,
            "erroresActualizacion" => $erroresActualizacion,
            "stats" => $stats
        ]);
    }

    public static function perfil(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        estaAutenticado();

        // Obtener datos del usuario autenticado
        $id = intval($_SESSION["id"] ?? 0);
        $usuario = Usuario::find($id);

        if (!$usuario) {
            header("Location: /public/login");
            exit;
        }

        $usuarioId = $usuario->id;
        $nombre = $usuario->nombre;
        $sexo = $usuario->sexo;

        $query = "SELECT * FROM pacientes WHERE pacienteId = " . intval($usuarioId) . " LIMIT 1;";
        $datosPacienteActualizado = Paciente::SQL($query);
        $pacienteActualizado = $datosPacienteActualizado[0] ?? new Paciente();

        $paciente = new Paciente($_POST);
        $errores = [];
        $resultado = $_GET["resultado"] ?? null;

        if (($_SERVER["REQUEST_METHOD"] ?? '') === "POST") {

            // Sincronizar objetos con los datos enviados
            $paciente->sincronizar($_POST);
            if (!empty($pacienteActualizado->id)) {
                $pacienteActualizado->sincronizar($_POST);
            }

            // Validar teléfono obligatorio
            if (empty($_POST["telefono"])) {
                $errores[] = "Debes ingresar tu número de teléfono celular de contacto.";
            }

            // Validar campos sociodemográficos del paciente
            $targetParaValidar = (!empty($pacienteActualizado->id)) ? $pacienteActualizado : $paciente;
            $erroresValidacion = $targetParaValidar->validarActualizacionPerfil();
            $errores = array_merge($errores, $erroresValidacion);

            if (empty($errores)) {
                // Subida opcional de imagen de perfil
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
                        if (!empty($pacienteActualizado->id)) {
                            $pacienteActualizado->imagen = $nombreImagen;
                        }
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

                // Actualizar teléfono y estado del usuario
                if (isset($_POST["telefono"])) {
                    $usuario->telefono = trim($_POST["telefono"]);
                }
                $usuario->actualizado = "1";
                $usuario->actualizar();

                $_SESSION["actualizado"] = 1;

                // Actualizar o crear registro en pacientes
                if (!empty($pacienteActualizado->id)) {
                    $pacienteActualizado->edad = $edad;
                    $pacienteActualizado->nombre = $nombre;
                    $pacienteActualizado->sexo = $sexo;
                    $pacienteActualizado->email = $usuario->email ?? '';
                    $pacienteActualizado->telefono = $usuario->telefono ?? '';
                    if (!empty($usuario->imagen)) {
                        $pacienteActualizado->imagen = $usuario->imagen;
                    }
                    $pacienteActualizado->actualizar();
                } else {
                    $paciente->pacienteId = $usuarioId;
                    $paciente->nombre = $nombre;
                    $paciente->sexo = $sexo;
                    $paciente->edad = $edad;
                    $paciente->email = $usuario->email ?? '';
                    $paciente->telefono = $usuario->telefono ?? '';
                    $paciente->imagen = $usuario->imagen ?? '';
                    $paciente->crear();
                }

                header("Location: /public/perfil?resultado=1");
                exit;
            }
        }

        $router->render("auth/perfil", [
            "usuario" => $usuario,
            "paciente" => $paciente,
            "pacienteActualizado" => $pacienteActualizado,
            "errores" => $errores,
            "resultado" => $resultado
        ]);
    }
}
