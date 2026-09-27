<?php

namespace Model;

class Cita extends ActiveRecord{
    //base de datos
    protected static $tabla = "citas";
    protected static $columnasDB = ["id", "id_paciente","id_profesional" ,"fecha", "hora"];

    public $id;
    public $id_paciente;
    public $id_profesional;
    public $fecha;
    public $hora;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->id_paciente = $args["id_paciente"] ?? "";
        $this->id_profesional = $args["id_profesional"] ?? "";
        $this->fecha = $args["fecha"] ?? "";
        $this->hora = $args["hora"] ?? "";
    }

    public static function encontrarCitas($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_paciente = ${id}";
        $resultado = self::consultarSQL($query);
        return $resultado;

    }

    public static function encontrarCita($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE citaId = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);

    }
    
}