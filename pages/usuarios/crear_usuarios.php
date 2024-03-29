<?php

require_once(__DIR__."/../../ConexionBdd/conexion_bdd.php");

session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $direccion = $_POST['direccion'];
  $pass = $_POST['pass'];
  $tipo_usuario = $_POST['tipo_usuario'];
  // Insertar el nuevo usuario en la base de datos
  // Verificar si el usuario ya existe
  $sql = "SELECT * FROM USUARIOS WHERE correo_electronico='$correo'";
  $result = $conexion->query($sql);
  if (!$result) {
    // Si hay un error en la consulta SQL, mostrar el mensaje de error
    echo "Error en la consulta SQL: " . $conexion->error;
} else {
  if ($result->num_rows > 0) {
    // Si el usuario ya existe, mostrar un mensaje de error y volver a intentarlo
    echo "El usuario ya existe. Por favor, intenta con otro nombre de usuario o reinicia la contraseña.";
    header("refresh:2;formulario_nuevo_user");
  } else {
    // Crear un hash de la contraseña
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    // Insertar los datos del nuevo usuario en la tabla "USUARIO"
  
    $sql1 = "INSERT INTO usuarios (nombre, apellidos, telefono, correo_electronico, direccion, pass, tipo_usuarios, foto) VALUES ('$nombre','$apellidos','$telefono','$correo','$direccion','$pass_hash',$tipo_usuario,NULL)";
    if ($conexion->query($sql1) === TRUE) {
      // Mostrar un mensaje de éxito y redirigir al usuario a la página "index.php"
      echo "Usuario creado con éxito.";
      header("refresh:2;panel_de_control.php");
      exit();
    } else {
      echo "Error al crear usuario: " . $conexion->error;
      header("refresh:2;panel_de_control.php");
      exit();
    }
  }
}}
// Verificar si se insertó correctamente
$conexion->close();

?>