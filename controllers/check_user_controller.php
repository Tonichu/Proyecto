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
$mail = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    // Correo electrónico no válido
    // Manejar el error o redirigir al usuario
}

// Escapado de la contraseña
$pass = htmlspecialchars($_POST['password'], ENT_QUOTES);

$user = $loginController->checkUser($mail, $pass);

if (is_array($user)) {
    // Almacenar información de sesión y redirigir
    $_SESSION["nombre"] = $user['nombre'];
    $_SESSION["tipo_usuarios"] = $user['tipo_usuarios'];
    $_SESSION["id_usuarios"] = $user['id_usuarios'];
    $page_redirection = determinePageRedirection($user['tipo_usuarios']);
    header("Location: $page_redirection");
    exit;
} else {
    echo $_SESSION['error_message'] = $user;
    header("refresh:2; ../index.php");
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
            return "../index.php"; // Redirigir a la página por defecto
            break;
    }
}

?>