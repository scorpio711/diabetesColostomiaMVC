<?php

namespace Model;

class encuestaPsicologia extends ActiveRecord
{
    // Base de Datos
    protected static $tabla = "encuestapsicologia";
    protected static $columnasDB = [
        "id",
        "usuario_id",
        "tristeza_depresion",
        "ansiedad",
        "ira_hostilidad",
        "alegria",
        "fecha_registro",
        "intento"
    ];

    public $id;
    public $usuario_id;
    public $tristeza_depresion;
    public $ansiedad;
    public $ira_hostilidad;
    public $alegria;
    public $fecha_registro;
    public $intento;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->usuario_id = $args["usuario_id"] ?? null;
        $this->tristeza_depresion = $args["tristeza_depresion"] ?? null;
        $this->ansiedad = $args["ansiedad"] ?? null;
        $this->ira_hostilidad = $args["ira_hostilidad"] ?? null;
        $this->alegria = $args["alegria"] ?? null;
        $this->fecha_registro = $args["fecha_registro"] ?? date("Y-m-d H:i:s");
        $this->intento = $args["intento"] ?? null;
    }

    // public function validarEncuesta()
    // {
    //     self::$errores = [];

    //     // Validar categorías individuales
    //     if (!$this->esCategoriaValida($this->cuidado_instrumental)) {
    //         self::$errores[] = "Cuidado instrumental debe ser 'Bajo', 'Medio' o 'Alto'";
    //     }

    //     if (!$this->esCategoriaValida($this->alimentacion)) {
    //         self::$errores[] = "Alimentación debe ser 'Bajo', 'Medio' o 'Alto'";
    //     }

    //     if (!$this->esCategoriaValida($this->actividad_fisica)) {
    //         self::$errores[] = "Actividad física debe ser 'Bajo', 'Medio' o 'Alto'";
    //     }

    //     if (!$this->esCategoriaValida($this->adaptaciones)) {
    //         self::$errores[] = "Adaptaciones debe ser 'Bajo', 'Medio' o 'Alto'";
    //     }

    //     if (!$this->esCategoriaValida($this->signos_alarma)) {
    //         self::$errores[] = "Signos de alarma debe ser 'Bajo', 'Medio' o 'Alto'";
    //     }

    //     // Validar categoría total
    //     if (!$this->esCategoriaValida($this->categoria_total)) {
    //         self::$errores[] = "La categoría total debe ser 'Bajo', 'Medio' o 'Alto'";
    //     }

    //     return self::$errores;
    // }

    private function esCategoriaValida($categoria)
    {
        $categorias_validas = ["Bajo", "Medio", "Alto"];
        return in_array($categoria, $categorias_validas);
    }
}
