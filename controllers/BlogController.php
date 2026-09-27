<?php

namespace Controllers;

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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        esFuncionario();

        header("Location: /public/admin/blog");
        exit;
    }

    public static function admin(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        esFuncionario();

        $sesion = $_SESSION;
        $idUsuario = intval($_SESSION['id'] ?? 0);

        // Query para buscar los blogs del profesional logueado
        $query = "SELECT * FROM blog_posts WHERE id_usuario = {$idUsuario} ORDER BY id DESC;";
        $blogs = BlogPost::SQL($query);
        $rol = $_SESSION["rol"] ?? "profesional";
        $errores = [];
        $resultado = $_GET["resultado"] ?? null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['crear'])) {
                $blog = new BlogPost($_POST);
                $blog->nombre = $_SESSION["nombre"] ?? "Profesional";
                $blog->id_usuario = $idUsuario;
                $blog->correo = $_SESSION["email"] ?? "";
                $blog->cargo = $_SESSION["rol"] ?? "Profesional";
                $blog->contenido_html = "<p>Comienza a redactar tu artículo aquí...</p>";
                $errores = $blog->validarBlog();

                if (empty($errores)) {
                    $resultado = $blog->crear();
                    if ($resultado) {
                        header("Location: /public/admin/blog?resultado=1");
                        exit;
                    }
                }
            } else {
                $id = intval($_POST["id"] ?? 0);
                $blog = BlogPost::find($id);

                if ($blog) {
                    $esAdmin = !empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]);
                    // Validar que solo el creador o un admin pueda eliminarlo
                    if ($esAdmin || intval($blog->id_usuario) === $idUsuario) {
                        if (intval($blog->publico) === 1) {
                            $query = "SELECT * FROM investigaciones WHERE idBlog = {$id};";
                            $investigaciones = Investigacion::SQL($query);

                            if (!empty($investigaciones)) {
                                $inv = $investigaciones[0];
                                $inv->eliminar();

                                if (!empty($inv->imagen) && file_exists(CARPETA_IMAGENES_INVESTIGACIONES . $inv->imagen)) {
                                    unlink(CARPETA_IMAGENES_INVESTIGACIONES . $inv->imagen);
                                }
                            }
                        }

                        $resultado = $blog->eliminar();

                        if ($resultado) {
                            header("Location: /public/admin/blog?resultado=3");
                            exit;
                        }
                    }
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $blogId = intval($_GET["id"] ?? 0);
        $resultado = $_GET["resultado"] ?? null;

        if ($blogId <= 0) {
            header("Location: /public/investigaciones");
            exit;
        }

        $blog = BlogPost::find($blogId);
        if (!$blog) {
            header("Location: /public/investigaciones");
            exit;
        }

        $id_usuario = intval($blog->id_usuario);

        // Buscar información del profesional que creó el blog
        $query = "SELECT * FROM profesionales WHERE id_usuario = {$id_usuario};";
        $profesionales = Profesionales::sql($query);
        $profesional = !empty($profesionales) ? $profesionales[0] : null;
        $usuario = Usuario::find($id_usuario);

        // Formatear fecha
        $date = $blog->fecha_creacion ?: date("Y-m-d H:i:s");
        $formattedDate = date("M. j, Y", strtotime($date));

        // Permisos de autor o administrador
        $sessionId = $_SESSION['id'] ?? null;
        $esDuenio = ($sessionId && intval($sessionId) === $id_usuario);
        $esAdmin = !empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]);

        // Si el blog está en borrador (privado), solo el dueño o un admin pueden verlo
        if (intval($blog->publico) !== 1 && !$esDuenio && !$esAdmin) {
            header("Location: /public/investigaciones");
            exit;
        }

        $contenido_html = $blog->contenido_html;

        // Comprobar si ya existe una investigación publicada para este blog
        $queryInv = "SELECT * FROM investigaciones WHERE idBlog = {$blogId} LIMIT 1;";
        $invList = Investigacion::SQL($queryInv);
        $investigacionC = !empty($invList) ? $invList[0] : new Investigacion();
        $errores = [];

        // Publicar / Ocultar el blog
        if ($_SERVER["REQUEST_METHOD"] === "POST" && ($esDuenio || $esAdmin)) {

            if (isset($_POST['crear'])) {
                $datosInv = $_POST;
                $datosInv['idBlog'] = $blogId;
                $datosInv['url'] = "/public/blog?id={$blogId}";

                if (!empty($invList)) {
                    $investigacionC->sincronizar($datosInv);
                } else {
                    $investigacionC = new Investigacion($datosInv);
                }

                $nombreImagen = "";
                if (!empty($_FILES["imagen"]["tmp_name"])) {
                    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                    $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                    $investigacionC->setImagen($nombreImagen);
                } elseif (!empty($invList) && !empty($invList[0]->imagen)) {
                    $investigacionC->imagen = $invList[0]->imagen;
                }

                $errores = $investigacionC->validar();

                if (empty($errores)) {
                    if (!is_dir(CARPETA_IMAGENES_INVESTIGACIONES)) {
                        mkdir(CARPETA_IMAGENES_INVESTIGACIONES, 0777, true);
                    }

                    if (!empty($nombreImagen) && isset($image)) {
                        $image->save(CARPETA_IMAGENES_INVESTIGACIONES . $nombreImagen);
                    }

                    $blog->publico = 1;
                    $blog->actualizar();

                    if (!empty($invList)) {
                        $investigacionC->actualizar();
                    } else {
                        $investigacionC->crear();
                    }

                    header("Location: /public/blog?id={$blogId}&resultado=1");
                    exit;
                }
            } elseif (isset($_POST['ocultar'])) {
                $blog->publico = 0;
                $blog->actualizar();

                if (!empty($invList)) {
                    $inv = $invList[0];
                    $inv->eliminar();

                    if (!empty($inv->imagen) && file_exists(CARPETA_IMAGENES_INVESTIGACIONES . $inv->imagen)) {
                        unlink(CARPETA_IMAGENES_INVESTIGACIONES . $inv->imagen);
                    }
                }

                header("Location: /public/blog?id={$blogId}&resultado=3");
                exit;
            }
        }

        $router->render("/admin/blogs/lectorBlog", [
            "investigacionC" => $investigacionC,
            "resultado" => $resultado,
            "errores" => $errores,
            "blog" => $blog,
            "id_usuario" => $id_usuario,
            "contenido_html" => $contenido_html,
            "profesional" => $profesional,
            "usuario" => $usuario,
            "fecha" => $formattedDate,
            "esDuenio" => $esDuenio,
            "esAdmin" => $esAdmin
        ]);
    }

    public static function guardar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        header('Content-Type: application/json');

        $id = intval($_POST["id"] ?? 0);
        $blog = BlogPost::find($id);

        if (!$blog) {
            echo json_encode(["status" => "error", "mensaje" => "El artículo no existe."]);
            return;
        }

        $sessionId = $_SESSION["id"] ?? null;
        $esAdmin = !empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]);

        if (!$esAdmin && (!$sessionId || intval($sessionId) !== intval($blog->id_usuario))) {
            echo json_encode(["status" => "error", "mensaje" => "No tienes permisos para editar este artículo."]);
            return;
        }

        $blog->contenido_html = $_POST["contenido_html"] ?? "";
        $resultado = $blog->actualizar();

        echo json_encode([
            "status" => $resultado ? "ok" : "error",
            "resultado" => $resultado
        ]);
    }
}