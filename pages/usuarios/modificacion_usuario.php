<?php
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
usuarioAdmin();
$conexion = mysqli_connect($host, $user, $password, $database, $port);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && is_numeric($_POST['id'])) {
  $id_usuario = $_POST['id'];
  $tipo_usuario = $_POST['tipo_usuario'];

  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  $query = "UPDATE usuarios SET tipo_usuarios=$tipo_usuario WHERE id_usuarios=$id_usuario";
  mysqli_query($conexion, $query);
  mysqli_close($conexion);

  // Redireccionar a la página de control
  header("refresh:2;url= panel_de_control.php");
  echo "Usuario actualizado";
  exit();
  mysqli_close($conexion);
} else {
  echo "Error al actualizar al usuario";
  header("refresh:3;url= panel_de_control.php");
  // Si no se recibió un ID de usuario válido, mostrar un mensaje de error
  echo "<p>Error: ID de usuario no válido</p>";
}
