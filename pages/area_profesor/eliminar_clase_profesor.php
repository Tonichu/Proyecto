<?php
session_start();
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
usuarioProfesor();

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener el ID de la clase a eliminar
$id = $_GET["id"];

// Eliminar las sesiones relacionadas con la clase
$sql_delete_sesiones = "DELETE FROM sesiones WHERE id_clases=$id";
if ($conexion->query($sql_delete_sesiones) === TRUE) {
  // Ahora podemos eliminar la clase de la tabla "CLASES"
  $sql_delete_clase = "DELETE FROM clases WHERE id_clases=$id";
  if ($conexion->query($sql_delete_clase) === TRUE) {
    // Mostrar un mensaje de éxito y redirigir al usuario a la página "panelDeControl.php"
    echo "La clase ha sido eliminada con éxito.";
  } else {
    echo "Error al eliminar la clase: " . $conexion->error;
  }
} else {
  echo "Error al eliminar las sesiones relacionadas con la clase: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
header("refresh:2;../usuarios/usuario_profe.php");
exit();
