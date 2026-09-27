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

    // Propiedades adicionales del JOIN con usuarios
    public $enfermedad;
    public $encuesta_salud;
    public $encuesta_psicologia;
    public $encuesta_juridico;
    public $fecha_nacimiento;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->pacienteId = $args["pacienteId"] ?? "";
        $this->edad = $args["edad"] ?? 0;
        $this->sexo = $args["sexo"] ?? "";
        $this->escolaridad = $args["escolaridad"] ?? "";
        $this->estrato_socioeconomico = $args["estrato_socioeconomico"] ?? 1;
        $this->lugar_de_residencia = $args["lugar_de_residencia"] ?? "";
        $this->ocupacion = $args["ocupacion"] ?? "";
        $this->apoyo = $args["apoyo"] ?? "";
        $this->afiliacion = $args["afiliacion"] ?? "";
        $this->tiempo_enfermedad = $args["tiempo_enfermedad"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->enfermedad = $args["enfermedad"] ?? "";
        $this->encuesta_salud = $args["encuesta_salud"] ?? 0;
        $this->encuesta_psicologia = $args["encuesta_psicologia"] ?? 0;
        $this->encuesta_juridico = $args["encuesta_juridico"] ?? 0;
        $this->fecha_nacimiento = $args["fecha_nacimiento"] ?? "";
    }
    public function validarActualizacionPerfil()
    {
        self::$errores = [];
        if (!$this->escolaridad) {
            self::$errores[] = "Debes escoger tu nivel de escolaridad";
        }
        if (!$this->estrato_socioeconomico) {
            self::$errores[] = "Debes escoger tu estrato socioeconómico";
        }
        if (!$this->lugar_de_residencia) {
            self::$errores[] = "Debes escoger tu lugar de residencia";
        }
        if (!$this->ocupacion) {
            self::$errores[] = "Debes escoger tu ocupación principal";
        }
        if (!$this->apoyo) {
            self::$errores[] = "Debes escoger tu principal red de apoyo";
        }
        if (!$this->afiliacion) {
            self::$errores[] = "Debes escoger tu régimen de afiliación en salud";
        }
        if (!$this->tiempo_enfermedad) {
            self::$errores[] = "Debes indicar el tiempo que llevas con tu condición";
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