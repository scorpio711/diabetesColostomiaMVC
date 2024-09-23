<?php

namespace Controllers;

use Model\BlogPost;
use Model\Profesionales;
use Model\Usuario;
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

        $blogs = BlogPost::all();
        $sesion = $_SESSION;
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
            }
        }

        $router->render("/admin/blogs/blogAdmin", [
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
        $blog = BlogPost::find($blogId);
        $id_usuario = $blog->id_usuario;
        //buscar información del profesional que creo el blog
        $query = "SELECT * FROM profesionales WHERE id_usuario = ${id_usuario};" ;
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
        $router->render("/admin/blogs/lectorBlog", [
            "id_usuario" => $id_usuario,
            "contenido_html" => $contenido_html,
            "profesional" => $profesional[0],
            "usuario" => $usuario,
            "fecha" =>  $formattedDate
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