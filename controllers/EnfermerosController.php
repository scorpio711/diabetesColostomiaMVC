<?php

namespace Controllers;

use MVC\router;

class EnfermerosController
{

    public static function indexEnfermeros(Router $router)
    {
        session_start();
        esEnfermero();
        $router->render("/enfermeros/index");
    }
}
