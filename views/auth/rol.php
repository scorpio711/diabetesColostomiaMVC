<?php

$script = "<script src ='/public/build/js/app.js'></script>";

?>

<body>
    <h2>Selecciona una opción:</h2>
    <h2>Selecciona una opción:</h2>
    <h2>Selecciona una opción:</h2>
    <h2>Selecciona una opción:</h2>
    <h2>Selecciona una opción:</h2>
    <select id="opciones" onchange="mostrarOpcionSeleccionada()">
        <option value="">Selecciona una opción</option>
        <option value="opcion1">Opción 1</option>
        <option value="opcion2">Opción 2</option>
        <option value="opcion3">Opción 3</option>
    </select>

    <div id="resultado" style="display: none;">
        <h3>Has seleccionado:</h3>
        <p id="opcionSeleccionada"></p>
    </div>

    