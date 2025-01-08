<?php

require_once __DIR__ . "/../includes/app.php";

use Controllers\AbogadosController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\ColostomiaController;
use Controllers\DiabetesController;
use Controllers\EnfermerosController;
use MVC\Router;
use Controllers\InvestigacionController;
use Controllers\EncuestasController;
use Controllers\UsuariosController;
use Controllers\PaginasController;
use Controllers\LoginController;
use Controllers\PacientesController;
use Controllers\ServiciosController;
use Controllers\ProfesionalesController;
use Controllers\PsicologosController;
use Controllers\BlogController;
use Controllers\BookingsController;

$router = new Router();

$router->get("/public/admin/index", [PaginasController::class, "indexAdmin"]);

//Crud investigaciones
$router->get("/public/admin/investigaciones/administrar", [InvestigacionController::class, "administrarInvestigaciones"]);
$router->post("/public/admin/investigaciones/administrar", [InvestigacionController::class, "administrarInvestigaciones"]);

//Crud usuarios
$router->get("/public/admin/usuarios/administrar", [UsuariosController::class, "administrarUsuarios"]);
$router->post("/public/admin/usuarios/administrar", [UsuariosController::class, "administrarUsuarios"]);
$router->get("/public/perfil", [UsuariosController::class, "perfil"]);
$router->post("/public/perfil", [UsuariosController::class, "perfil"]);

//Crud Profesionales
$router->get("/public/admin/profesionales/administrar", [ProfesionalesController::class, "administrarProfesionales"]);
$router->post("/public/admin/profesionales/administrar", [ProfesionalesController::class, "administrarProfesionales"]);

//Crud pacientes
$router->get("/public/admin/pacientes/administrar", [PacientesController::class, "administrarPacientes"]);

//Crud citas
$router->get("/public/admin/citas/administrar", [CitaController::class, "administrarCitas"]);

//Crud srvicios
$router->get("/public/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);
$router->post("/public/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);

//perfil profesional
$router->get("/public/perfil/profesionales", [ProfesionalesController::class, "perfilProfesionales"]);
$router->post("/public/perfil/profesionales", [ProfesionalesController::class, "perfilProfesionales"]);

//Crud encuesta salud
$router->get("/public/admin/encuestaSalud", [EncuestasController::class, "adminSalud"]);
$router->get("/public/encuesta", [EncuestasController::class, "encuestaSalud"]);
$router->post("/public/encuesta", [EncuestasController::class, "encuestaSalud"]);

//Abogados
$router->get("/public/admin/abogados", [AbogadosController::class, "indexAbogados"]);

//psicologos
$router->get("/public/admin/psicologos", [PsicologosController::class, "indexPsicologos"]);

//enfermeros
$router->get("/public/admin/enfermeros", [EnfermerosController::class, "indexEnfermeros"]);


//paginas
$router->get("/public", [PaginasController::class, "index"]);
$router->get("/public/investigaciones", [PaginasController::class, "investigaciones"]);
$router->get("/public/juridico", [PaginasController::class, "juridico"]);
$router->get("/public/medico", [PaginasController::class, "medico"]);
$router->get("/public/psicologico", [PaginasController::class, "psicologico"]);
$router->get("/public/contacto", [PaginasController::class, "contacto"]);

$router->get("/public/blogplantilla", [PaginasController::class, "blog"]);

//Login y Autenticacion
$router->get("/public/login", [LoginController::class, "login"]);
$router->post("/public/login", [LoginController::class, "login"]);
$router->get("/public/logout", [LoginController::class, "logout"]);
$router->get("/public/olvide-password", [LoginController::class, "olvidePassword"]);
$router->post("/public/olvide-password", [LoginController::class, "olvidePassword"]);
$router->get("/public/cambio-password", [LoginController::class, "cambioPassword"]);
$router->post("/public/cambio-password", [LoginController::class, "cambioPassword"]);
$router->get("/public/registro", [LoginController::class, "registro"]);
$router->post("/public/registro", [LoginController::class, "registro"]);

//Confirmar cuenta
$router->get("/public/confirmar-cuenta", [LoginController::class, "confirmarCuenta"]);
$router->get("/public/mensaje", [LoginController::class, "mensaje"]);

//Area privada colostomía
$router->get("/public/colostomia", [ColostomiaController::class, "index"]);

//Area privada diabetes
$router->get("/public/diabetes", [DiabetesController::class, "index"]);

//Area Privada
$router->get("/public/cita", [CitaController::class, "index"]);
$router->get("/public/citas", [APIController::class, "citas"]);
$router->get("/public/misCitas", [CitaController::class, "misCitas"]);
$router->post("/public/misCitas", [CitaController::class, "misCitas"]);

//API de citas
$router->get("/public/api/servicios", [APIController::class, "index"]);
$router->post("/public/api/cita", [APIController::class, "guardar"]);
$router->post("/public/api/eliminar", fn: [APIController::class, "eliminar"]);
$router->get("/public/api/profesionales", [APIController::class, "profesionales"]);

//bookings
$router->get("/public/bookings/view", [BookingsController::class, "view"]);

//API para edición de blogs
$router->get("/public/editor", [BlogController::class, "editor"]);
$router->get("/public/admin/blog", [BlogController::class, "admin"]);
$router->post("/public/admin/blog", [BlogController::class, "admin"]);
$router->get("/public/blog", [BlogController::class, "lector"]);
$router->post("/public/blog", [BlogController::class, "lector"]);
$router->post("/public/api/blog", [BlogController::class, "guardar"]);

//API para el chat
$router->get("/public/api/chat", [APIController::class, "chat"]);

$router->comprobarRutas();
