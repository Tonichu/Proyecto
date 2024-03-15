<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="../../Handlers/logout.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
  <?php
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_normal.php");
  usuarioNormal();
  echo "Bienvenido a tu panel " . $_SESSION['nombre'];
  require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
  $conexion = mysqli_connect($host, $user, $password, $database, $port);
  if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
  }
  $querySesionesDisponibles = "SELECT sesiones.id, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin, clases.nombre AS nombre_clase, salas.nombre AS nombre_sala 
  FROM sesiones 
  INNER JOIN clases ON sesiones.id_clases = clases.id_clases 
  INNER JOIN salas ON sesiones.id_salas = salas.id_salas";

  $resultSesiones = mysqli_query($conexion, $querySesionesDisponibles);

  if (mysqli_num_rows($resultSesiones) > 0) {
    // Mostrar formulario de inscripción PRUEBA
  ?>
  <h2>Calendario con clases</h2>
    <form action="" method="POST">
      <label for="sesion">Seleccione una sesión:</label>
      <select name="sesion" id="sesion">
        <?php
        while ($row = mysqli_fetch_assoc($resultSesiones)) {
          echo "<option value='" . $row['id'] . "'>" . $row['nombre_clase'] . " - " . $row['nombre_sala'] . " - " . $row['fecha_hora_inicio'] . " - " . $row['fecha_hora_fin'] . "</option>";
        }
        ?>
      </select>
      <input type="submit" value="Inscribirse">
    </form>
  <?php
  } else {
    echo "No hay sesiones disponibles actualmente.";
  }
  ?>
</body>

</html>