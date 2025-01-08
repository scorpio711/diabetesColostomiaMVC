<?php

namespace Model;

class EncuestaSalud extends ActiveRecord
{
    // Base de Datos
    protected static $tabla = "encuestasalud";
    protected static $columnasDB = [
        "id",
        "usuario_id",
        "cuidado_instrumental",
        "alimentacion",
        "actividad_fisica",
        "adaptaciones",
        "signos_alarma",
        "categoria_total",
        "fecha_registro",
        "intento"
    ];

    public $id;
    public $usuario_id;
    public $cuidado_instrumental;
    public $alimentacion;
    public $actividad_fisica;
    public $adaptaciones;
    public $signos_alarma;
    public $categoria_total;
    public $fecha_registro;
    public $intento;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->usuario_id = $args["usuario_id"] ?? null;
        $this->cuidado_instrumental = $args["cuidado_instrumental"] ?? null;
        $this->alimentacion = $args["alimentacion"] ?? null;
        $this->actividad_fisica = $args["actividad_fisica"] ?? null;
        $this->adaptaciones = $args["adaptaciones"] ?? null;
        $this->signos_alarma = $args["signos_alarma"] ?? null;
        $this->categoria_total = $args["categoria_total"] ?? null;
        $this->fecha_registro = $args["fecha_registro"] ?? date("Y-m-d H:i:s");
        $this->intento = $args["intento"] ?? null;
    }

    public function validarEncuesta()
    {
        self::$errores = [];

        // Validar categorías individuales
        if (!$this->esCategoriaValida($this->cuidado_instrumental)) {
            self::$errores[] = "Cuidado instrumental debe ser 'Bajo', 'Medio' o 'Alto'";
        }

        if (!$this->esCategoriaValida($this->alimentacion)) {
            self::$errores[] = "Alimentación debe ser 'Bajo', 'Medio' o 'Alto'";
        }

        if (!$this->esCategoriaValida($this->actividad_fisica)) {
            self::$errores[] = "Actividad física debe ser 'Bajo', 'Medio' o 'Alto'";
        }

        if (!$this->esCategoriaValida($this->adaptaciones)) {
            self::$errores[] = "Adaptaciones debe ser 'Bajo', 'Medio' o 'Alto'";
        }

        if (!$this->esCategoriaValida($this->signos_alarma)) {
            self::$errores[] = "Signos de alarma debe ser 'Bajo', 'Medio' o 'Alto'";
        }

        // Validar categoría total
        if (!$this->esCategoriaValida($this->categoria_total)) {
            self::$errores[] = "La categoría total debe ser 'Bajo', 'Medio' o 'Alto'";
        }

        return self::$errores;
    }

    private function esCategoriaValida($categoria)
    {
        $categorias_validas = ["Bajo", "Medio", "Alto"];
        return in_array($categoria, $categorias_validas);
    }
}
