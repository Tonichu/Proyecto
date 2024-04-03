<?php

require_once(__DIR__ . "/../../controllers/admin_controller/machine_controller.php");


$machineController = new machineController();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $foto = $_FILES['foto']; // Recuerda que FILES contiene información sobre archivos subidos
    $fecha_adquisicion = $_POST['fecha_adquisicion'];
    $ultima_revision = $_POST['ultima_revision'];
    $id_sala = $_POST['sala'];
 
    $resultado = $machineController->addMachine($nombre, $descripcion, $foto,$fecha_adquisicion,$ultima_revision, $id_sala);

    header("refresh:9;url=../../views/admin_panel.php");
    if ($resultado) {
        echo "La maquina se ha creado correctamente.";
    } else {
        echo "Error al crear la maquina.";
    }
} else {
    echo "Error: No se ha enviado el formulario de creación de maquina.";
}
?>