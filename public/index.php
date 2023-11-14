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

$router->get("/admin/index", [PaginasController::class, "indexAdmin"]);

//Crud investigaciones
$router->get("/admin/investigaciones/administrar", [InvestigacionController::class, "administrarInvestigaciones"]);
$router->post("/admin/investigaciones/administrar", [InvestigacionController::class, "administrarInvestigaciones"]);

//Crud usuarios
$router->get("/admin/usuarios/administrar", [UsuariosController::class, "administrarUsuarios"]);
$router->post("/admin/usuarios/administrar", [UsuariosController::class, "administrarUsuarios"]);
$router->get("/perfil",[UsuariosController::class, "perfil"] );
$router->post("/perfil",[UsuariosController::class, "perfil"] );

//Crud pacientes
$router->get("/admin/pacientes/administrar", [PacientesController::class, "administrarPacientes"]);

//Crud citas
$router->get("/admin/citas/administrar", [CitaController::class, "administrarCitas"]);

//Crud srvicios
$router->get("/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);
$router->post("/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);


//paginas
$router->get("/", [PaginasController::class, "index"]);
$router->get("/investigaciones", [PaginasController::class, "investigaciones"]);
$router->get("/juridico", [PaginasController::class, "juridico"]);
$router->get("/medico", [PaginasController::class, "medico"]);
$router->get("/psicologico", [PaginasController::class, "psicologico"]);
$router->get("/contacto", [PaginasController::class, "contacto"]);
$router->get("/encuesta", [PaginasController::class, "encuesta"]);

//Login y Autenticacion
$router->get("/login",[LoginController::class, "login"] );
$router->post("/login",[LoginController::class, "login"] );
$router->get("/logout",[LoginController::class, "logout"] );
$router->get("/olvide-password",[LoginController::class, "olvidePassword"] );
$router->post("/olvide-password",[LoginController::class, "olvidePassword"] );
$router->get("/cambio-password",[LoginController::class, "cambioPassword"] );
$router->post("/cambio-password",[LoginController::class, "cambioPassword"] );
$router->get("/registro",[LoginController::class, "registro"] );
$router->post("/registro",[LoginController::class, "registro"] );


//Confirmar cuenta
$router->get("/confirmar-cuenta",[LoginController::class, "confirmarCuenta"] );
$router->get("/mensaje",[LoginController::class, "mensaje"] );


//Area Privada
$router->get("/cita", [CitaController::class, "index"]);
$router->get("/misCitas", [CitaController::class, "misCitas"]);
$router->post("/misCitas", [CitaController::class, "misCitas"]);

//API de citas
$router->get("/api/servicios", [APIController::class, "index"]);
$router->post("/api/cita", [APIController::class, "guardar"]);
$router->post("/api/eliminar", [APIController::class, "eliminar"]);

$router->comprobarRutas();
