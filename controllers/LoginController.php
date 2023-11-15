<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Paciente;
use Classes\Email;


class LoginController
{
    public static function login(Router $router)
    {
        if ($_SESSION["login"]) {
            header("Location:/public");
        }

        $errores = [];
        $resultado = $_GET["resultado"];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $auth = new Usuario($_POST);

            $errores = $auth->validarLogin();

            if (empty($errores)) {
                $usuario = Usuario::where("email", $auth->email);

                if ($usuario) {
                    //verificar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        //Autenticar el usuario
                        session_start();
                        $usuarioId = $usuario->id;

                        $query = "SELECT * FROM pacientes WHERE pacienteId = " . $usuarioId . ";";

                        $pacienteDatos = Paciente::SQL($query);
                        $paciente = $pacienteDatos[0];

                        $_SESSION["id"] = $usuarioId;
                        $_SESSION["nombre"] = $usuario->nombre;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["imagen"] = $paciente->imagen;
                        $_SESSION["sexo"] = $usuario->sexo;
                        $_SESSION["fecha_nacimiento"] = $usuario->fecha_nacimiento;
                        $_SESSION["actualizado"] = $usuario->actualizado;
                        $_SESSION["login"] = true;

                        //redireccionamiento
                        if ($usuario->admin === "1") {
                            $_SESSION["admin"] = $usuario->admin ?? 0;
                            header("location: /public/admin/index");
                        } else {
                            header('Location: /public/cita');
                        }


                    }
                } else {
                    Usuario::setErrores("El usuario no existe");
                }
            }

        }

        $errores = Usuario::getErrores();

        $router->render("/auth/login", [
            "errores" => $errores,
            "resultado" => $resultado
        ]);
    }
    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header("location: /public");
    }

    public static function olvidePassword($router)
    {
        if ($_SESSION["login"]) {
            header("Location:/public");
        }

        $errores = [];
        $resultado = $_GET["resultado"];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = new Usuario($_POST);
            $auth->validarEmail();

            if (empty($errores)) {
                $usuario = Usuario::Where("email", $auth->email);

                if ($usuario && $usuario->confirmado === "1") {

                    //Generar un token
                    $usuario->crearToken();
                    $usuario->actualizar();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarIntrucciones($usuario->email);

                    //Alerta de exito
                    header("location:/public/olvide-password?resultado=1");

                } else {
                    Usuario::setErrores("El usuario no esta confirmado o no existe");
                    $errores = Usuario::getErrores();
                }
            }
        }

        $router->render("/auth/olvide-password", [
            "errores" => $errores,
            "resultado" => $resultado
        ]);
    }

    public static function cambioPassword($router)
    {
        if ($_SESSION["login"]) {
            header("Location:/public");
        }

        $errores = [];
        $token = s($_GET["token"]);
        $noToken = false;

        //Buscar usuario por su token

        $usuario = Usuario::where("token", $token);

        if (empty($usuario)) {
            Usuario::setErrores("token no valido");
            $noToken = true;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Leer el nuevo password y guardarlo
            $password = new Usuario($_POST);
            $errores = $password->validarPassword();

            if (empty($errores)) {
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->actualizar();

                if ($resultado) {
                    header("location:/public/login?resultado=3");
                }
            }
        }

        $errores = Usuario::getErrores();
        $router->render("/auth/cambio-password", [
            "noToken" => $noToken,
            "errores" => $errores
        ]);
    }
    public static function registro($router)
    {
        if ($_SESSION["login"]) {
            header("Location:/public");
        }

        $usuario = new Usuario($_POST);

        //Alertas Vacias
        $errores = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $usuario->sincronizar($_POST);

            $errores = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacio
            if (empty($errores)) {
                //Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $errores = Usuario::getErrores();
                } else {
                    //hashear el password
                    $usuario->hashPassword();

                    //Generar un token unico
                    $usuario->crearToken();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion($usuario->email);

                    //Crear el usuario
                    $resultado = $usuario->crear();

                    if ($resultado) {
                        header("Location:/public/login?resultado=1");
                    }
                }
            }
        }
        $router->render("/auth/registro", [
            "usuario" => $usuario,
            "errores" => $errores
        ]);
    }



    public static function confirmarCuenta($router)
    {
        if ($_SESSION["login"]) {
            header("Location:/public");
        }

        $errores = [];
        $token = s($_GET["token"]);
        $resultado = s($_GET["resultado"]);

        $usuario = Usuario::where("token", $token);

        if (empty($usuario)) {
            //mostrar mensaje de error
            Usuario::setErrores("Token no valido");
        } else {

            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->actualizar();
            header("Location:/public/login?resultado=2");
        }
        //obetener errores
        $errores = Usuario::getErrores();

        //renderizar vistas
        $router->render("/auth/confirmar-cuenta", [
            "errores" => $errores,
            "resultado" => $resultado
        ]);
    }
}