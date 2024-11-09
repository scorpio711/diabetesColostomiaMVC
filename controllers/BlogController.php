<?php

namespace Controllers;

use Google\Service\Blogger\Blog;
use Intervention\Image\ImageManagerStatic as Image;
use Model\BlogPost;
use Model\Profesionales;
use Model\Usuario;
use Model\Investigacion;
use MVC\Router;

class BlogController
{
    public static function editor(Router $router)
    {

        $router->render("/admin/blogs/editor", [
        ]);
    }
    public static function admin(Router $router)
    {
        session_start();
        esFuncionario();

       
        $sesion = $_SESSION;

        //query para buscar los blogs con el id del usuariof
        $query = "SELECT * FROM blog_posts WHERE id_usuario = ${_SESSION['id']};";
        $blogs = BlogPost::SQL($query);
        $rol = $_SESSION["rol"];
        $errores = [];
        $resultado = $_GET["resultado"];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['crear'])) {
                $blog = new BlogPost($_POST);
                $blog->nombre = $_SESSION["nombre"];
                $blog->id_usuario = intval($_SESSION["id"]);
                $blog->correo = $_SESSION["email"];
                $blog->contenido_html = "Comienza a editar tu blog";
                $errores = $blog->validarBlog();
                if (empty($errores)) {
                    $resultado = $blog->crear();
                    if ($resultado) {
                        //redireccionar al usuario
                        header("location:/public/admin/blog?resultado=1");
                    }
                }
            } else {
                $id = $_POST["id"];

                $blog = BlogPost::find($id);


                if ($blog->publico == 1) {

                    $query = "SELECT * FROM investigaciones WHERE idBlog = ${id};";
                    $investigacion = Investigacion::SQL($query);

                    $investigacion[0]->eleminar();

                    unlink(CARPETA_IMAGENES_INVESTIGACIONES . $investigacion->imagen);
                }

                $resultado = $blog->eleminar();

                if ($resultado) {
                    header("location:/public/admin/blog?resultado=3");
                }
            }
        }

        $router->render("/admin/blogs/blogAdmin", [
            "rol" => $rol,
            "blogs" => $blogs,
            "sesion" => $sesion,
            "errores" => $errores,
            "resultado" => $resultado
        ]);
    }

    public static function lector(Router $router)
    {
        session_start();

        //obtener la id del blog
        $blogId = $_GET["id"];
        $resultado = $_GET["resultado"];
        $blog = BlogPost::find($blogId);
        $id_usuario = $blog->id_usuario;
        //buscar información del profesional que creo el blog
        $query = "SELECT * FROM profesionales WHERE id_usuario = ${id_usuario};";
        $profesional = Profesionales::sql($query);
        $usuario = Usuario::find($id_usuario);

        //formatear fecha
        $date = $blog->fecha_creacion; // Fecha original

        // Convertir la fecha a timestamp y luego formatearla
        $formattedDate = date("M. j, Y", strtotime($date));

        // Validar que el usuario de la sesión es el mismo que el propietario del blog
        if ($_SESSION['id'] == $id_usuario) {
            // El usuario es el propietario del blog, mostrar el contenido
            $contenido_html = $blog->contenido_html;
        } else {
            // El usuario no es el propietario, mostrar un mensaje de error
            $contenido_html = $blog->contenido_html;
        }

        //publicar el blog
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

                    //Asignar una url
                    $investigacionC->url = "/public/blog?id={$blogId}";
                    $investigacionC->idBlog = $blogId;

                    //poner publico el blog
                    $blog->publico = 1;

                    $blog->actualizar();
                    //guarda en la base de datos
                    $resultado = $investigacionC->crear();

                    if ($resultado) {
                        header("location:/public/blog?id=${blogId}&resultado=1");
                    }

                }
            } elseif (isset($_POST['ocultar'])) {

                $query = "SELECT * FROM investigaciones WHERE idBlog = ${blogId};";
                $investigacion = Investigacion::SQL($query);
                //poner publico el blog
                $blog->publico = 0;

                $blog->actualizar();

                $resultado = $investigacion[0]->eleminar();

                unlink(CARPETA_IMAGENES_INVESTIGACIONES . $investigacion->imagen);

                if ($resultado) {
                    header("location:/public/blog?id=${blogId}&resultado=3");
                }
            }
        }

        $router->render("/admin/blogs/lectorBlog", [
            "investigacionC" => $investigacionC,
            "resultado" => $resultado,
            "errores" => $errores,
            "blog" => $blog,
            "id_usuario" => $id_usuario,
            "contenido_html" => $contenido_html,
            "profesional" => $profesional[0],
            "usuario" => $usuario,
            "fecha" => $formattedDate
        ]);
    }

    public static function guardar()
    {
        $blog = BlogPost::find($_POST["id"]);
        $blog->contenido_html = $_POST["contenido_html"];
        $resultado = $blog->actualizar();

        echo json_encode($resultado);
    }
}