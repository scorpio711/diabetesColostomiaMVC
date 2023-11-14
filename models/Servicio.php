<?php

namespace Model;

class Servicio extends ActiveRecord
{
    //Base de Datos
    protected static $tabla = "servicios";
    protected static $columnasDB = ["id", "nombre_servicio", "descripcion"];

    public $id;
    public $nombre_servicio;
    public $descripcion;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre_servicio = $args["nombre_servicio"] ?? null;
        $this->descripcion = $args["descripcion"] ?? null;
    }

    public function validarServicio()
    {
        if (!$this->nombre_servicio) {
            self::$errores[] = "Debes añadirle un nombre al servicio";
        }
        if (!$this->descripcion) {
            self::$errores[] = "Debes añadirle una descripcion al servicio";
        }
        if (strlen($this->descripcion) < 30) {
            self::$errores[] = "La descripcion es muy corta (mas de 30 letras)";
        }

        return self::$errores;
    }

}