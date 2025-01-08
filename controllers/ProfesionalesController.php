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
        session_start();

        isAdmin();

        //Administar los datos de profesionales
        $profesionales = Profesionales::all();
        $resultado = $_GET["resultado"];

        //arreglo con mendajes de errores
        $errores = Profesionales::getErrores();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["crear"])) {
                $profesionalC = new Profesionales($_POST);
                $usuariosC = new Usuario();

                //relacionar los datos con los usuarios
                $usuariosC->nombre = $profesionalC->nombre;
                $usuariosC->email = $profesionalC->email;
                $usuariosC->fecha_nacimiento = $_POST["fecha_nacimiento"];
                $usuariosC->sexo = $profesionalC->sexo;
                $usuariosC->rol = $profesionalC->profesion;

                //validar
                $errores = $profesionalC->validarProfesional();
                $errores = $usuariosC->validarProfesional();

                //Validar si existe el profesional
                $existeUsuario = $usuariosC->existeUsuario();

                if ($existeUsuario->num_rows) {
                    $errores = Usuario::getErrores();
                }

                if (empty($errores)) {

                    // Fecha de nacimiento en formato 'YYYY-MM-DD'
                    $fechaNacimiento = $_POST["fecha_nacimiento"];

                    // Calcular la fecha actual
                    $fechaActual = date('Y-m-d');

                    // Calcular la edad
                    $diff = date_diff(date_create($fechaNacimiento), date_create($fechaActual));
                    $edad = $diff->format('%y');

                    $profesionalC->edad = $edad;

                    //Administrar el password
                    $usuariosC->password = $_POST["contraseña"];
                    $usuariosC->hashPassword();

                    //Enviar confirmacion
                    $usuariosC->crearToken();

                    $email = new Email($usuariosC->email, $usuariosC->nombre, $usuariosC->token);
                    //asignar el id del profesional

                    $usuariosC->crear();

                    //Vincular el id
                    $usuarioCreado = Usuario::findEmail($usuariosC->email);

                    $profesionalC->id_usuario = $usuarioCreado->id;

                    $resultado = $profesionalC->crear();

                    if ($resultado) {
                        //redireccionar al usuario
                        header("location:/public/admin/profesionales/administrar?resultado=1");
                    }
                }
            }
        }

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
        session_start();
        esfuncionario();
        //obtener datos de la sesion
        $id = $_SESSION["id"];
        $resultado = $_GET['resultado'];

        $usuario = Usuario::find($id);

        //buscar el profesional
        $query = "SELECT * FROM profesionales WHERE id_usuario = " . $usuario->id . ";";
        $profesional = Profesionales::SQL($query)[0];
        $idProfesional = $profesional->id;

        //horarios
        $query = "SELECT * FROM horarios WHERE user_id = $idProfesional;";
        $horarios = Horarios::SQL($query);

        // Verificamos si hay un horario para el lunes
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

            if (isset($_POST['actualizar'])) {

                //sincronizar los datos
                $profesional->sincronizar($_POST);
                $profesional->telefono = $profesionalC->telefono;
                $profesional->especializacion = $profesionalC->especializacion;
                $profesional->descripcion = $profesionalC->descripcion;

                //cambio de nombre
                /**SUBIDA DE ARCHIVOS**/

                //verificar si la carpeta esta creada
                if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                    mkdir(CARPETA_IMAGENES_USUARIOS);
                }

                //generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                //Setear la imagen
                //Realiza un resize a la imagen con intervention
                if ($_FILES["imagen"]["tmp_name"]) {

                    $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(400, 400);
                    $usuario->setImagen($nombreImagen);

                }

                //validar el formulario y agregar los errores a un arrgelo
                $errores = $profesional->validarActualizacionPerfil();
                $errores = $usuario->validarImagen();

                if (empty($errores)) {

                    //agregar actualizado al usuario
                    $usuario->actualizado = "1";

                    //Actualizar el nombre
                    $usuario->nombre = $_POST["nombre"];

                    //Guarda la imagen en el servidor

                    $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);

                    //actualizar el usuario y su perfil
                    $usuario->actualizar();

                    $_SESSION["imagen"] = $usuario->imagen;
                    $_SESSION["nombre"] = $usuario->nombre;
                    $_SESSION["actualizado"] = 1;

                    $resultado = $profesional->actualizar();
                    if ($resultado) {
                        header("location:/public/");
                    }
                }
            } elseif (isset($_POST['actulizarImagen'])) {

                $usuario = Usuario::find($id);

                //generar nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $imagenPrevia = $_POST["imagenPrevia"];

                //verificar si la carpeta esta creada
                if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                    mkdir(CARPETA_IMAGENES_USUARIOS);
                }

                if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {

                    // Verificar que el archivo se envió correctamente y no hubo errores
                    $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(400, 400);

                    // Guardar la imagen con el nuevo nombre
                    if ($image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen)) {
                        if (file_exists(CARPETA_IMAGENES_USUARIOS . $imagenPrevia)) {
                            unlink(CARPETA_IMAGENES_USUARIOS . $imagenPrevia);
                        }
                        $usuario->setImagen($nombreImagen);
                        $bool = true;
                    } else {
                        // Manejar el error al guardar la imagen
                        $bool = false;
                    }
                } else {
                    $usuario->setImagen($imagenPrevia);
                    $bool = false;
                }


                $errores = $usuario->validarImagen();

                if (empty($errores)) {

                    //Almacenar la imagen
                    if ($bool) {
                        $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);
                    }
                    $_SESSION["imagen"] = $usuario->imagen;
                    $resultado = $usuario->actualizar();

                    if ($resultado) {
                        header("location:/public/");
                    }
                }
            } elseif (isset($_POST['guardarHorario'])) {
                $days = $_POST['days'];

                // Verificamos si la variable $horarios está vacía
                if (empty($horarios)) {
                    foreach ($days as $day) {
                        $horario = new Horarios;

                        $horario->day = $day;
                        $horario->start_time = $_POST["start-time-{$day}"];
                        $horario->end_time = $_POST["end-time-{$day}"];
                        $horario->user_id = $idProfesional;

                        $resultado = $horario->crear();

                    }
                    if ($resultado) {
                        header("location:/public/perfil/profesionales?resultado=1");
                    }
                } elseif (!empty($horarios)) {
                    // Eliminar horarios existentes del usuario
                    $horario = new Horarios;
                    $query = "DELETE FROM horarios WHERE user_id = $idProfesional;";
                    $horario->eliminar_horarios($query);

                    // Crear nuevos horarios en función de los datos enviados en el POST
                    foreach ($days as $day) {
                        $horarioNuevo = new Horarios;

                        $horarioNuevo->day = $day;
                        $horarioNuevo->start_time = $_POST["start-time-{$day}"];
                        $horarioNuevo->end_time = $_POST["end-time-{$day}"];
                        $horarioNuevo->user_id = $idProfesional;

                        $resultado = $horarioNuevo->crear();
                    }
                    if ($resultado) {
                        header("location:/public/perfil/profesionales?resultado=2");
                    }
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