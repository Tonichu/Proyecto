<?php
require_once(__DIR__ . "/../../../models/admin_models/machine_model.php");

// Verificar si se ha enviado el formulario de modificación

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $foto = $_FILES['foto']; // Recuerda que FILES contiene información sobre archivos subidos
    $fecha_adquisicion = $_POST['fecha_adquisicion'];
    $ultima_revision = $_POST['ultima_revision'];
    $id_sala = $_POST['sala'];

    // Crear una instancia
    $machineModel = new machineModel();

    $resultado = $machineModel->updateMachine($id,$nombre, $descripcion,$foto,$fecha_adquisicion,$ultima_revision,$id_sala);
    
    header("refresh:2;url=../../../views/admin_panel.php");
    if ($resultado) {
        echo "maquina actualizada.";
        exit();
    } else {
        echo "Error al actualizar la maquina.";
    }
} else {
    echo "Error: No se ha enviado el formulario de modificación.";
}
