<?php

require_once __DIR__. "/../includes/app.php";

use Controllers\APIController;
use Controllers\CitaController;
use MVC\Router;
use Controllers\InvestigacionController;
use Controllers\UsuariosController;
Use Controllers\PaginasController;
Use Controllers\LoginController;
use Controllers\PacientesController;
use Controllers\ServiciosController;

$router = new Router();

$router->get("/public/admin/index", [PaginasController::class, "indexAdmin"]);

//Crud investigaciones
$router->get("/public/admin/investigaciones/administrar", [InvestigacionController::class, "administrarInvestigaciones"]);
$router->post("/public/admin/investigaciones/administrar", [InvestigacionController::class, "administrarInvestigaciones"]);

//Crud usuarios
$router->get("/public/admin/usuarios/administrar", [UsuariosController::class, "administrarUsuarios"]);
$router->post("/public/admin/usuarios/administrar", [UsuariosController::class, "administrarUsuarios"]);
$router->get("/public/perfil",[UsuariosController::class, "perfil"] );
$router->post("/public/perfil",[UsuariosController::class, "perfil"] );

//Crud pacientes
$router->get("/public/admin/pacientes/administrar", [PacientesController::class, "administrarPacientes"]);

//Crud citas
$router->get("/public/admin/citas/administrar", [CitaController::class, "administrarCitas"]);

//Crud srvicios
$router->get("/public/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);
$router->post("/public/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);


//paginas
$router->get("/public", [PaginasController::class, "index"]);
$router->get("/public/investigaciones", [PaginasController::class, "investigaciones"]);
$router->get("/public/juridico", [PaginasController::class, "juridico"]);
$router->get("/public/medico", [PaginasController::class, "medico"]);
$router->get("/public/psicologico", [PaginasController::class, "psicologico"]);
$router->get("/public/contacto", [PaginasController::class, "contacto"]);
$router->get("/public/encuesta", [PaginasController::class, "encuesta"]);
$router->post("/public/encuesta", [PaginasController::class, "encuesta"]);

//Login y Autenticacion
$router->get("/public/login",[LoginController::class, "login"] );
$router->post("/public/login",[LoginController::class, "login"] );
$router->get("/public/logout",[LoginController::class, "logout"] );
$router->get("/public/olvide-password",[LoginController::class, "olvidePassword"] );
$router->post("/public/olvide-password",[LoginController::class, "olvidePassword"] );
$router->get("/public/cambio-password",[LoginController::class, "cambioPassword"] );
$router->post("/public/cambio-password",[LoginController::class, "cambioPassword"] );
$router->get("/public/registro",[LoginController::class, "registro"] );
$router->post("/public/registro",[LoginController::class, "registro"] );


//Confirmar cuenta
$router->get("/public/confirmar-cuenta",[LoginController::class, "confirmarCuenta"] );
$router->get("/public/mensaje",[LoginController::class, "mensaje"] );


//Area Privada
$router->get("/public/cita", [CitaController::class, "index"]);
$router->get("/public/misCitas", [CitaController::class, "misCitas"]);
$router->post("/public/misCitas", [CitaController::class, "misCitas"]);

//API de citas
$router->get("/public/api/servicios", [APIController::class, "index"]);
$router->post("/public/api/cita", [APIController::class, "guardar"]);
$router->post("/public/api/eliminar", [APIController::class, "eliminar"]);

$router->comprobarRutas();
