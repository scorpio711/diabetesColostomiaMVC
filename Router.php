<?php

namespace MVC;

class Router
{
    public $rutasGet = [];
    public $rutasPost = [];

    /**
     * Normaliza la URL:
     * - Remueve parámetros GET (?query=...)
     * - Remueve el prefijo /public para soportar URLs limpias
     * - Asegura formato estándar (ej: '/', '/login', '/admin/index')
     */
    private function normalizarUrl(string $url): string
    {
        $url = strtok($url, '?') ?: '/';
        // Elimina el prefijo /public si estuviera presente
        $url = preg_replace('#^/public#', '', $url);
        // Quita slashes finales redundantes excepto si es la raíz
        $url = rtrim($url, '/');
        
        return $url === '' ? '/' : $url;
    }

    public function get($url, $fn)
    {
        $this->rutasGet[$this->normalizarUrl($url)] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPost[$this->normalizarUrl($url)] = $fn;
    }

    public function comprobarRutas()
    {   
        $urlActual = $this->normalizarUrl($_SERVER["REQUEST_URI"] ?? '/');
        $metodo = $_SERVER["REQUEST_METHOD"] ?? 'GET';

        if ($metodo === "GET") {
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPost[$urlActual] ?? null;
        }

        if ($fn) {
            // La URL existe y hay una función asociada
            call_user_func($fn, $this);
        } else {
            // Código de estado HTTP 404 real (sin redirecciones recursivas)
            http_response_code(404);
            echo "Página no encontrada (Error 404)";
            // O si tienes una vista 404: $this->render('paginas/404');
        }
    }

    // Muestra la vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}