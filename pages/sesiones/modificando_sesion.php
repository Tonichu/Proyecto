<?php
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin();

// Verificar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
    $conexion = mysqli_connect($host, $user, $password, $database, $port);

    // Obtener los datos del formulario
    $id = $_POST['id'];
    $id_clase = $_POST['id_clase'];
    $id_sala = $_POST['id_sala'];
    $fecha_hora_inicio = $_POST['fecha_hora_inicio'];
    $fecha_hora_fin = $_POST['fecha_hora_fin'];

    // Actualizar la sesión en la base de datos
    $query = "UPDATE sesiones SET id_clases = $id_clase, id_salas = $id_sala, fecha_hora_inicio = '$fecha_hora_inicio', fecha_hora_fin = '$fecha_hora_fin' WHERE id = $id";
    if (mysqli_query($conexion, $query)) {
        echo "Sesión actualizada correctamente.";
        header("refresh:2;url= ../usuarios/panel_de_control.php");
    } else {
        echo "Error al actualizar la sesión: " . mysqli_error($conexion);
        header("refresh:2;url= ../usuarios/panel_de_control.php");
    }

    mysqli_close($conexion);
} else {
    // Si no se recibió el formulario correctamente, mostrar un mensaje de error
    echo "Error: No se recibió el formulario correctamente.";
}
?>
