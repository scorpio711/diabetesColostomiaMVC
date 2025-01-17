<?php

namespace Controllers;

use Model\Investigacion;
use MVC\Router;

class ColostomiaController
{
    public static function index(Router $router)
    {
        session_start();
        esColostomia();
        $investigaciones = Investigacion::get(4, 'DESC');

        $router->render("/colostomia/index", ["investigaciones" => $investigaciones]);
    }
}