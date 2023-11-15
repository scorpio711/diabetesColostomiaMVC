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

function isAdmin() : void
{
    if (!isset($_SESSION["admin"])) {
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
function validarTipoContenido($tipo){
    $tipos = ["usuario", "investigacion"];
    return in_array($tipo, $tipos);
}


//Muestra mensajes y alertas
function mostrarNotificacion($codigo){
    $mensaje = "";
    switch($codigo){
        case '1':

    }
}