<?php 

namespace Model;

class Servicio extends ActiveRecord{
    //Base de Datos
    protected static $tabla = "servicios";
    protected static $columnasDB = ["id", "nombre_servicio", "descripcion"];

    public $id;
    public $nombre_servicio;
    public $descripcion;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->id = $args["nombre_servicio"] ?? null;
        $this->id = $args["descripcion"] ?? null;
    }

}