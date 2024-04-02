<?php

session_start();

require_once (__DIR__ . "/../models/database.php");
require_once (__DIR__ . "/../models/usuario_model.php");
require_once(__DIR__ . "/login_controller.php");

$database = new Database();
$db = $database->getConnection();

$usuarioModel = new UsuarioModel($db);
$loginController = new LoginController($usuarioModel);

// Validación y saneamiento del correo electrónico
$correo = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    // Correo electrónico no válido
    // Manejar el error o redirigir al usuario
}

// Escapado de la contraseña
$pass = htmlspecialchars($_POST['password'], ENT_QUOTES);

$usuario = $loginController->comprobarUsuario($correo, $pass);

if (is_array($usuario)) {
    // Almacenar información de sesión y redirigir
    $_SESSION["nombre"] = $usuario['nombre'];
    $_SESSION["tipo_usuarios"] = $usuario['tipo_usuarios'];
    $_SESSION["id_usuarios"] = $usuario['id_usuarios'];
    $pagina_redireccion = determinePageRedirection($usuario['tipo_usuarios']);
    header("Location: $pagina_redireccion");
    exit;
} else {
    echo $_SESSION['error_message'] = $usuario;
    header("refresh:2; ../../index.php");
    exit;
}

function determinePageRedirection($tipo_usuario) {
    switch ($tipo_usuario) {
        case 0: // Admin
            return "../views/admin_panel.php";
            break;
        case 1: // Profesor
            return "../views/teacher_panel.php";
            break;
        case 2: // Usuario
            return "../views/user_panel.php";
            break;
        default:
            return "/index.php"; // Redirigir a la página por defecto
            break;
    }
}

?>