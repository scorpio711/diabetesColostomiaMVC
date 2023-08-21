<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "password", "nombre", "fecha_nacimiento", "imagen"];

    public $id;
    public $email;
    public $password;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? null;
        $this->password = $args["password"] ?? null;
        $this->nombre = $args["nombre"] ?? null;
        $this->apellido = $args["apellido"] ?? null;
        $this->fecha_nacimiento = $args["fecha_nacimiento"] ?? null;
        $this->imagen = $args["imagen"] ?? null;
    }
    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "Debes añadir un email";
        }
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre";
        }
        if (!$this->fecha_nacimiento) {
            self::$errores[] = "Debes añadir tu fecha de nacimiento";
        }
        if (!$this->password) {
            self::$errores[] = "Debes añadir un password";
        }
        if (!$this->imagen) {
            self::$errores[] = "Debes añadir una imagen";
        }
        return self::$errores;
    }
}