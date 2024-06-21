<?php

namespace Controllers;

use MVC\Router;

class DiabetesController
{
    public static function index($router)
    {
        session_start();
        esDiabetes();
        $router->render("/diabetes/index", []);
    }
}