<?php

require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
require_once(__DIR__ . "/../../Handlers/vueltaIndex.php");

session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
$correo = $_POST['Email'];
$pass = $_POST['password'];
/*$correo = mysqli_real_escape_string($conexion, $correo);
$pass = mysqli_real_escape_string($conexion, $pass);*/

$sql = "SELECT * FROM USUARIOS WHERE correo_electronico = '$correo'";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
  // El usuario no existe en la base de datos
  echo "El usuario no existe, recuerda que es gratis registrarse!";
  $Primerapagina;
  exit;
} else {
  // Si el usuario existe en la base de datos, comprobar la contraseña
  $usuario = mysqli_fetch_assoc($resultado);
  $hash = $usuario['pass'];
  $id = $usuario['id_usuarios'];
  $name = $usuario['nombre'];
  if (password_verify($pass, $hash)) {
    // La contraseña es correcta
    $tipo_usuario = $usuario['tipo_usuarios'];
    if ($tipo_usuario == 0) {
      // El usuario es de tipo admin (0)
      $_SESSION["nombre"] = $name;
      $_SESSION["tipo_usuarios"] = $tipo_usuario;
      $_SESSION["id_usuarios"] = $id;
      header("Location: panelDeControl.php");
      exit;
    } else if ($tipo_usuario == 1) {
      // El usuario es de tipo Profesor (1)
      $_SESSION["nombre"] = $name;
      $_SESSION["tipo_usuarios"] = $tipo_usuario;
      $_SESSION["id_usuarios"] = $id;
      header("Location: usuarioProfe.php");
      exit;
    } else if ($tipo_usuario == 2) {
      // El usuario es de tipo usuario registrado/alumno (2)
      $_SESSION["nombre"] = $name;
      $_SESSION["tipo_usuarios"] = $tipo_usuario;
      $_SESSION["id_usuarios"] = $id;
      header("Location: areaUsuario.php");
      exit;
    }
  } else {
    // La contraseña es incorrecta
    echo "La contraseña es incorrecta!";
    $Primerapagina;
    exit;
  }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
