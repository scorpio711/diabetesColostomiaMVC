<?php

namespace Model;

class Profesionales extends ActiveRecord
{
    protected static $tabla = "profesionales";
    protected static $columnasDB = ["id", "id_usuario", "nombre", "apellido", "sexo", "edad","email", "profesion", "especializacion", "telefono", "descripcion", "archivos"];

    public $id;
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $sexo;
    public $edad;
    public $email;
    public $telefono;
    public $profesion;
    public $especializacion;
    public $descripcion;
    public $archivos;
    

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->edad = $args["edad"] ?? "";
        $this->sexo = $args["sexo"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->profesion = $args["profesion"] ?? "";
        $this->especializacion = $args["especializacion"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->archivos = $args["archivos"] ?? "";
        
    }
    public function validarProfesional()
    {
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir tu nombre";
        }
        if (!$this->email) {
            self::$errores[] = "Debes añadir tu email";
        }
        if (!$this->telefono) {
            self::$errores[] = "Debes añadir tu telefono";
        }
        if (!$this->profesion) {
            self::$errores[] = "Debes añadir tu profesión";
        }

        return self::$errores;
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

    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$errores[] = "El usuario ya esta registrado";
        }

        return $resultado;
    }
}