<?php
// iniciamos la sesion
session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
usuarioAdmin();
// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión

require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);

if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['descripcion']) && !empty($_POST['descripcion']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
  $nombre_maquina = $_POST['nombre'];
  $descripcion_maquina = $_POST['descripcion'];
  $fecha_adquisicion = $_POST['fecha_adquisicion'];
  $ultima_revision = $_POST['ultima_revision'];
  $id_sala = $_POST['id_sala'];
  $id_maquina = $_POST['id'];

  // Insertar los datos de la maquina modificada en la tabla "maquinas"

  $query = "UPDATE maquinas SET id_maquina= '$id_maquina',nombre='$nombre_maquina', descripcion='$descripcion_maquina',fecha_adquisicion='$fecha_adquisicion',ultima_revision= '$ultima_revision',id_sala=$id_sala WHERE id_maquina='$id_maquina'";
  
  if (!$query) {
    die('Error en la consulta: ' . mysqli_error($conexion));
  }
  if ($conexion->query($query) === TRUE) {
    // Mostrar un mensaje de éxito y redirigir al usuario a la página "panel_de_control.php"
    echo "maquina modificada con éxito.";
    header("refresh:2;../usuarios/panel_de_control.php");
    exit();
  } else {
    echo "Error al modificar la maquina : " . $conexion->error;
    header("refresh:3;../usuarios/panel_de_control.php");
  }
}


// Verificar si se insertó correctamente
$conexion->close();
