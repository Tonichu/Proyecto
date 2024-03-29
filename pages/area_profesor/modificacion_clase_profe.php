<?php
// Iniciamos la sesión
session_start();
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
usuarioProfesor();

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Verificar si se envió el formulario de modificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que los datos necesarios están presentes
    if (isset($_POST['id'], $_POST['nombre'], $_POST['descripcion'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        // Preparar la consulta SQL para actualizar la clase
        $query = "UPDATE clases 
                  SET nombre='$nombre', descripcion='$descripcion'
                  WHERE id_clases=$id";

        // Ejecutar la consulta y verificar si fue exitosa
        if (mysqli_query($conexion, $query)) {
            echo "Clase modificada con éxito.";
            header("refresh:2;../usuarios/usuario_profe.php");
        } else {
            echo "Error al modificar la clase: " . mysqli_error($conexion);
            header("refresh:2;../usuarios/usuario_profe.php");
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    } else {
        echo "Error: Todos los campos son obligatorios.";
        header("refresh:2;../usuarios/usuario_profe.php");
    }
}
?>
