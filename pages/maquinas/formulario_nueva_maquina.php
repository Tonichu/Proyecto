<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nueva Máquina</title>
</head>

<body>
  <h2>Registro de nueva Máquina</h2>
  <form action="crear_maquina.php" method="post">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="foto">Foto de la maquina:</label>
    <input type="file" id="foto" name="foto"><br><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br><br>

    <label for="fecha_adquisicion">Fecha de adquisición:</label>
    <input type="date" id="fecha_adquisicion" name="fecha_adquisicion">

    <label for="ultima_revision">Última revisión:</label>
    <input type="date" id="ultima_revision" name="ultima_revision">

    <label for="id_sala">Sala:</label>

    <select name="id_sala" id="id_sala">
      <?php
      session_start();
      require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
      require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
      usuarioAdmin(); // solo acceso admin
      $conexion = mysqli_connect($host, $user, $password, $database, $port);
      if (!$conexion) {
        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
      }
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
    <input type="submit" value="Enviar">
  </form>
  <a href="../usuarios/panel_de_control.php"><button>Cancelar</button></a>
</body>

</html>