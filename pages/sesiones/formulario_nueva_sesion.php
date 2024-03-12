<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nueva sesión</title>
</head>

<body>
  <h2>Registro de nueva sesión</h2>
  <form action="crear_sesion.php" method="post">
    <span>Clases</span>
    <select name="id_clase" id="id_clase">
      <?php
      session_start();
      require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
      require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
      usuarioAdmin(); // solo acceso admin
      $conexion = mysqli_connect($host, $user, $password, $database, $port);
      if (!$conexion) {
        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
      }
      // Consulta para obtener las clases existentes de la base de datos
      $query_clases = "SELECT id_clases, nombre FROM CLASES";
      $result_clases = mysqli_query($conexion, $query_clases);

      // Verificar si hay resultados
      if (mysqli_num_rows($result_clases) > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = mysqli_fetch_assoc($result_clases)) {
          // Imprimir una opción para cada clase
          echo "<option value='" . $row['id_clases'] . "'>" . $row['nombre'] . "</option>";
        }
      } else {
        echo "<option value='' disabled>No hay clases disponibles</option>";
      }
      ?>
    </select>
    <span>Salas</span>
    <select name="id_sala" id="id_sala">
      <?php
      // Consulta para obtener las salas existentes de la base de datos
      $query_salas = "SELECT id_salas, nombre FROM SALAS";
      $result_salas = mysqli_query($conexion, $query_salas);

      // Verificar si hay resultados
      if (mysqli_num_rows($result_salas) > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = mysqli_fetch_assoc($result_salas)) {
          // Imprimir una opción para cada sala
          echo "<option value='" . $row['id_salas'] . "'>" . $row['nombre'] . "</option>";
        }
      } else {
        echo "<option value='' disabled>No hay salas disponibles</option>";
      }
      ?>
    </select>


    <label for="fecha_hora_inicio">Fecha y Hora de Inicio:</label>
    <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio" required>

    <label for="fecha_hora_fin">Fecha y Hora de Fin:</label>
    <input type="datetime-local" id="fecha_hora_fin" name="fecha_hora_fin" required><br>

    <input type="submit" value="Enviar">

  </form>
  <a href="../usuarios/panel_de_control.php"><button>Cancelar</button></a>
</body>

</html>