<?php
session_start();
require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin(); // solo acceso admin

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['descripcion']) && !empty($_POST['descripcion']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
  $nombre_maquina = $_POST['nombre'];
  $descripcion_maquina = $_POST['descripcion'];
  $fecha_adquisicion = $_POST['fecha_adquisicion'];
  $ultima_revision = $_POST['ultima_revision'];
  $id_sala = $_POST['id_sala'];

  // Insertar la nueva maquina en la base de datos
  // Verificar si la maquina existe estoy comparando con nombre
  $sql = "SELECT * FROM maquinas WHERE nombre='$nombre_maquina'";
  $result = $conexion->query($sql);
  if (!$result) {
    // Si hay un error en la consulta SQL, mostrar el mensaje de error
    echo "Error en la consulta SQL: " . $conexion->error;
  } else {
    if ($result->num_rows > 0) {
      // Si la maquina ya existe, mostrar un mensaje de error y volver a intentarlo
      echo "La maquina ya existe. Por favor, intenta con otro nombre de maquina o habla con un administrador.";
      header("refresh:4;../usuarios/panel_de_control.php");
      exit();
    } else {

      // Insertar los datos de la nueva maquina en la tabla "maquinas"
      $query = "INSERT INTO Maquinas (nombre, descripcion, fecha_adquisicion, ultima_revision, id_sala) 
      VALUES ('$nombre_maquina', '$descripcion_maquina', '$fecha_adquisicion', '$ultima_revision', $id_sala)";
      if ($conexion->query($query) === TRUE) {
        // Mostrar un mensaje de éxito y redirigir al usuario a la página "panel_de_control.php"
        echo "maquina creada con éxito.";
        header("refresh:2;../usuarios/panel_de_control.php");
        exit();
      } else {
        echo "Error al crear la maquina : " . $conexion->error;
        header("refresh:2;../usuarios/panel_de_control.php");
      }
    }
  }
}
// Verificar si se insertó correctamente
$conexion->close();
