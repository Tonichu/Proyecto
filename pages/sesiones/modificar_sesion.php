<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Sesión</title>
</head>

<body>
  <h2>Modificar Sesión</h2>
  <?php
  // iniciamos la sesion
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
  usuarioAdmin();
  echo "Bienvenido " . $_SESSION['nombre'];
  // Si el usuario no ha iniciado sesión o es de otro tipo, redirigir a la página de inicio de sesión

  require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  // Si se recibió un ID de sesión válida, recuperar los datos de la sesión y mostrar el formulario de edición
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM sesiones WHERE id=$id";
    $resultado = mysqli_query($conexion, $query);
    $sesion = mysqli_fetch_assoc($resultado);

  ?>
    <form action="modificando_sesion.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $sesion['id']; ?>">
      <label for="id_clase">Clase:</label>
      <select name="id_clase" id="id_clase">
        <?php
        // Consulta para obtener todas las clases
        $query_clases = "SELECT id_clases, nombre FROM clases";
        $result_clases = mysqli_query($conexion, $query_clases);

        // Iterar sobre los resultados y mostrar opciones en el menú desplegable
        while ($row = mysqli_fetch_assoc($result_clases)) {
          echo "<option value='" . $row['id_clases'] . "'";
          if ($row['id_clases'] == $sesion['id_clases']) {
            echo " selected";
          }
          echo ">" . $row['nombre'] . "</option>";
        }
        ?>
      </select>
      <br>
      <label for="id_sala">Sala:</label>
      <select name="id_sala" id="id_sala">
        <?php
        // Consulta para obtener todas las salas
        $query_salas = "SELECT id_salas, nombre FROM salas";
        $result_salas = mysqli_query($conexion, $query_salas);

        // Iterar sobre los resultados y mostrar opciones en el menú desplegable
        while ($row = mysqli_fetch_assoc($result_salas)) {
          echo "<option value='" . $row['id_salas'] . "'";
          if ($row['id_salas'] == $sesion['id_salas']) {
            echo " selected";
          }
          echo ">" . $row['nombre'] . "</option>";
        }
        ?>
      </select>
      <br>

      <label for="fecha_hora_inicio">Fecha y Hora de Inicio:</label>
      <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio" value="<?php echo date('Y-m-d\TH:i', strtotime($sesion['fecha_hora_inicio'])); ?>" required>
      <br>

      <label for="fecha_hora_fin">Fecha y Hora de Fin:</label>
      <input type="datetime-local" id="fecha_hora_fin" name="fecha_hora_fin" value="<?php echo date('Y-m-d\TH:i', strtotime($sesion['fecha_hora_fin'])); ?>" required>
      <br>

      <input type="submit" value="Guardar cambios">
    </form>
    <a href="../usuarios/panel_de_control.php"><button>Cancelar</button></a>
  <?php
  } else {
    // Si no se recibió un ID de sesión válido, mostrar un mensaje de error
    echo "<p>Error: ID de sesión no válido</p>";
  }
  ?>
</body>

</html>


