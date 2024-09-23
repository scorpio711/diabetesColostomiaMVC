<?php

namespace Model;

class Paciente extends ActiveRecord
{
    protected static $tabla = "pacientes";
    protected static $columnasDB = ["id", "pacienteId", "edad", "sexo", "escolaridad", "estrato_socioeconomico", "lugar_de_residencia", "ocupacion", "apoyo", "afiliacion", "tiempo_enfermedad", "nombre", "email", "telefono", "imagen"];

    public $id;
    public $pacienteId;
    public $edad;
    public $sexo;
    public $escolaridad;
    public $estrato_socioeconomico;
    public $lugar_de_residencia;
    public $ocupacion;
    public $apoyo;
    public $afiliacion;
    public $tiempo_enfermedad;
    public $nombre;
    public $telefono;
    public $email;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->pacienteId = $args["pacienteId"] ?? "";
        $this->sexo = $args["sexo"] ?? "";
        $this->escolaridad = $args["escolaridad"] ?? "";
        $this->estrato_socioeconomico = $args["estrato_socioeconomico"] ?? "";
        $this->lugar_de_residencia = $args["lugar_de_residencia"] ?? "";
        $this->ocupacion = $args["ocupacion"] ?? "";
        $this->apoyo = $args["apoyo"] ?? "";
        $this->afiliacion = $args["afiliacion"] ?? "";
        $this->tiempo_enfermedad = $args["tiempo_enfermedad"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->telefono = $args["nombre"] ?? 0;
        $this->telefono = $args["imagen"] ?? "";
        
    }
    public function validarActualizacionPerfil()
    {
        if (!$this->escolaridad) {
            self::$errores[] = "Debes escoger tu nivel escolar";
        }
        if (!$this->estrato_socioeconomico) {
            self::$errores[] = "Debes ecoger tu estrato socieconomico";
        }
        if (!$this->lugar_de_residencia) {
            self::$errores[] = "Debes escoger tu lugar de residencia";
        }
        if (!$this->ocupacion) {
            self::$errores[] = "Debes escoger tu ocupacion";
        }
        if (!$this->apoyo) {
            self::$errores[] = "Debes escoger tu apoyo";
        }
        if (!$this->afiliacion) {
            self::$errores[] = "debes escoger tu tipo de afiliacion";
        }
        if (!$this->tiempo_enfermedad) {
            self::$errores[] = "debes  esoger tu tiempo con tu enfermedad";
        }
        

        return self::$errores;
    }

    public static function encontrarPaciente($id)
    {
        $query = "SELECT * FROM pacientes WHERE idPacientes = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function validarImagen()
    {
        if (empty($_FILES['imagen']['name'])) {
            self::$errores[] = 'La imagen es obligatoria';
        }
        return self::$errores;
    }

}