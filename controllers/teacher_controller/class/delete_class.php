<?php
require_once(__DIR__ . "/class_controller.php");

$idClass = $_GET['id'];

// Verificar si se ha enviado el formulario de eliminación
if (isset($_GET['id'])) {

    // Crear una instancia de UserController
    $classController = new ClassController();

    // Llamar al método eliminarUsuario del UserController
    $mensaje = $classController->deleteClass($idClass);

    // Mostrar el mensaje en la vista
    echo $mensaje;
} else {

    echo "Error: No se ha enviado el formulario de eliminación.";
}
?>