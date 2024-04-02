<?php

require_once(__DIR__ . "/../../controllers/admin_controller/class_controller.php");
require_once(__DIR__ . "/../../models/admin_models/class_model.php");
require_once(__DIR__ . "/../../models/database.php");

$database = new Database();

// Crear una instancia del controlador de clase
$classController = new ClassController();

// Verificar si se ha enviado el formulario de creación de clase
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
   
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $id_profesor = $_POST['profesor'];
    // Llamar al método para agregar una nueva clase del controlador de clase
    $resultado = $classController->addClass($nombre, $descripcion, $id_profesor);

    // Verificar el resultado y mostrar un mensaje
    header("refresh:2;url=../../views/admin_panel.php");
    if ($resultado) {
        echo "La clase se ha creado correctamente.";
    } else {
        echo "Error al crear la clase.";
    }
} else {
    // Manejar el caso en el que no se haya enviado el formulario de creación de clase
    echo "Error: No se ha enviado el formulario de creación de clase.";
}
?>