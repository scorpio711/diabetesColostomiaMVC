<?php

namespace Model;

class AdminCita extends ActiveRecord
{

    protected static $tabla = "citaServicios";
    protected static $columnasDB = ["id", "citaId", "id_paciente", "id_profesional", "fecha", "hora", "nombre", "email", "nombre_servicio"];

    public $id;
    public $citaId;
    public $id_paciente;
    public $id_profesional;
    public $fecha;

    public $hora;
    public $nombre;
    public $email;
    public $nombre_servicio;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->id_paciente = $args["id_paciente"] ?? "";
        $this->id_profesional = $args["id_profesional"] ?? "";
        $this->fecha = $args["fecha"] ?? "";
        $this->hora = $args["hora"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->nombre_servicio = $args["nombre_servicio"] ?? "";
    }
}