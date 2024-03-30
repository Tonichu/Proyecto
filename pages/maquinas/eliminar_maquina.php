<?php
session_start();
// Datos de conexión a la base de datos
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
usuarioAdmin();// solo acceso admin
// Crear conexión a la base de datos
$conexion = mysqli_connect($host, $user, $password, $database, $port);

// Comprobar si la conexión ha sido exitosa
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener el ID de la maquina a eliminar
$id = $_GET["id"];

// Eliminar la maquina de la tabla "USUARIO"
$sql = "DELETE FROM maquinas WHERE id_maquina=$id";

if ($conexion->query($sql) === TRUE) {
  // Mostrar un mensaje de éxito y redirigir al usuario a la página "panelDeControl.php"
  echo "la maquina ha sido eliminada con éxito.";
  header("refresh:1;../usuarios/panel_de_control.php");
  exit();
} else {
  echo "Error al eliminar la maquina: " . $conexion->error;
  header("refresh:1;../usuarios/panel_de_control.php");
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>