<?php

namespace Controllers;

use MVC\Router;

class ColostomiaController
{
    public static function index($router)
    {
        session_start();
        esColostomia();
        
        $router->render("/colostomia/index", []);
    }
}