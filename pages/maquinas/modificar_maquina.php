<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar maquina</title>
</head>

<body>
  <h2>modificar maquina</h2>
  <?php
  // iniciamos la sesion
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
  usuarioAdmin();
  echo "Bienvenido " . $_SESSION['nombre'];
  // Si el usuario no ha iniciado sesión o es de otro tipo, redirigir a la página de inicio de sesión
  require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  // Si se recibió un ID de maquina válida, recuperar los datos de la maquina y mostrar el formulario de edición
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM maquinas WHERE id_maquina=$id";
    $resultado = mysqli_query($conexion, $query);
    $maquina = mysqli_fetch_assoc($resultado);
  ?>
    <form action="modificacion_maquina.php" method="post">

      <input name="id" hidden value="<?php echo $maquina['id_maquina']; ?>">

      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo $maquina['nombre']; ?>" required><br><br>

      <label for="foto">Foto de la maquina:</label>
      <input type="file" id="foto" name="foto"><br><br>

      <label for="descripcion">Descripción:</label>
      <input type="text" id="descripcion" name="descripcion" value="<?php echo $maquina['descripcion']; ?>" required><br><br>

      <label for="fecha_adquisicion">Fecha de adquisición:</label>
      <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" value="<?php echo $maquina['fecha_adquisicion']; ?>">

      <label for="ultima_revision">Última revisión:</label>
      <input type="date" id="ultima_revision" name="ultima_revision" value="<?php echo $maquina['ultima_revision']; ?>" >

      <label for="id_sala">Sala:</label>

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
          echo "<option value='' disabled>No hay salas disponibles</option>";        }
        ?>
      </select>
      <input type="submit" value="Enviar">
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