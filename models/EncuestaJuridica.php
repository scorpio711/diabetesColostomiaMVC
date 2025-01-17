<?php

namespace Model;

class encuestaJuridica extends ActiveRecord
{
    // Base de Datos
    protected static $tabla = "encuestajuridica";
    protected static $columnasDB = [
        "id",
        "usuario_id",
        "fundamental",
        "salud",
        "peticion",
        "proceso",
        "tutela",
        "dignidad",
        "categoria_total",
        "fecha_registro",
        "intento"
    ];

    public $id;
    public $usuario_id;
    public $fundamental;
    public $salud;
    public $peticion;
    public $proceso;
    public $tutela;
    public $dignidad;
    public $categoria_total;
    public $fecha_registro;
    public $intento;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->usuario_id = $args["usuario_id"] ?? null;
        $this->fundamental = $args["fundamental"] ?? null;
        $this->salud = $args["salud"] ?? null;
        $this->peticion = $args["peticion"] ?? null;
        $this->proceso = $args["proceso"] ?? null;
        $this->tutela = $args["tutela"] ?? null;
        $this->dignidad = $args["dignidad"] ?? null;
        $this->categoria_total = $args["dignidad"] ?? null;
        $this->fecha_registro = $args["fecha_registro"] ?? date("Y-m-d H:i:s");
        $this->intento = $args["intento"] ?? 0;
    }

    public function validarDatos()
    {
        self::$errores = [];

        // Validar campos numéricos
        if (!is_numeric($this->fundamental) || $this->fundamental < 0) {
            self::$errores[] = "El campo fundamental debe ser un número positivo.";
        }

        if (!is_numeric($this->salud) || $this->salud < 0) {
            self::$errores[] = "El campo salud debe ser un número positivo.";
        }

        if (!is_numeric($this->peticion) || $this->peticion < 0) {
            self::$errores[] = "El campo petición debe ser un número positivo.";
        }

        if (!is_numeric($this->proceso) || $this->proceso < 0) {
            self::$errores[] = "El campo proceso debe ser un número positivo.";
        }

        if (!is_numeric($this->tutela) || $this->tutela < 0) {
            self::$errores[] = "El campo tutela debe ser un número positivo.";
        }

        if (!is_numeric($this->dignidad) || $this->dignidad < 0) {
            self::$errores[] = "El campo dignidad debe ser un número positivo.";
        }

        if (!is_numeric($this->intento) || $this->intento < 0) {
            self::$errores[] = "El campo intento debe ser un número positivo.";
        }

        return self::$errores;
    }
}
