<?php

namespace Model;

class BlogPost extends ActiveRecord
{
    // Base de datos
    protected static $tabla = "blog_posts";
    protected static $columnasDB = ["id", "id_usuario", "publico", "nombre", "titulo", "correo", "contenido_html", "fecha_creacion", "cargo"];

    public $id;
    public $id_usuario;
    public $publico;
    public $nombre;
    public $titulo;
    public $correo;
    public $contenido_html;
    public $fecha_creacion;
    public $cargo;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->id_usuario = $args["id_usuario"] ?? null;
        $this->publico = $args["publico"] ?? 0;
        $this->nombre = $args["nombre"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->correo = $args["correo"] ?? "";
        $this->contenido_html = $args["contenido_html"] ?? "";
        $this->fecha_creacion = $args["fecha_creacion"] ?? date('Y-m-d H:i:s'); // Dejar null para que se asigne automáticamente si no se proporciona
        $this->cargo = $args["cargo"] ?? "";
    }

    public function validarBlog()
    {
        if (!$this->correo) {
            self::$errores[] = "Debes añadir un correo";
        }
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir tu nombre";
        }
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        return self::$errores;
    }
}
