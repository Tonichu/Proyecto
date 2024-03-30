<?php
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
require_once(__DIR__ . "/../../Handlers/vuelta_index.php");

session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

$correo = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
$pass = $_POST['password'];

$sql = "SELECT * FROM USUARIOS WHERE correo_electronico = '$correo'";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
  // Usuario no encontrado en la base de datos
  echo $_SESSION['error_message'] = "Credenciales inválidas. Tu correo electrónico no esta dado de alta.";
  header("Location: $Primerapagina");
  exit;
} else {
  $usuario = mysqli_fetch_assoc($resultado);
  $hash = $usuario['pass'];
  $id = $usuario['id_usuarios'];
  $name = $usuario['nombre'];

  if (password_verify($pass, $hash)) {
    // Contraseña correcta
    $tipo_usuario = $usuario['tipo_usuarios'];
    switch ($tipo_usuario) {
      case 0: // Admin
        $pagina_redireccion = "panel_de_control.php";
        break;
      case 1: // Profesor
        $pagina_redireccion = "usuario_profe.php";
        break;
      case 2: // Usuario
        $pagina_redireccion = "usuario.php";
        break;
      default:
        echo $_SESSION['error_message'] = "Error: Tipo de usuario no válido.";
        header("Location: $Primerapagina");
        exit;
    }

    // Almacenar información de sesión y redirigir
    $_SESSION["nombre"] = $name;
    $_SESSION["tipo_usuarios"] = $tipo_usuario;
    $_SESSION["id_usuarios"] = $id;
    header("Location: $pagina_redireccion");
    exit;
  } else {
    // Contraseña incorrecta
    echo $_SESSION['error_message'] = "Credenciales inválidas.Tu contraseña es invalida.";
    header("Location: $Primerapagina");
    exit;
  }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>