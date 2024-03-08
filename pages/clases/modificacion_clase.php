<?php
// iniciamos la sesion
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin();
// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión

require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);

if (!empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['descripcion'])) {
  // Los campos no están vacíos, puedes continuar con el procesamiento
  // Recuperar los valores de los campos del formulario
  $id_clase = $_POST['id'];
  $nombre_clase = $_POST['nombre'];
  $descripcion_clase = $_POST['descripcion'];
  $query = "UPDATE clases SET nombre='$nombre_clase', descripcion='$descripcion_clase' WHERE id_clases=$id_clase";
  mysqli_query($conexion, $query);
  $resultado = mysqli_query($conexion, $query);
  if (!$resultado) {
    die('Error en la consulta: ' . mysqli_error($conexion));
  }
  header("refresh:1;url= ../usuarios/panel_de_control.php");
  echo "La clase se modifico correctamente";
  mysqli_close($conexion);
  exit;
} else {
  header("refresh:1;url= ../usuarios/panel_de_control.php");
  // Si no se recibió un ID de clase válido, mostrar un mensaje de error
  echo "<p>Error: ID de clase no válido</p>";
}
