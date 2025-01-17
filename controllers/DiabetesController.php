<?php

namespace Controllers;

use Model\Investigacion;
use MVC\Router;

class DiabetesController
{
    public static function index(Router $router)
    {
        session_start();
        esDiabetes();
        $investigaciones = Investigacion::get(4, 'DESC');

        $router->render("/diabetes/index", ["investigaciones" => $investigaciones]);
    }
}