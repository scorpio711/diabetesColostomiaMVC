<?php

namespace Model;

class Abogado extends ActiveRecord
{
    protected static $tabla = "abogados";
    protected static $columnasDB = ["id", "id_profesional", "sexo", "nombre", "especializacion", "experiencia", "telefono", "correo", "afiliaciones_profesionales", "descripcion", "archivos"];

    public $id;
    public $id_profesional;
    public $sexo;
    public $nombre;
    public $especializacion;
    public $experiencia;
    public $telefono;
    public $correo;
    public $afiliaciones_profesionales;
    public $descripcion;
    public $archivos;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->id_profesional = $args["id_profesional"] ?? null;
        $this->sexo = $args["sexo"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->especializacion = $args["especializacion"] ?? "";
        $this->experiencia = $args["experiencia"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->correo = $args["correo"] ?? "";
        $this->afiliaciones_profesionales = $args["affiliaciones_profesionales"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->archivos = $args["archivos"] ?? "";
    }
    public function validarActualizacionPerfil()
    {
        if (!$this->telefono) {
            self::$errores[] = "Debes llenar el campo de telefono.";
        }
        if (!$this->especializacion) {
            self::$errores[] = "Debes escoger tu especialidad.";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descrpcion es muy corta debe ser de almenos 50 caracteres";
        }
        if (strlen($this->descripcion) > 200) {
            self::$errores[] = "La descrpcion es muy larga debe ser de menos 250 caracteres";
        }
        return self::$errores;
    }
}