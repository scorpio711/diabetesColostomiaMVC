<?php

namespace Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use MVC\Router;
use Model\Investigacion;

class InvestigacionController
{

    public static function administrarInvestigaciones(Router $router)
    {
        session_start();
       
        isAdmin();

        $investigaciones = Investigacion::all();
        $investigacion = new Investigacion();
        $resultado = $_GET["resultado"];

        //arreglo con mensajes de errores
        $errores = Investigacion::getErrores();
        $erroresActualizacion = Investigacion::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['crear'])) {

                //Crea una nueva instancia
                $investigacionC = new Investigacion($_POST);
                /**SUBIDA DE ARCHIVOS**/

                //generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                //Setear la imagen
                //Realiza un resize a la imagen con intervention
                if ($_FILES["imagen"]["tmp_name"]) {
                    $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                    $investigacionC->setImagen($nombreImagen);
                }

                //Validar
                $errores = $investigacionC->validar();

                //revisar que errores este vacio
                if (empty($errores)) {

                    //Crear la carpeta para subir imagenes
                    if (!is_dir(CARPETA_IMAGENES_INVESTIGACIONES)) {
                        mkdir(CARPETA_IMAGENES_INVESTIGACIONES);
                    }

                    //Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES_INVESTIGACIONES . $nombreImagen);

                    //guarda en la base de datos
                    $resultado = $investigacionC->crear();

                    if ($resultado) {
                        header("location:/public/admin/investigaciones/administrar?resultado=1");
                    }

                }
            } elseif (isset($_POST['actualizar'])) {

                $investigacion = new Investigacion($_POST["investigacion"]);

                //asignar los atributos
                $args = $_POST["investigacion"];

                //Subida de archivos

                //generar nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $imagenPrevia = $_POST["imagenPrevia"];

                if (isset($_FILES["investigacion"]["tmp_name"]["imagen"]) && $_FILES["investigacion"]["error"]["imagen"] === UPLOAD_ERR_OK) {
                    // Verificar que el archivo se envió correctamente y no hubo errores
                    $image = Image::make($_FILES["investigacion"]["tmp_name"]["imagen"])->fit(800, 600);

                    // Guardar la imagen con el nuevo nombre
                    if ($image->save(CARPETA_IMAGENES_INVESTIGACIONES . $nombreImagen)) {
                        $investigacion->setImagen($nombreImagen);
                        unlink(CARPETA_IMAGENES_INVESTIGACIONES . $imagenPrevia);
                        $bool = true;
                    } else {
                        // Manejar el error al guardar la imagen
                        $bool = false;
                    }
                } else {
                    $investigacion->setImagen($imagenPrevia);
                    $bool = false;
                }


                $investigacion->sincronizar($args);

                //Validacion
                $erroresActualizacion = $investigacion->validar();

                //revisar que erroresActualizacion este vacio
                if (empty($erroresActualizacion)) {
                    if (!is_dir(CARPETA_IMAGENES_INVESTIGACIONES)) {
                        mkdir(CARPETA_IMAGENES_INVESTIGACIONES);
                    }
                    //Almacenar la imagen
                    if ($bool) {
                        $image->save(CARPETA_IMAGENES_INVESTIGACIONES . $nombreImagen);
                    }

                    $resultado = $investigacion->actualizar();
                    if ($resultado) {
                        header("location:/public/admin/investigaciones/administrar?resultado=2");
                    }

                }
            } elseif (isset($_POST['borrar'])) {

                $id = $_POST["id"];
                $investigacion = Investigacion::find($id);
                $resultado = $investigacion->eleminar();

                unlink(CARPETA_IMAGENES_INVESTIGACIONES . $investigacion->imagen);

                if ($resultado) {
                    header("location:/public/admin/investigaciones/administrar?resultado=3");
                }
            }
        }
        $router->render("/admin/investigaciones/administrar", [
            "investigaciones" => $investigaciones,
            "investigacion" => $investigacion,
            "resultado" => $resultado,
            "errores" => $errores,
            "erroresActualizacion" => $erroresActualizacion
        ]);
    }
}