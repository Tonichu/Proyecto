<?php
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin();
// Si el sala no ha iniciado sesión, redirigir a la página de inicio de sesión

require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener el ID de la sala a eliminar
$id = $_GET["id"];

// Eliminar la sala de la tabla "salas"
$sql = "DELETE FROM salas WHERE id_salas=$id";

if ($conexion->query($sql) === TRUE) {
  // Mostrar un mensaje de éxito y redirigir al usuario a la página "panelDeControl.php"
  echo "la sala ha sido eliminado con éxito.";
  header("refresh:1;../usuarios/panel_de_control.php");
  exit();
} else {
  echo "Error al eliminar la sala: " . $conexion->error;
  header("refresh:1;../usuarios/panel_de_control.php");
}

// Cerrar la conexión a la base de datos
$conexion->close();
