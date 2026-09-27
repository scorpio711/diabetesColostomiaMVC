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
$router->get("/public/admin/simular-rol", [PaginasController::class, "simularRol"]);

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


//Crud srvicios
$router->get("/public/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);
$router->post("/public/admin/servicios/administrar", [ServiciosController::class, "administrarServicios"]);

//perfil profesional
$router->get("/public/perfil/profesionales", [ProfesionalesController::class, "perfilProfesionales"]);
$router->post("/public/perfil/profesionales", [ProfesionalesController::class, "perfilProfesionales"]);

//Crud encuesta salud
$router->get("/public/admin/encuestaSalud", [EncuestasController::class, "adminSalud"]);
$router->post("/public/admin/encuestaSalud", [EncuestasController::class, "adminSalud"]);
$router->get("/public/encuestaSalud", [EncuestasController::class, "encuestaSalud"]);
$router->post("/public/encuestaSalud", [EncuestasController::class, "encuestaSalud"]);

//Crud encuesta Psicología
$router->get("/public/admin/encuestaPsicologia", [EncuestasController::class, "adminPsicologia"]);
$router->post("/public/admin/encuestaPsicologia", [EncuestasController::class, "adminPsicologia"]);
$router->get("/public/encuestaPsicologia", [EncuestasController::class, "encuestaPsicologia"]);
$router->post("/public/encuestaPsicologia", [EncuestasController::class, "encuestaPsicologia"]);

//Crud encuesta Juridica
$router->get("/public/admin/encuestaJuridica", [EncuestasController::class, "adminJuridica"]);
$router->post("/public/admin/encuestaJuridica", [EncuestasController::class, "adminJuridica"]);
$router->get("/public/encuestaJuridica", [EncuestasController::class, "encuestaJuridica"]);
$router->post("/public/encuestaJuridica", [EncuestasController::class, "encuestaJuridica"]);

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
// $router->get("/public/contacto", [PaginasController::class, "contacto"]);

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

//API de citas
$router->get("/public/api/servicios", [APIController::class, "index"]);
$router->post("/public/api/cita", [APIController::class, "guardar"]);
$router->post("/public/api/eliminar", [APIController::class, "eliminar"]);
$router->get("/public/api/profesionales", [APIController::class, "profesionales"]);
$router->get("/public/api/horarios", [APIController::class, "horarioProfesionales"]);
$router->get("/public/api/disponibilidad", [APIController::class, "disponibilidad"]);

//bookings
$router->get("/public/citas", [CitaController::class, "view"]);
$router->get("/public/contacto", [APIController::class, "citas"]);
$router->get("/public/misCitas", [CitaController::class, "misCitas"]);
$router->post("/public/misCitas", [CitaController::class, "misCitas"]);

//Crud citas
$router->get("/public/admin/contacto", [CitaController::class, "administrarContacto"]);
$router->post("/public/admin/contacto", [CitaController::class, "administrarContacto"]);
$router->get("/public/admin/citas", [CitaController::class, "administrarCitas"]);
$router->post("/public/admin/citas", [CitaController::class, "administrarCitas"]);

//API para edición de blogs
$router->get("/public/editor", [BlogController::class, "editor"]);
$router->get("/public/admin/blog", [BlogController::class, "admin"]);
$router->post("/public/admin/blog", [BlogController::class, "admin"]);
$router->get("/public/blog", [BlogController::class, "lector"]);
$router->post("/public/blog", [BlogController::class, "lector"]);
$router->post("/public/api/blog", [BlogController::class, "guardar"]);

//API para el chat
$router->get("/public/api/chat", [APIController::class, "chat"]);

//API para prueba de correo desde toolbar admin
$router->post("/public/api/test-email", [APIController::class, "testEmail"]);

$router->comprobarRutas();
