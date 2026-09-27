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

    // Propiedades virtuales para JOIN con tabla usuarios
    public $imagen;
    public $fecha_nacimiento;
    public $usuario_confirmado;
    public $usuario_actualizado;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->id_usuario = $args["id_usuario"] ?? null;
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
        $this->imagen = $args["imagen"] ?? "";
        $this->fecha_nacimiento = $args["fecha_nacimiento"] ?? "";
    }
    public function validarProfesional()
    {
        self::$errores = [];
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir el nombre";
        }
        if (!$this->email) {
            self::$errores[] = "Debes añadir el email";
        }
        if (!$this->telefono) {
            self::$errores[] = "Debes añadir el teléfono";
        }
        if (!$this->profesion) {
            self::$errores[] = "Debes seleccionar la profesión";
        }

        return self::$errores;
    }
    public function validarActualizacionPerfil()
    {
        self::$errores = [];
        if (!$this->telefono) {
            self::$errores[] = "Debes ingresar tu número de teléfono celular de contacto.";
        }
        
        if (!$this->especializacion) {
            self::$errores[] = "Debes escoger tu especialidad.";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción profesional es muy corta (debe tener al menos 50 caracteres).";
        }
        if (strlen($this->descripcion) > 500) {
            self::$errores[] = "La descripción profesional no debe superar los 500 caracteres.";
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