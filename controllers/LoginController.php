<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Profesionales;
use Model\Paciente;
use Classes\Email;

class LoginController
{
    public static function login(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION["login"])) {
            header("Location: /public");
            exit;
        }

        $errores = [];
        $resultado = $_GET["resultado"] ?? null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $auth = new Usuario($_POST);
            $errores = $auth->validarLogin();

            if (empty($errores)) {
                $usuario = Usuario::where("email", $auth->email);

                if ($usuario) {
                    // Verificar el password y estado de confirmación
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        // Autenticar el usuario
                        $usuarioId = $usuario->id;
                        
                        $query = "SELECT * FROM pacientes WHERE pacienteId = " . intval($usuarioId) . ";";
                        $pacienteDatos = Paciente::SQL($query);
                        $paciente = !empty($pacienteDatos) ? $pacienteDatos[0] : null;
                    
                        $_SESSION["id"] = $usuarioId;
                        $_SESSION["nombre"] = $usuario->nombre;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["imagen"] = $usuario->imagen;
                        $_SESSION["sexo"] = $usuario->sexo;
                        $_SESSION["fecha_nacimiento"] = $usuario->fecha_nacimiento;
                        $_SESSION["actualizado"] = $usuario->actualizado;
                        $_SESSION["rol"] = $usuario->rol;
                        $_SESSION["enfermedad"] = $usuario->enfermedad;
                        $_SESSION["login"] = true;

                        // Redireccionamiento según rol o condición
                        if ($usuario->admin === "1") {
                            $_SESSION["admin"] = $usuario->admin ?? 0;
                            header("Location: /public/admin/index");
                            exit;
                        } elseif ($_SESSION["rol"] === "abogado") {
                            header('Location: /public/admin/abogados');
                            exit;
                        } elseif ($_SESSION["rol"] === "enfermero") {
                            header('Location: /public/admin/enfermeros');
                            exit;
                        } elseif ($_SESSION["rol"] === "psicologo") {
                            header('Location: /public/admin/psicologos');
                            exit;
                        } elseif ($_SESSION["enfermedad"] === "diabetes" || $_SESSION["enfermedad"] === "colostomia") {
                            header('Location: /public');
                            exit;
                        } else {
                            header('Location: /public/cita');
                            exit;
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        header("Location: /public");
        exit;
    }

    public static function olvidePassword($router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION["login"])) {
            header("Location: /public");
            exit;
        }

        $errores = [];
        $resultado = $_GET["resultado"] ?? null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = new Usuario($_POST);
            $errores = $auth->validarEmail();

            if (empty($errores)) {
                $usuario = Usuario::where("email", $auth->email);

                if ($usuario && $usuario->confirmado == "1") {

                    // Generar un token
                    $usuario->crearToken();
                    $usuario->actualizar();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarIntrucciones($usuario->email);

                    // Alerta de éxito
                    header("Location: /public/olvide-password?resultado=1");
                    exit;

                } else {
                    Usuario::setErrores("El usuario no está confirmado o no existe");
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION["login"])) {
            header("Location: /public");
            exit;
        }

        $errores = [];
        $token = s($_GET["token"] ?? '');
        $noToken = false;

        // Buscar usuario por su token
        $usuario = !empty($token) ? Usuario::where("token", $token) : null;

        if (empty($usuario)) {
            Usuario::setErrores("El enlace no es válido o ha expirado");
            $noToken = true;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !$noToken) {
            // Leer el nuevo password y guardarlo
            $password = new Usuario($_POST);
            $errores = $password->validarPassword();

            if (empty($errores)) {
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->actualizar();

                if ($resultado) {
                    header("Location: /public/login?resultado=3");
                    exit;
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION["login"])) {
            header("Location: /public");
            exit;
        }

        $usuario = new Usuario($_POST ?? []);
        $errores = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
            $usuario->sincronizar($_POST);
            $errores = $usuario->validarNuevaCuenta();

            // Validar condición
            if (!$usuario->enfermedad) {
                $errores[] = "Debes seleccionar una condición";
            }

            $usuario->rol = "paciente";

            // Revisar que errores esté vacío
            if (empty($errores)) {
                // Verificar que el usuario no esté registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado && $resultado->num_rows) {
                    $errores = Usuario::getErrores();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Generar un token único
                    $usuario->crearToken();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion($usuario->email);

                    // Crear el usuario
                    $resultado = $usuario->crear();

                    if ($resultado) {
                        header("Location: /public/login?resultado=1");
                        exit;
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION["login"])) {
            header("Location: /public");
            exit;
        }

        $errores = [];
        $token = s($_GET["token"] ?? '');
        $resultado = s($_GET["resultado"] ?? '');

        $usuario = !empty($token) ? Usuario::where("token", $token) : null;

        if (empty($usuario)) {
            Usuario::setErrores("El token no es válido o ha expirado");
        } else {
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->actualizar();
            header("Location: /public/login?resultado=2");
            exit;
        }

        $errores = Usuario::getErrores();

        $router->render("/auth/confirmar-cuenta", [
            "errores" => $errores,
            "resultado" => $resultado
        ]);
    }
}