<?php

namespace Controllers;


use Model\Usuario;
use Model\Profesionales;
use MVC\router;

class AbogadosController
{

    public static function indexAbogados(Router $router)
    {
        session_start();

        esAbogado();

        $router->render("/abogados/index");
    }
   
}

