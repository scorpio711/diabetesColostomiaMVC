<?php

namespace Model;

class Horarios extends ActiveRecord
{
    // Base de datos
    protected static $tabla = "horarios";
    protected static $columnasDB = ["id", "day", "start_time", "end_time", "user_id"];

    public $id;
    public $day;           // Día de la semana (monday, tuesday, etc.)
    public $start_time;    // Hora de inicio
    public $end_time;      // Hora de fin
    public $user_id;       // ID del usuario o profesional asociado (si es necesario)

    public function __construct($args = [])
    {
        // Establece los valores por defecto o los valores proporcionados en el array $args
        $this->id = $args["id"] ?? null;
        $this->day = $args["day"] ?? "";
        $this->start_time = $args["start_time"] ?? "";
        $this->end_time = $args["end_time"] ?? "";
        $this->user_id = $args["user_id"] ?? null;
    }

    public static function eliminar_horarios($consulta)
    {
        $query = $consulta;

        $resultado = self::$db->query($query);

        return $resultado;
    }
}