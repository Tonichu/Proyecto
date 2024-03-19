<?php
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin();
// Si el user no ha iniciado sesión, redirigir a la página de inicio de sesión

require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener el ID de las sesiones a eliminar
$id = $_GET["id"];

// Eliminar las sesiones de la tabla "sesioness"
$sql = "DELETE FROM sesiones WHERE id=$id";

if ($conexion->query($sql) === TRUE) {
  // Mostrar un mensaje de éxito y redirigir al usuario a la página "panelDeControl.php"
  echo "la sesion ha sido eliminado con éxito.";
  header("refresh:1;../usuarios/panel_de_control.php");
  exit();
} else {
  echo "Error al eliminar la sesion: " . $conexion->error;
  header("refresh:1;../usuarios/panel_de_control.php");
}

// Cerrar la conexión a la base de datos
$conexion->close();
