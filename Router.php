<?php

namespace MVC;

class Router
{
    public $rutasGet = [];
    public $rutasPost = [];

    public function get($url, $fn)
    {
        $this->rutasGet[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPost[$url] = $fn;
    }
    public function comprobarRutas()
    {
        session_start();
        
        $auth = $_SESSION["login"] ?? null;
        
        //Arreglo de rutas protegidas
        $rutas_protegidas = ["/admin/usuarios/administrar", "/admin/investigaciones/administrar", "/admin/index"];

        $urlActual = $_SERVER["PATH_INFO"] ?? "/";

        $metodo = $_SERVER["REQUEST_METHOD"];

        if ($metodo === "GET") {
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {
            $fn = $this->rutasGet[$urlActual] ?? null;
        }

        //Proteger rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header("location: /public");
        }


        if ($fn) {
            // La URL existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo "pagina no encontrada";
        }
    }

    //muestra la vista
    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Almacenamiento en memoria durante un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Limpiar el buffer

        include __DIR__ . "/views/layout.php";
    }
}