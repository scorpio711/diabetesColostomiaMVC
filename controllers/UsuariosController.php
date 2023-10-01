<?php

namespace Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use MVC\Router;
use Model\Usuario;

class UsuariosController
{
    public static function administrarUsuarios(Router $router)
    {
        $usuarios = Usuario::All();
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

                //generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                //Setear la imagen
                //Realiza un resize a la imagen con intervention
                if ($_FILES["imagen"]["tmp_name"]) {
                    $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                    $usuariosC->setImagen($nombreImagen);
                }

                //Validar
                $errores = $usuariosC->validar();

                //revisar que errores este vacio
                if (empty($errores)) {

                    //Crear la carpeta para subir imagenes
                    if (!is_dir(CARPETA_IMAGENES_USUARIOS)) {
                        mkdir(CARPETA_IMAGENES_USUARIOS);
                    }

                    //Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES_USUARIOS . $nombreImagen);

                    //guarda en la base de datos
                    $resultado = $usuariosC->crear();
                    if ($resultado) {
                        //redireccionar al usuario
                        header("location:/public/admin/usuarios/administrar?resultado=1");
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

                    $resultado = $usuario->actualizar();
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
}