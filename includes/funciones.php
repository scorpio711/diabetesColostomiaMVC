<?php


define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "functiones");
define("CARPETA_IMAGENES_INVESTIGACIONES", $_SERVER["DOCUMENT_ROOT"] . "/public/imagenesInvestigaciones/");
define("CARPETA_IMAGENES_USUARIOS", $_SERVER["DOCUMENT_ROOT"] . "/public/imagenesUsuarios/");

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION["login"])) {
        header("Location: /public");
        exit;
    }
}

function isAdmin(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION["admin"]) && empty($_SESSION["admin_real"])) {
        header("Location: /public");
        exit;
    }
}

function esAbogado(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]) || ($_SESSION["rol"] ?? '') === "abogado") {
        return;
    }

    header("Location: /public");
    exit;
}

function esEnfermero(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]) || ($_SESSION["rol"] ?? '') === "enfermero") {
        return;
    }

    header("Location: /public");
    exit;
}

function esPsicologo(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]) || ($_SESSION["rol"] ?? '') === "psicologo") {
        return;
    }

    header("Location: /public");
    exit;
}

function esFuncionario(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $rol = $_SESSION["rol"] ?? '';
    $admin = !empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]);

    if ($rol === "abogado" || $rol === "enfermero" || $rol === "psicologo" || $admin) {
        return;
    }

    header("Location: /public");
    exit;
}

function esColostomia(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]) || ($_SESSION["enfermedad"] ?? '') === "colostomia") {
        return;
    }

    header("Location: /public");
    exit;
}

function esDiabetes(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!empty($_SESSION["admin"]) || !empty($_SESSION["admin_real"]) || ($_SESSION["enfermedad"] ?? '') === "diabetes") {
        return;
    }

    header("Location: /public");
    exit;
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit();
}

//escapa /sanitizar el html
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar contenido
function validarTipoContenido($tipo)
{
    $tipos = ["usuario", "investigacion"];
    return in_array($tipo, $tipos);
}


//Muestra mensajes y alertas
function mostrarNotificacion($codigo)
{
    $mensaje = "";
    switch ($codigo) {
        case '1':

    }
}