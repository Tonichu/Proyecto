<?php
require_once(__DIR__ . "/room_controller.php");

$id = $_GET['id'];

// Verificar si se ha enviado el formulario de eliminación
if (isset($_GET['id'])) {

    // Crear una instancia de UserController
    $roomController = new roomController();

    // Llamar al método eliminarUsuario del UserController
    $mensaje = $roomController->deleteRoom($id);

    // Mostrar el mensaje en la vista
    echo $mensaje;
} else {
    //header("refresh:2;url=../../views/admin_panel.php");
    // Manejar el caso en el que no se haya enviado el formulario de eliminación
    echo "Error: No se ha enviado el formulario de eliminación.";
}
?>