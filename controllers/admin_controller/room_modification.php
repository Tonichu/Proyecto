<?php
require_once(__DIR__ . "/../../models/admin_models/room_model.php");

// Verificar si se ha enviado el formulario de modificación

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $aforo = $_POST['aforo'];

    // Crear una instancia
    $roomModel = new roomModel();

    $resultado = $roomModel->updateRoom($id, $nombre, $aforo);
    
    header("refresh:2;url=../../views/admin_panel.php");
    if ($resultado) {
        echo "sala actualizada.";
        exit();
    } else {
        echo "Error al actualizar la sala.";
    }
} else {
    echo "Error: No se ha enviado el formulario de modificación.";
}
