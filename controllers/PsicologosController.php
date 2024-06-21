<?php

namespace Controllers;

use MVC\router;

class PsicologosController
{

    public static function indexPsicologos(Router $router)
    {
        session_start();
        esPsicologo();
        $router->render("/psicologos/index");
    }
}
