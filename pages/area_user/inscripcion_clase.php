<?php

session_start();
require_once(__DIR__ . "/../../librerias/utils/usuario_normal.php");
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");

usuarioNormal();
echo "Bienvenido a tu panel " . $_SESSION['nombre'];

$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
$id_sesion = $_GET['id'];
$id_usuario = $_SESSION['id_usuarios'];

echo $id_usuario;
// Verificar si se ha enviado el formulario de inscripción
if ($_SERVER["REQUEST_METHOD"] == "GET") {


  // Insertar el registro de inscripción en la tabla USUARIOS_SESIONES
  $queryInscripcion = "INSERT INTO INSCRIPCIONES (id_sesion, id_usuario) VALUES ($id_sesion, $id_usuario)";

  if (mysqli_query($conexion, $queryInscripcion)) {
    echo "Te has inscrito a la sesión correctamente.";
    // Puedes redirigir al usuario a una página de confirmación o a otra página de tu aplicación
    header("Location: ../../pages/usuarios/usuario.php");
  } else {
    echo "Error al inscribirse a la sesión: " . mysqli_error($conexion);
  }
}
header("refresh:2;../usuarios/usuario.php");

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
exit();
?>