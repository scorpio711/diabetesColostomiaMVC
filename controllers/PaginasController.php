<?php

namespace Controllers;

use MVC\router;
use Model\Investigacion;

class PaginasController
{
    public static function index(Router $router)
    {
        $investigaciones = Investigacion::get(4);
        $router->render("/paginas/index", [
            "investigaciones" => $investigaciones
        ]);
    }
    public static function investigaciones(Router $router)
    {
        $investigaciones = Investigacion::all();
        $router->render("/paginas/investigaciones", [
            "investigaciones" => $investigaciones
        ]);
    }
    public static function indexAdmin(Router $router)
    {
        $router->render("/admin/index");
    }
}