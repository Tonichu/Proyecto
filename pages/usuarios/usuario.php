<?php
session_start();
require_once (__DIR__ . "/../../librerias/utils/usuario_normal.php");
require_once (__DIR__ . "/../../ConexionBdd/conexion_bdd.php");

usuarioNormal();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../librerias/css/usuario/usuario.css">
  <title>Página del usuario</title>
  <!-- Enlaces a Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+nWo9aS+yn4knpvKl5c4L3s5vfwsv5G4+1jOv8f" crossorigin="anonymous">
  <link rel="stylesheet" href="/../../librerias/css/usuario/usuario.css">

</head>

<body>
  <div id="content-wrapper">
    <div id="header">
      <div class="welcome-container">
        <h1>Bienvenido a tu panel
          <?php echo $_SESSION['nombre']; ?>
        </h1>
      </div>
      <div class="button-container">
        <form action="../../Handlers/logout.php" method="post">
          <input type="submit" value="Cerrar sesión" class="btn btn-custom">
        </form>
        <form action="../area_user/modificar_perfil_user.php" method="post">
          <input type="submit" value="Modificar datos" class="btn btn-custom">
        </form>
      </div>
    </div>



    <div class="container mt-5">
      <?php
      $id = $_SESSION['id_usuarios'];

      $conexion = mysqli_connect($host, $user, $password, $database, $port);
      if (!$conexion) {
        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
      }

      $querySesionesNoInscritas = "
    SELECT sesiones.id, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin, 
          clases.nombre AS nombre_clase, salas.nombre AS nombre_sala, 
          usuarios.nombre AS nombre_profesor
    FROM sesiones 
    INNER JOIN clases ON sesiones.id_clases = clases.id_clases 
    INNER JOIN salas ON sesiones.id_salas = salas.id_salas
    LEFT JOIN usuarios ON clases.id_profesor = usuarios.id_usuarios
    WHERE sesiones.id NOT IN (
        SELECT id_sesion
        FROM inscripciones
        WHERE id_usuario = $id
    )";

      $querySesionesInscritas = "
    SELECT sesiones.id, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin, 
          clases.nombre AS nombre_clase, salas.nombre AS nombre_sala, 
          usuarios.nombre AS nombre_profesor
    FROM sesiones 
    INNER JOIN clases ON sesiones.id_clases = clases.id_clases 
    INNER JOIN salas ON sesiones.id_salas = salas.id_salas
    LEFT JOIN usuarios ON clases.id_profesor = usuarios.id_usuarios
    INNER JOIN inscripciones ON sesiones.id = inscripciones.id_sesion
    WHERE inscripciones.id_usuario = $id
    ";

      $resultSesionesNoInscritas = mysqli_query($conexion, $querySesionesNoInscritas);
      $resultSesionesInscritas = mysqli_query($conexion, $querySesionesInscritas);
      ?>

      <h2>Clases disponibles</h2>
      <table class="tabla">
        <tr>
          <th>Clase</th>
          <th>Sala</th>
          <th>Hora de inicio</th>
          <th>Hora de fin</th>
          <th>Profesor</th>
          <th></th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultSesionesNoInscritas)) { ?>
          <tr>
            <td>
              <?php echo $row['nombre_clase']; ?>
            </td>
            <td>
              <?php echo $row['nombre_sala']; ?>
            </td>
            <td>
              <?php echo $row['fecha_hora_inicio']; ?>
            </td>
            <td>
              <?php echo $row['fecha_hora_fin']; ?>
            </td>
            <td>
              <?php echo $row['nombre_profesor']; ?>
            </td>
            <td>
              <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
              <!-- Botón para inscribirse en la clase -->
              <a href="../area_user/inscripcion_clase.php?id=<?php echo $row['id']; ?>" class="btn btn-custom">Inscribirse
                a
                la clase</a>
            </td>
          </tr>
        <?php } ?>
      </table>

      <h2>Clases a las que estoy inscrito</h2>
      <table class="tabla">
        <tr>
          <th>Clase</th>
          <th>Sala</th>
          <th>Hora de inicio</th>
          <th>Hora de fin</th>
          <th>Profesor</th>
          <th></th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultSesionesInscritas)) { ?>
          <tr>
            <td>
              <?php echo $row['nombre_clase']; ?>
            </td>
            <td>
              <?php echo $row['nombre_sala']; ?>
            </td>
            <td>
              <?php echo $row['fecha_hora_inicio']; ?>
            </td>
            <td>
              <?php echo $row['fecha_hora_fin']; ?>
            </td>
            <td>
              <?php echo $row['nombre_profesor']; ?>
            </td>
            <td>
              <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
              <!-- Botón para cancelar inscripción en la clase -->
              <a href="../area_user/cancelar_inscripcion.php?id=<?php echo $row['id']; ?>" class="btn btn-custom">Cancelar
                inscripción a la clase</a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-+6v8Ob9F2/cUWyFKeCXa7s3eWzd//O3dZRgyiK9xWRoCXY/zn2TFkg3tuLgXTx4V"
      crossorigin="anonymous"></script>
</body>

</html>