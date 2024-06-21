<?php


define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "functiones");
define("CARPETA_IMAGENES_INVESTIGACIONES", $_SERVER["DOCUMENT_ROOT"] . "/public/imagenesInvestigaciones/");
define("CARPETA_IMAGENES_USUARIOS", $_SERVER["DOCUMENT_ROOT"] . "/public/imagenesUsuarios/");

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado()
{
    session_start();

    if (!$_SESSION["login"]) {
        header("location: /public");
    }

}

function isAdmin(): void
{
    if (!isset($_SESSION["admin"])) {
        header("location: /public");
    }
}

function esAbogado()
{
    if ($_SESSION["rol"] !== "abogado") {
        header("location: /public");
    }
}
function esEnfermero()
{
    if ($_SESSION["rol"] !== "enfermero") {
        header("location: /public");
    }
}
function esPsicologo()
{
    if ($_SESSION["rol"] !== "psicologo") {
        header("location: /public");
    }
}

function esFuncionario()
{
    if ($_SESSION["rol"] == "abogado") {
        esAbogado();
    } elseif ($_SESSION["admin"] == "1") {
        isAdmin();
    } elseif ($_SESSION["rol"] == "enfermero") {
        esEnfermero();
    } elseif ($_SESSION["rol"] == "psicologo") {
        esPsicologo();
    } else {
        header("Location:/public");
    }
}

function esColostomia()
{
    if ($_SESSION["enfermedad"] !== "colostomia") {
        header("location: /public");
    }
}

function esDiabetes()
{
    if ($_SESSION["enfermedad"] !== "diabetes") {
        header("location: /public");
    }
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