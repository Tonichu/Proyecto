<?php
session_start();
require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
usuarioProfesor();

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
  header("refresh:2;../usuarios/usuario_profe.php");
}

// Obtener el ID de las sesiones a eliminar
$id = $_GET["id"];

// Eliminar las sesiones de la tabla "sesioness"
$sql = "DELETE FROM sesiones WHERE id=$id";
if ($conexion->query($sql) === TRUE) {
  // Mostrar un mensaje de éxito y redirigir al usuario a la página "panelDeControl.php"
  echo "la sesion ha sido eliminado con éxito.";
  header("refresh:2;../usuarios/usuario_profe.php");
  exit();
} else {
  echo "Error al eliminar la sesion: " . $conexion->error;
  header("refresh:2;../usuarios/usuario_profe.php");
}

// Cerrar la conexión a la base de datos
$conexion->close();
