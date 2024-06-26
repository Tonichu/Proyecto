<?php
require_once(__DIR__ . "/../../models/teacher_models/teacher_queries.php");
require_once(__DIR__ . "/../../models/database.php");
session_start();

$database = new Database();
$db = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id = $_SESSION['id_usuarios'];
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $telefono = $_POST["telefono"];
  $correo_electronico = $_POST["correo_electronico"];
  $direccion = $_POST["direccion"];
  $current_pass = $_POST["current_pass"];
  $new_pass = $_POST["new_pass"];
  $pass_confirm = $_POST["pass_confirm"];

  if (!empty($new_pass) && $new_pass === $pass_confirm) {
    // Hashear la nueva contraseña solo si es válida y coincide con la confirmación
    $hash_pass = password_hash($new_pass, PASSWORD_DEFAULT);
  } elseif (empty($new_pass)) {
    // Si no se proporciona una nueva contraseña, utiliza la contraseña actual del usuario
    $hash_pass = $current_pass;
  } else {
    // Si las contraseñas no coinciden, muestra un mensaje de error y sale del script
    echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
    exit();
  }
  
  // Crear una instancia de UserQueries
  $teacherQueries = new teacherQueries($db);

  // Actualizar el usuario
  $update_successful = $teacherQueries->updateTeacher($id, $nombre, $apellidos, $telefono, $correo_electronico, $direccion, $hash_pass);

  header("refresh:2;url=../../views/teacher_panel");

  $_SESSION['nombre'] = $nombre;

  // Verificar si la actualización fue exitosa
  if ($update_successful) {
    echo "Usuario actualizado correctamente.";
  } else {
    echo "Error al actualizar el usuario.";
  }
}
?>