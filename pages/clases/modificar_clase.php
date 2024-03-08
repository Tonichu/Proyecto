<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Clase</title>
</head>

<body>
  <h2>modificar Clase</h2>
  <?php
  // iniciamos la sesion
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
  usuarioAdmin();
  echo "Bienvenido " . $_SESSION['nombre'];
  // Si el usuario no ha iniciado sesión o es de otro tipo, redirigir a la página de inicio de sesión
 

  require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  // Si se recibió un ID de clase válida, recuperar los datos de la clase y mostrar el formulario de edición
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM clases WHERE id_clases=$id";
    $resultado = mysqli_query($conexion, $query);
    $clase = mysqli_fetch_assoc($resultado);
  ?>

    <form action="modificacion_clase.php" method="POST">
      <input name="id" hidden value="<?php echo $clase['id_clases']; ?>">
      <label for="nombre">nombre:</label>
      <input type="text" name="nombre" value="<?php echo $clase['nombre']; ?>" required>
      
      <label for="descripcion">descripcion:</label>
      <input type="text" name="descripcion" value="<?php echo $clase['descripcion']; ?>" required>
      

      <input type="submit" value="Guardar cambios">
      </form>
      <a href="../usuarios/panel_de_control.php"><button>Cancelar</button></a>
    <?php
  } else {
    // Si no se recibió un ID de clase válido, mostrar un mensaje de error
    echo "<p>Error: ID de usuario no válido</p>";
  }
    ?>

   
</body>

</html>