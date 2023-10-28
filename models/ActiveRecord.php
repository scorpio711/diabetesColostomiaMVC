<?php

namespace Model;

class ActiveRecord
{
    //base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    //Errores
    protected static $errores = [];


    //definir la conexion a db
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function crear($incluirId)
    {

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos($incluirId);

        //insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "');";
    
        $resultado = self::$db->query($query);
       
        return $resultado;

        // if ($resultado) {
        //     //redireccionar al usuario
        //     header("location:/public/admin/" . static::$tabla . "/administrar?resultado=1");
        // }
    }


    //Elliminar un registro
    public function eleminar()
    {

        //Eliminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id= " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        // if ($resultado) {
        //     header("location:/public/admin/" . static::$tabla . "/administrar?resultado=3");
        // }

        return $resultado;
    }

    public function actualizar($incluirId)
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos($incluirId);

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1;";

        
        $resultado = self::$db->query($query);

        // if ($resultado) {
        //     //redireccionar al usuario
        //     header("location:/public/admin/" . static::$tabla . "/administrar?resultado=2");
        // }
        return $resultado;
    }



    // Identificar y unir los atributos de la BD
    public function atributos($includeId = false)
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if (!$includeId && $columna === "id") {
                continue;
            }
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }


    public function sanitizarAtributos($incluirId)
    {
        $atributos = $this->atributos($incluirId);
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    //Subida de archivos
    public function setImagen($imagen)
    {
        //Asignar al atributo de la imagen el nombre de la imagen
        if (!empty($imagen)) {
            $this->imagen = $imagen;
        }
    }

    //Validacion
    public static function setErrores($mensaje)
    {
        static::$errores[] = $mensaje;
    }
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }
    //lista todas los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);

    }
    public static function consultarSQL($query)
    {
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            //mapear los datos y convertilos de arreglo a objetos
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && is_null($value)) {
                $this->$key = $value;
                debuguear($value);
            }
        }
    }

    //obtinene determinado numero de registros
    public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limite}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}