<?php

namespace Model;

class Investigacion extends ActiveRecord
{
    protected static $tabla = "investigaciones";
    protected static $columnasDB = ["id", "titulo", "autor", "fecha_publicacion", "resumen", "imagen"];


    public $id;
    public $titulo;
    public $autor;
    public $fecha_publicacion;
    public $resumen;
    public $imagen;


    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->autor = $args["autor"] ?? "";
        $this->fecha_publicacion = $args["fecha_publicacion"] ?? "";
        $this->resumen = $args["resumen"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
    }



    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (!$this->autor) {
            self::$errores[] = "Debes añadir un autor";
        }

        if (!$this->resumen) {
            self::$errores[] = "Debes añadir el resumen";
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