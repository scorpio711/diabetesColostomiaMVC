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
       
        // $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $urlActual = strtok($_SERVER["REQUEST_URI"], "?") ?? "/public";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if ($metodo === "GET") {
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPost[$urlActual] ?? null;
        }


        if ($fn) {
            // La URL existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo "pagina no encontrada";
            header("location: /public");
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