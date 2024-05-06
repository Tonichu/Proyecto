<?php
require_once(__DIR__ . "/../../controllers/teacher_controller/sessions/session_controller.php");

$idClass = $_GET['id'];

// Verificar si se ha enviado el formulario de eliminación
if (isset($_GET['id'])) {

    // Crear una instancia de UserController
    $sessionController = new sessionController();

    // Llamar al método eliminarUsuario del UserController
    $mensaje = $sessionController->deleteSessionTeacher($idClass);

    // Mostrar el mensaje en la vista
    echo $mensaje;
} else {

    echo "Error: No se ha enviado el formulario de eliminación.";
}
?>