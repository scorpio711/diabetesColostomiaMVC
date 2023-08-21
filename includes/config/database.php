<?php

function conectarDB() : mysqli
{
    $db = new mysqli("localhost", "root", "root", "investigacionesCD");

    if (!$db) {
        echo "No se pudo conectar";
        exit;
    }

    return $db;
}
