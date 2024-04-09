<?php
require_once(__DIR__ . "/../../teacher_controller/class/class_controller.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_clases = $_POST['id_clases'];
    $id_profesor = $_POST['id_profesor'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Crear una instancia
    $classModel = new ClassModel();

    $resultado = $classModel->updateClass($id_clases, $nombre, $descripcion, $id_profesor);
    
    header("refresh:2;url=../../../views/teacher_panel.php");
    if ($resultado) {
        echo "clase actualizada.";
        exit();
    } else {
        echo "Error al actualizar la clase.";
    }
} else {
    echo "Error: No se ha enviado el formulario de modificación.";
}
