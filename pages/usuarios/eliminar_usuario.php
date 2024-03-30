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

// Obtener el ID del usuario a eliminar
$id = $_GET["id"];

// Eliminar el usuario de la tabla "USUARIO"
$sql = "DELETE FROM USUARIOS WHERE id_usuarios=$id";

if ($conexion->query($sql) === TRUE) {
  // Mostrar un mensaje de éxito y redirigir al usuario a la página "panelDeControl.php"
  echo "El usuario ha sido eliminado con éxito.";
  header("refresh:1;url=panel_de_control.php");
  exit();
} else {
  echo "Error al eliminar usuario: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>