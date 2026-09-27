<?php

namespace Model;

class CitaServicios extends ActiveRecord{
    //base de datos
    protected static $tabla = "citaservicios";
    protected static $columnasDB = ["id", "citaId", "servicioId"];

    public $id;
    public $citaId;
    public $servicioId;
    
    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->citaId = $args["citaId"] ?? "";
        $this->servicioId = $args["servicioId"] ?? "";
    }
    
    public static function encontrarCitaServicio($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE citaId = ${id};";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}