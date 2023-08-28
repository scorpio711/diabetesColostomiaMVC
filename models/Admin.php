<?php

namespace Model;

class Admin extends ActiveRecord
{
    //base de datos
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "password", "nombre", "fecha_nacimiento", "imagen"];

    public $id;
    public $email;
    public $password;
    public $nombre;
    public $fecha_nacimiento;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->nombre = $args["nombre"] ?? null;
        $this->fecha_nacimiento = $args["fecha_nacimiento"] ?? null;
        $this->imagen = $args["imagen"] ?? null;
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "El Email es obligatorio";
        }
        if (!$this->password) {
            self::$errores[] = "El Password es obligatorio";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        //Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password);

        if (!$autenticado) {
            self::$errores[] = "El password es incorrecto";
        }
        return $autenticado;
    }

    public function autenticar() {
        session_start();

        //llenar el arreglo de sesion
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;

        header("location: /public/admin/index");
    }
}