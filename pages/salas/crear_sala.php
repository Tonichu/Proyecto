<?php
// iniciamos la sesion
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin();
// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión

require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['aforo']) && !empty($_POST['aforo']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
  $nombre = $_POST['nombre'];
  $aforo = $_POST['aforo'];
  // Insertar la nueva sala en la base de datos
  // Verificar si la sala existe estoy comparando con nombre
  $sql = "SELECT * FROM salas WHERE nombre='$nombre'";
  $result = $conexion->query($sql);
  if (!$result) {
    // Si hay un error en la consulta SQL, mostrar el mensaje de error
    echo "Error en la consulta SQL: " . $conexion->error;
  } else {
    if ($result->num_rows > 0) {
      // Si la salas ya existe, mostrar un mensaje de error y volver a intentarlo
      echo "La sala ya existe. Por favor, intenta con otro nombre de sala o habla con un administrador.";
      header("refresh:2;../usuarios/panel_de_control.php");
      exit();
    } else {

      // Insertar los datos de la nueva sala en la tabla "sala"

      $sql1 = "INSERT INTO salas (nombre, aforo) VALUES ('$nombre','$aforo')";
      if ($conexion->query($sql1) === TRUE) {
        // Mostrar un mensaje de éxito y redirigir al usuario a la página "panel_de_control.php"
        echo "sala creada con éxito.";
        header("refresh:2;../usuarios/panel_de_control.php");
        exit();
      } else {
        echo "Error al crear la sala : " . $conexion->error;
      }
    }
  }
}
// Verificar si se insertó correctamente
$conexion->close();
