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

    public function crear()
    {

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "');";
        // debuguear($query);
        // return json_encode(["query" => $query]);
        $resultado = self::$db->query($query);



        return [
            "resultado" => $resultado,
            "id" => self::$db->insert_id
        ];

        // if ($resultado) {
        //     //redireccionar al usuario
        //     header("location:/public/admin/" . static::$tabla . "/administrar?resultado=1");
        // }
    }


    //Elliminar un registro
    public function eleminar()
    {

        //Eliminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id= " . self::$db->escape_string($this->id) . " LIMIT 1;";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function actualizar()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

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
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id')
                continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }


    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
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
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id};";

        $resultado = self::consultarSQL($query);
        return array_shift($resultado);

    }

    public static function findEmail($email)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE email = '${email}';";
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
    protected static function crearObjeto($registro): ActiveRecord
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
            }
        }
    }

    //obtinene determinado numero de registros
    public static function get($limite, $orden = "ASC")
    {
        // Asegurarse de que el valor de $orden sea solo "ASC" o "DESC" para evitar inyecciones SQL
        $orden = strtoupper($orden) === "DESC" ? "DESC" : "ASC";

        // Ordenar por un campo específico, como id o fecha, y limitar la cantidad de resultados
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id $orden LIMIT ${limite}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    //Consulta Plana de SQL usar cuando los metodos del modelo no son suficientes
    public static function SQL($consulta)
    {
        $query = $consulta;
        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    public static function contarPorId($columna, $id)
    {
        //consultar la base de datos
        $query = "SELECT COUNT(*) FROM " . static::$tabla . " WHERE ${columna} = ${id};";
        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();
        //liberar la memoria
        $resultado->free();

        return intval($fila["COUNT(*)"]);
    }
    public static function unirTabla($tabla1, $tabla2, $id1, $id2)
    {
        //consultar la base de datos
        $query = "SELECT * FROM ${tabla1} JOIN ${tabla2} ON ${tabla1}.${id1} = ${tabla2}.${id2};";
        $resultado = self::$db->query($query);

        // Crear un array para almacenar los datos
        $datos = [];

        // Recorrer las filas de la tabla
        while ($fila = $resultado->fetch_assoc()) {
            // Agregar cada fila al array de datos
            $datos[] = $fila;
        }

        // // Opcional: Imprimir los datos (por ejemplo, en formato JSON)
        // echo json_encode($datos, JSON_PRETTY_PRINT);

        //liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $datos;
    }

}