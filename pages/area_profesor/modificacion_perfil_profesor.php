<?php
session_start();
// Datos de conexión a la base de datos
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
usuarioProfesor();

$conexion = mysqli_connect($host, $user, $password, $database, $port);
// Comprobar si la conexión ha sido exitosa
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_SESSION['id_usuarios'];
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $telefono = $_POST["telefono"];
  $correo_electronico = $_POST["correo_electronico"];
  $direccion = $_POST["direccion"];
  $nueva_pass = $_POST["newPass"];
  $hash_pass = password_hash($nueva_pass, PASSWORD_DEFAULT);

  if (isset($_POST["newPass"]) && !empty($_POST["newPass"])) {
    // El campo "newPass" está definido y no está vacío
    // actualizamos campos + pass
    //la haseamos ^^
    $query = "UPDATE usuarios SET 
    nombre='$nombre', 
    apellidos='$apellidos', 
    telefono='$telefono', 
    correo_electronico='$correo_electronico', 
    direccion='$direccion',
    pass = '$hash_pass'
    WHERE id_usuarios=$id";
    $resultado = mysqli_query($conexion, $query);
  } else {
    // Actualizamos campos sin pass
    $query = "UPDATE usuarios SET 
   nombre='$nombre', 
   apellidos='$apellidos', 
   telefono='$telefono', 
   correo_electronico='$correo_electronico', 
   direccion='$direccion' 
   WHERE id_usuarios='$id'";
    $resultado = mysqli_query($conexion, $query);
  }

  if (!$resultado) {
    echo "Error al actualizar el nombre y tipo de usuario: " . mysqli_error($conexion);
  }
}
$_SESSION['nombre'] = $nombre;
echo "perfil modificado con éxito.";
header("refresh:2;../usuarios/usuario_profe.php");
mysqli_close($conexion);
exit;
// Cerrar la conexión a la base de datos
