<?php
require_once(__DIR__ . "/../../../models/admin_models/class_model.php");
// Verificar si se ha enviado el formulario de modificación

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $id_profesor = $_POST['profesor'];

    // Crear una instancia
    $classModel = new ClassModel();

    $resultado = $classModel->updateClass($id, $nombre, $descripcion, $id_profesor);
    
    header("refresh:2;url=../../../views/admin_panel.php");
    if ($resultado) {
        echo "clase actualizada.";
        exit();
    } else {
        echo "Error al actualizar la clase.";
    }
} else {
    echo "Error: No se ha enviado el formulario de modificación.";
}
