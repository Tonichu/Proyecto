
<?php
session_start();
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
usuarioProfesor();

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
// Verificar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    } else {
        echo "Error al actualizar la sesión: " . mysqli_error($conexion);
    }
} else {
    // Si no se recibió el formulario correctamente, mostrar un mensaje de error
    echo "Error: No se recibió el formulario correctamente.";
}
header("refresh:2;../usuarios/usuario_profe.php");
mysqli_close($conexion);

?>
