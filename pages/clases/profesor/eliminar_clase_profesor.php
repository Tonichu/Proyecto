<?php
session_start();
// Datos de conexión a la base de datos
require_once(__DIR__ . "/../../../ConexionBdd/conexionBdd.Php");
require_once(__DIR__ . "/../../../librerias/utils/usuario_profesor.php");
usuarioProfesor();;// solo acceso profesor
// Crear conexión a la base de datos
$conexion = mysqli_connect($host, $user, $password, $database, $port);

// Comprobar si la conexión ha sido exitosa
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener el ID de la clase a eliminar
$id = $_GET["id"];

// Eliminarla clase de la tabla "CLASES"
$sql = "DELETE FROM clases WHERE id_clases=$id";

if ($conexion->query($sql) === TRUE) {
  // Mostrar un mensaje de éxito y redirigir al usuario a la página "panelDeControl.php"
  echo "la clase ha sido eliminada con éxito.";
  header("refresh:2;../../usuarios/usuario_profe.php");
  exit();
} else {
  echo "Error al eliminar la clase: " . $conexion->error;
  header("refresh:2;../../usuarios/usuario_profe.php");
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>