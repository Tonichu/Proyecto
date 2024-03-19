<?php
session_start();
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
usuarioProfesor();

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['descripcion']) && !empty($_POST['descripcion']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $id_profesor = $_POST['id_profesor']; // Obtener el id del profesor seleccionado

  // Insertar la nueva clase en la base de datos
  // Verificar si la clase existe estoy comparando con nombre
  $sql = "SELECT * FROM clases WHERE nombre='$nombre'";
  $result = $conexion->query($sql);
  if (!$result) {
    // Si hay un error en la consulta SQL, mostrar el mensaje de error
    echo "Error en la consulta SQL: " . $conexion->error;
  } else {
    if ($result->num_rows > 0) {
      // Si la clase ya existe, mostrar un mensaje de error y volver a intentarlo
      echo "La clase ya existe. Por favor, intenta con otro nombre de clase o habla con un administrador.";
      header("refresh:2;../usuarios/usuario_profe.php");
      exit();
    } else {
      // Insertar los datos de la nueva clase en la tabla "clases"
      $sql1 = "INSERT INTO clases (nombre, descripcion, id_profesor) VALUES ('$nombre','$descripcion', '$id_profesor')";
      if ($conexion->query($sql1) === TRUE) {
        // Mostrar un mensaje de éxito y redirigir al usuario a la página "panel_de_control.php"
        echo "clase creada con éxito.";
        header("refresh:2;../usuarios/usuario_profe.php");
        exit();
      } else {
        echo "Error al crear la clase : " . $conexion->error;
        header("refresh:2;../usuarios/usuario_profe.php");
      }
    }
  }
}
// Verificar si se insertó correctamente
$conexion->close();
?>