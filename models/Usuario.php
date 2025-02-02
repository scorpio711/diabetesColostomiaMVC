<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "telefono", "password", "nombre", "fecha_nacimiento", "imagen", "admin", "confirmado", "token", "enfermedad", "sexo", "actualizado", "rol", "encuesta_salud", "encuesta_psicologia", "encuesta_juridico"];

    public $id;
    public $email;
    public $telefono;
    public $password;
    public $nombre;
    public $fecha_nacimiento;
    public $enfermedad;
    public $sexo;
    public $imagen;
    public $admin;
    public $confirmado;
    public $token;
    public $actualizado;
    public $rol;
    public $encuesta_salud;
    public $encuesta_psicologia;
    public $encuesta_juridico;


    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->fecha_nacimiento = $args["fecha_nacimiento"] ?? 0;
        $this->imagen = $args["imagen"] ?? "";
        $this->enfermedad = $args["enfermedad"] ?? "";
        $this->sexo = $args["sexo"] ?? null;
        $this->admin = $args["admin"] ?? 0;
        $this->confirmado = $args["confirmado"] ?? 0;
        $this->token = $args["token"] ?? "";
        $this->actualizado = $args["actualizado"] ?? 0;
        $this->rol = $args["rol"] ?? "";
        $this->encuesta_salud = $args["encuesta_salud"] ?? 0;
        $this->encuesta_psicologia = $args["encuesta_psicologia"] ?? 0;
        $this->encuesta_juridico = $args["encuesta_juridico"] ?? 0;
    }
    public function validarNuevaCuenta()
    {
        if (!$this->email) {
            self::$errores[] = "Debes añadir un email";
        }
        if (!$this->telefono) {
            self::$errores[] = "Debes añadir un numero de telefono";
        }
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre";
        }
        if (!$this->sexo) {
            self::$errores[] = "Debes añadir tu sexo";
        }
        if (!$this->fecha_nacimiento) {
            self::$errores[] = "Debes añadir tu fecha de nacimiento";
        }
        if (!$this->password) {
            self::$errores[] = "Debes añadir una contraseña";
        }
        if (strlen($this->password) <= 8) {
            self::$errores[] = "la constraseña debe tener mas de 8 caracteres";
        }

        return self::$errores;
    }

    //Validar cuenta profesional

    public function validarProfesional()
    {
        if (!$this->sexo) {
            self::$errores[] = "Debes añadir tu sexo";
        }
        if (!$this->fecha_nacimiento) {
            self::$errores[] = "Debes añadir tu fecha de nacimiento";
        }
        return self::$errores;
    }
    public function validarImagen()
    {
        if (empty($_FILES['imagen']['name'])) {
            self::$errores[] = 'La imagen es obligatoria';
        }
        return self::$errores;
    }
    //Validar login
    public function validarLogin()
    {
        if (!$this->email) {
            self::$errores[] = "El email es Obligatorio";
        }
        if (!$this->password) {
            self::$errores[] = "El password es Obligatorio";
        }

        return self::$errores;
    }
    public function validarEmail()
    {
        if (!$this->email) {
            self::$errores[] = 'El email es Obligatorio';
        }
        return self::$errores;
    }


    //Validar password
    public function validarPassword()
    {
        if (!$this->password) {
            self::$errores[] = "El password es obligatorio";
        }
        if (strlen($this->password) < 6) {
            self::$errores[] = "El password debe tener almenos 6 caracteres";
        }

        return self::$errores;
    }

    //Revisa si el usuario ya existe

    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$errores[] = "El usuario ya esta registrado";
        }

        return $resultado;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password)
    {
        $resultado = password_verify($password, $this->password);

        if ($this->confirmado === "0") {
            self::$errores[] = "El usuario no esta confirmado";
        } elseif (!$resultado) {
            self::$errores[] = "El Password es incorrecto";
        } else {
            return true;
        }
    }
}