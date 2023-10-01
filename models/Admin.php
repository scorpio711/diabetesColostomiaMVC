<?php

namespace Model;

class Admin extends ActiveRecord
{
    //base de datos
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "password", "nombre", "fecha_nacimiento", "imagen", "admin", "confirmado", "token"];

    public $id;
    public $email;
    public $password;
    public $nombre;
    public $fecha_nacimiento;
    public $imagen;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->fecha_nacimiento = $args["fecha_nacimiento"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->admin = $args["admin"] ?? 0;
        $this->confirmado = $args["confirmado"] ?? 0;
        $this->token = $args["token"] ?? "";
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

    public function comprobarPasswordandConfirmado($resultado)
    {
        $usuario = $resultado->fetch_object();
        
        $autenticado = password_verify($this->password, $usuario->password);
        debuguear($this);
    
        if (!$autenticado || intval($this->confirmado) === 0){
            
            self::$errores[] = "El usuario no esta autenticado o la contraseña es incorrecta";
        }else{
            return true;
        }
    }

    public function autenticar()
    {
        session_start();

        //llenar el arreglo de sesion
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;

        header("location: /public/admin/index");
    }
}