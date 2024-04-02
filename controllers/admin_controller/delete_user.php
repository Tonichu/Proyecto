<?php
require_once(__DIR__ . "/user_controller.php");
require_once(__DIR__ . "/../../models/admin_models/user_model.php");
require_once(__DIR__ . "/../../models/database.php");

$database = new Database();
$idUsuario = $_GET['id'];

// Verificar si se ha enviado el formulario de eliminación
if (isset($_GET['id'])) {

    // Crear una instancia de UserController
    $userController = new UserController(new Database());

    // Llamar al método eliminarUsuario del UserController
    $mensaje = $userController->deleteUser($idUsuario);

    // Mostrar el mensaje en la vista
    echo $mensaje;
} else {
    header("refresh:2;url=../../views/admin_panel.php");
    // Manejar el caso en el que no se haya enviado el formulario de eliminación
    echo "Error: No se ha enviado el formulario de eliminación.";
}
?>