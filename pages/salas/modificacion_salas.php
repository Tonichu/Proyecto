<?php
// iniciamos la sesion
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin();
// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión

require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);

if (!empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['aforo'])) {
  // Los campos no están vacíos, puedes continuar con el procesamiento
  // Recuperar los valores de los campos del formulario
  $id_sala = $_POST['id'];
  $nombre_sala = $_POST['nombre'];
  $aforo_sala = $_POST['aforo'];
  $query = "UPDATE salas SET nombre='$nombre_sala',aforo ='$aforo_sala' WHERE id_salas=$id_sala";
  mysqli_query($conexion, $query);
  $resultado = mysqli_query($conexion, $query);
  if (!$resultado) {
    die('Error en la consulta: ' . mysqli_error($conexion));
  }
  echo "La sala se modifico correctamente";
  header("refresh:1;url= ../usuarios/panel_de_control.php");
  mysqli_close($conexion);
  exit;
} else {
  // Si no se recibió un ID de sala válido, mostrar un mensaje de error
  echo "<p>Error: ID de sala no válido</p>";
  header("refresh:1;url= ../usuarios/panel_de_control.php");
}