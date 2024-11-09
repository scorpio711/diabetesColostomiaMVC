<?php

namespace Model;

class Investigacion extends ActiveRecord
{
    protected static $tabla = "investigaciones";
    protected static $columnasDB = ["id", "idBlog", "titulo", "autor", "fecha_publicacion", "resumen", "imagen", "url"];


    public $id;
    public $idBlog;
    public $titulo;
    public $autor;
    public $fecha_publicacion;
    public $resumen;
    public $imagen;
    public $url;


    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->idBlog = $args["idBlog"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->autor = $args["autor"] ?? "";
        $this->fecha_publicacion = $args["fecha_publicacion"] ?? "";
        $this->resumen = $args["resumen"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->url = $args["url"] ?? "";
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (!$this->autor) {
            self::$errores[] = "Debes añadir un autor";
        }

        if (!$this->resumen || strlen($this->resumen) < 50 || strlen($this->resumen) > 400) {
            self::$errores[] = "Debes añadir el resumen y debe tener entre 50 y 400 caracteres";
        }

        if (!$this->fecha_publicacion) {
            self::$errores[] = "Debes añadir una fecha de publicación";
        }

        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        return self::$errores;
    }

}