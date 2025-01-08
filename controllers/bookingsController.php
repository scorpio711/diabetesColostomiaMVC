<?php

namespace Controllers;

use MVC\Router;

class BookingsController{
    public static function view(Router $router)
    {
        session_start();
        estaAutenticado();

        $router->render("bookings/bookingsView", [
            "nombre" => $_SESSION["nombre"],
            "id" => $_SESSION["id"],
        ]);
    }
}