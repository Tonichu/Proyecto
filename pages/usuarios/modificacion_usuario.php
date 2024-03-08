<?php
// iniciamos la sesion
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
  usuarioAdmin();
// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión

require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
  $id_usuario = $_POST['id'];
  $nombre_usuario = $_POST['nombre'];
  $tipo_usuario = $_POST['tipo_usuario'];
  

  // Comprobar si se ingresó una nueva contraseña, y si es así, encriptarla
    $query = "UPDATE usuarios SET nombre='$nombre_usuario', tipo_usuarios=$tipo_usuario WHERE id_usuarios=$id_usuario";
  header("refresh:2;url= panel_de_control.php");
  mysqli_query($conexion, $query);
  $resultado = mysqli_query($conexion, $query);
if (!$resultado) {
    die('Error en la consulta: ' . mysqli_error($conexion));
}
mysqli_close($conexion);
  exit;
} else {
  header("refresh:2;url= panel_de_control.php");
  // Si no se recibió un ID de usuario válido, mostrar un mensaje de error
  echo "<p>Error: ID de usuario no válido</p>";
}
?>