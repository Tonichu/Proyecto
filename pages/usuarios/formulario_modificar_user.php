<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar usuario</title>
</head>

<body>
  <h2>modificar Usuario</h2>
  <?php
  // iniciamos la sesion
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
  usuarioAdmin();
  // Si el usuario no ha iniciado sesión o es de otro tipo, redirigir a la página de inicio de sesión


  require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  // Si se recibió un ID de usuario válido, recuperar los datos del usuario y mostrar el formulario de edición
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM usuarios WHERE id_usuarios=$id";
    $resultado = mysqli_query($conexion, $query);
    $usuario = mysqli_fetch_assoc($resultado);
  ?>

    <form action="modificacion_usuario.php" method="POST" enctype="multipart/form-data">

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <p> <strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
      <p><strong>Apellido:</strong> <?php echo $usuario['apellidos']; ?></p>
      <p><strong>E-mail:</strong> <?php echo $usuario['correo_electronico']; ?></p>

      <label for="tipo_usuario">Tipo de usuario:</label>
      <select name="tipo_usuario">
        <option value="0" <?php if ($usuario['tipo_usuarios'] == 0) echo "selected"; ?>>admin</option>
        <option value="1" <?php if ($usuario['tipo_usuarios'] == 1) echo "selected"; ?>>profesor</option>
        <option value="2" <?php if ($usuario['tipo_usuarios'] == 2) echo "selected"; ?>>usuario</option>
      </select>

      <input type="submit" value="Guardar cambios">
    </form>
  <?php
  } else {
    // Si no se recibió un ID de usuario válido, mostrar un mensaje de error
    echo "<p>Error: ID de usuario no válido</p>";
  }
  ?>
  <a href="panel_de_control.php"><button>Cancelar</button></a>

</body>

</html>