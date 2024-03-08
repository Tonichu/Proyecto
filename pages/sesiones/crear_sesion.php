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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['id_clase']) && !empty($_POST['id_clase']) && isset($_POST['id_sala']) && !empty($_POST['id_sala'])) {
    $id_clase = $_POST['id_clase'];
    $id_sala = $_POST['id_sala'];
    $fecha_hora = $_POST['fecha_hora'];

    // Insertar la nueva sesión en la base de datos
    $sql = "INSERT INTO SESIONES (id_clases, id_salas, fecha_hora) VALUES ($id_clase, $id_sala, '$fecha_hora')";
    $result = $conexion->query($sql);

    if (!$result) {
      // Si hay un error en la consulta SQL, mostrar el mensaje de error
      echo "Error al crear la sesión: " . $conexion->error;
      header("refresh:2;../usuarios/panel_de_control.php");
    } else {
      // Mostrar un mensaje de éxito y redirigir al usuario a la página "panel_de_control.php"
      echo "Sesión creada con éxito.";
      header("refresh:2;../usuarios/panel_de_control.php");
      exit();
    }
  } else {
    echo "Por favor, completa todos los campos.";
    header("refresh:2;../usuarios/panel_de_control.php");
  }
}
?>