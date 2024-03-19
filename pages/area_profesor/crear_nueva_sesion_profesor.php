<?php
session_start();
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
usuarioProfesor();

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

$id_clase = $_POST['id_clase'];
$id_sala = $_POST['id_sala'];
$fecha_hora_inicio = $_POST['fecha_hora_inicio'];
$fecha_hora_fin = $_POST['fecha_hora_fin'];
$id_profesor = $_POST['id_profesor'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['id_clase']) && !empty($_POST['id_clase']) && isset($_POST['id_sala']) && !empty($_POST['id_sala'])) {


    // Insertar la nueva sesión en la base de datos
    $sql = "INSERT INTO SESIONES (id_clases, id_salas, fecha_hora_inicio, fecha_hora_fin) VALUES ($id_clase, $id_sala, '$fecha_hora_inicio', '$fecha_hora_fin')";

    $result = $conexion->query($sql);

    if (!$result) {
      // Si hay un error en la consulta SQL, mostrar el mensaje de error
      echo "Error al crear la sesión: " . $conexion->error;
      header("refresh:2;../../usuarios/usuario_profe.php");
    } else {
      // Mostrar un mensaje de éxito y redirigir al usuario a la página "panel_de_control.php"
      $id_sesion = $conexion->insert_id;

      // Insertar una nueva fila en la tabla USUARIOS_SESIONES con el ID de sesión y el ID del profesor

      $sql_usuarios_sesiones = "INSERT INTO INSCRIPCIONES (id_sesion, id_usuario) VALUES ('$id_sesion', '$id_profesor')";

      if ($conexion->query($sql_usuarios_sesiones) === TRUE) {
        // Mostrar un mensaje de éxito
        echo "Sesión creada con éxito.";
        header("refresh:2;../usuarios/usuario_profe.php");
        $conexion->close();
        exit();
      } else {
        // Mostrar un mensaje de error si falla la inserción en USUARIOS_SESIONES
        echo "Error al crear la sesion " . $conexion->error;
        header("refresh:2;../usuarios/usuario_profe.php");
        $conexion->close();
        exit();
      }
      // Cerrar la conexión
      $conexion->close();
    }
  } else {
    echo "Por favor, completa todos los campos.";
    header("refresh:2;../usuarios/usuario_profe.php");
  }
}
