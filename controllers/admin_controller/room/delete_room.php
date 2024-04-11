<?php
require_once(__DIR__ . "/room_controller.php");

$id = $_GET['id'];

// Verificar si se ha enviado el formulario de eliminación
if (isset($_GET['id'])) {

    header("refresh:2;url=../../views/admin_panel.php");

    $roomController = new roomController();

    $mensaje = $roomController->deleteRoom($id);

    echo $mensaje;
} 
?>