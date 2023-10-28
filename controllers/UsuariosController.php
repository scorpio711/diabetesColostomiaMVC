<?php

namespace Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Model\Paciente;
use MVC\Router;
use Model\Usuario;
use Classes\Email;

class UsuariosController
{
    public static function administrarUsuarios(Router $router)
    {
        session_start();

        isAdmin();

        //administrar los datos del usuario
        $usuarios = Usuario::all();
        $usuario = new Usuario();
        $resultado = $_GET["resultado"];

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


                //revisar que errores este vacio
                if (empty($errores)) {

                    $resultado = $usuariosC->existeUsuario();

                    if ($resultado->num_rows) {
                        $errores = Usuario::getErrores();
                    } else {
                        //hashear el password
                        $usuariosC->hashPassword();

                        //Generar un token unico
                        $usuariosC->crearToken();

                        
                        //Enviar el email
                        $email = new Email($usuariosC->email, $usuariosC->nombre, $usuariosC->token);

                        $email->enviarConfirmacion();

                        
                        //Crear el usuario
                        $resultado = $usuariosC->crear(false);
                        //Guarda la imagen en el servidor
                        // $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);

                        if ($resultado) {
                            //redireccionar al usuario
                            header("location:/public/admin/usuarios/administrar?resultado=1");
                        }
                    }

                }
            } elseif (isset($_POST['actualizar'])) {

                $usuario = new Usuario($_POST["usuario"]);
                //asignar los atributos
                $args = $_POST["usuario"];

                //Subida de archivos
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

                $usuario->sincronizar($args);

                //Validacion
                $erroresActualizacion = $usuario->validar();

                //revisar que erroresAc$erroresActualizacion este vacio
                if (empty($erroresActualizacion)) {

                    if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                        mkdir(CARPETA_IMAGENES_USUARIOS);
                    }
                    //Almacenar la imagen
                    if ($bool) {
                        $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);
                    }

                    $resultado = $usuario->actualizar(false);
                    if ($resultado) {
                        //redireccionar al usuario
                        header("location:/public/admin/usuarios/administrar?resultado=2");
                    }
                }
            } elseif (isset($_POST['borrar'])) {
                $id = $_POST["id"];
                $usuario = Usuario::find($id);
                $resultado = $usuario->eleminar();

                unlink(CARPETA_IMAGENES_USUARIOS . $usuario->imagen);

                if ($resultado) {
                    header("location:/public/admin/usuarios/administrar?resultado=3");
                }
            }
        }
        $router->render("/admin/usuarios/administrar", [
            "usuarios" => $usuarios,
            "usuario" => $usuario,
            "resultado" => $resultado,
            "errores" => $errores,
            "erroresActualizacion" => $erroresActualizacion
        ]);
    }

    public static function perfil($router)
    {
        session_start();
        $id = $_SESSION["id"];
        $nombre = $_SESSION["nombre"];
        $sexo = $_SESSION["sexo"];


        $usuario = Usuario::find($id);
        $pacienteActualizado = Paciente::find($id);

        $paciente = new Paciente($_POST);


        // debuguear($usuario);
        $errores = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['actualizar'])) {

                $paciente->sincronizar($_POST);

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
                    $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                    $paciente->setImagen($nombreImagen);
                }

                $errores = $paciente->validarActualizacionPerfil();

                if (empty($errores)) {

                    //variables del servidor
                    $paciente->id = $id;
                    $paciente->nombre = $nombre;
                    $paciente->sexo = $sexo;

                    // Fecha de nacimiento en formato 'YYYY-MM-DD'
                    $fechaNacimiento = $_SESSION["fecha_nacimiento"];

                    // Calcular la fecha actual
                    $fechaActual = date('Y-m-d');

                    // Calcular la edad
                    $diff = date_diff(date_create($fechaNacimiento), date_create($fechaActual));
                    $edad = $diff->format('%y');

                    $paciente->edad = $edad;

                    //agregar actualizado al usuario
                    $usuario->actualizado = "1";

                    //Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);

                    //actualizar el usuario y su perfil de
                    $usuario->actualizar(false);

                    $_SESSION["imagen"] = $paciente->imagen;
                    $_SESSION["actualizado"] = 1;

                    $resultado = $paciente->crear(true);

                    if ($resultado) {
                        header("location:/public/");

                    }
                }
            } elseif (isset($_POST['actulizarImagen'])) {
                $paciente = Paciente::find($id);

                //generar nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $imagenPrevia = $_POST["imagenPrevia"];

                //verificar si la carpeta esta creada
                if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                    mkdir(CARPETA_IMAGENES_USUARIOS);
                }

                if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {

                    // Verificar que el archivo se envió correctamente y no hubo errores
                    $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);

                    // Guardar la imagen con el nuevo nombre
                    if ($image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen)) {
                        $paciente->setImagen($nombreImagen);
                        if (file_exists(CARPETA_IMAGENES_USUARIOS . $imagenPrevia)) {
                            unlink(CARPETA_IMAGENES_USUARIOS . $imagenPrevia);
                        }
                        $bool = true;
                    } else {
                        // Manejar el error al guardar la imagen
                        $bool = false;
                    }
                } else {
                    $paciente->setImagen($imagenPrevia);
                    $bool = false;
                }


                $errores = $paciente->validarActualizacionPerfil();

                if (empty($errores)) {

                    //Almacenar la imagen
                    if ($bool) {
                        $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);
                    }
                    $_SESSION["imagen"] = $paciente->imagen;
                    $resultado = $paciente->actualizar(true);

                    if ($resultado) {
                        header("location:/public/");

                    }
                }
            }
        }

        $router->render("/auth/perfil", [
            "usuario" => $usuario,
            "paciente" => $paciente,
            "pacienteActualizado" => $pacienteActualizado,
            "errores" => $errores
        ]);
    }

}