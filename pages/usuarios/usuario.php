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
  <form action="../area_user/modificar_perfil_user.php" method="post">
    <input type="submit" value="Modificar datos">
  </form>
  <?php
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_normal.php");
  require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
  
  usuarioNormal();
  echo "Bienvenido a tu panel " . $_SESSION['nombre'];
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
      <th>Hora ---- Inicio</th>
      <th>Hora ---- Fin</th>
      <th>Profesor </th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultSesionesNoInscritas)) { ?>
      <tr>
        <td><?php echo $row['nombre_clase']; ?></td>
        <td><?php echo $row['nombre_sala']; ?></td>
        <td><?php echo $row['fecha_hora_inicio']; ?></td>
        <td><?php echo $row['fecha_hora_fin']; ?></td>
        <td><?php echo $row['nombre_profesor']; ?></td>
        <td>
          <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
          <!-- Botón para inscribirse en la clase -->
          <a href="../area_user/inscripcion_clase.php?id=<?php echo $row['id']; ?>"><button>Inscribirse a la clase</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>

  <h2>Clases a las que estoy inscrito</h2>
  <table class="tabla">
    <tr>
      <th>Clase</th>
      <th>Sala</th>
      <th>Hora ---- Inicio</th>
      <th>Hora ---- Fin</th>
      <th>Profesor </th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultSesionesInscritas)) { ?>
      <tr>
        <td><?php echo $row['nombre_clase']; ?></td>
        <td><?php echo $row['nombre_sala']; ?></td>
        <td><?php echo $row['fecha_hora_inicio']; ?></td>
        <td><?php echo $row['fecha_hora_fin']; ?></td>
        <td><?php echo $row['nombre_profesor']; ?></td>
        <td>
          <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
          <!-- Botón para inscribirse en la clase -->
          <a href="../area_user/cancelar_inscripcion.php?id=<?php echo $row['id']; ?>"><button>cancelar la inscripción a la clase</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>

</html>