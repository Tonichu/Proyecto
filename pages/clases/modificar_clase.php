<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Clase</title>
</head>

<body>
  <h2>Modificar Clase</h2>
  <?php
  // Iniciamos la sesión
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
  usuarioAdmin();
  echo "Bienvenido " . $_SESSION['nombre'];

  // Si el usuario no ha iniciado sesión o es de otro tipo, redirigir a la página de inicio de sesión

  require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  // Si se recibió un ID de clase válido, recuperar los datos de la clase y mostrar el formulario de edición
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT clases.*, u1.id_usuarios AS id_profesor, u1.nombre AS nombre_profesor 
              FROM clases 
              LEFT JOIN usuarios u1 ON clases.id_profesor = u1.id_usuarios
              WHERE id_clases=$id";
    $resultado = mysqli_query($conexion, $query);
    $clase = mysqli_fetch_assoc($resultado);
  ?>

    <form action="modificacion_clase.php" method="POST">
      <input name="id" hidden value="<?php echo $clase['id_clases']; ?>">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" value="<?php echo $clase['nombre']; ?>" required>
      
      <label for="descripcion">Descripción:</label>
      <input type="text" name="descripcion" value="<?php echo $clase['descripcion']; ?>" required>
      
      <label for="id_profesor">Profesor:</label>
      <select name="id_profesor">
        <option value="">Sin profesor</option>
        <?php
        // Consulta para obtener todos los profesores
        $queryProfesores = "SELECT id_usuarios, nombre FROM usuarios WHERE tipo_usuarios = 1";
        $resultProfesores = mysqli_query($conexion, $queryProfesores);
        // Iterar sobre los resultados y mostrar opciones en el menú desplegable
        while ($row = mysqli_fetch_assoc($resultProfesores)) {
          echo "<option value='" . $row['id_usuarios'] . "'";
          // Marcar como seleccionado el profesor actual de la clase
          if ($row['id_usuarios'] == $clase['id_profesor']) {
            echo " selected";
          }
          echo ">" . $row['nombre'] . "</option>";
        }
        ?>
      </select>
      
      <input type="submit" value="Guardar cambios">
    </form>
    <a href="../usuarios/panel_de_control.php"><button>Cancelar</button></a>
  <?php
  } else {
    // Si no se recibió un ID de clase válido, mostrar un mensaje de error
    echo "<p>Error: ID de clase no válido</p>";
  }
  ?>
</body>

</html>