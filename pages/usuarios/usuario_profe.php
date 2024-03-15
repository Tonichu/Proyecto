<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php
  session_start();
  require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
  require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
  $conexion = mysqli_connect($host, $user, $password, $database, $port);
  if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
  }
  usuarioProfesor();
  $id_usuario = $_SESSION['id_usuarios'];

  $queryClases = "SELECT * from clases where id_profesor =$id_usuario";
  $queryClases2 = "SELECT * from clases where id_profesor =$id_usuario";
  $resultClases = mysqli_query($conexion, $queryClases);
  $resultClases2 = mysqli_query($conexion, $queryClases2);

  $querySesiones = "SELECT sesiones.id, clases.nombre AS nombre_clase, salas.nombre AS nombre_sala, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin 
  FROM sesiones 
  INNER JOIN clases ON sesiones.id_clases = clases.id_clases
  INNER JOIN salas ON sesiones.id_salas = salas.id_salas 
  WHERE clases.id_profesor =  $id_usuario";

  $resultSesiones = mysqli_query($conexion, $querySesiones);


  echo "Bienvenido al panel de Profesores " . $_SESSION['nombre'];
  ?>
  <form action="../../Handlers/logout.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
  <form action="../area_profesor/modificar_perfil_profesor.php" method="post">
    <input type="submit" value="Modificar datos">
  </form>

  <h2>Crear nueva clase</h2>
  <form action="../../pages/area_profesor/crear_clase_profesor.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br><br>

    <input type="hidden" id="id_profesor" name="id_profesor" value="<?php echo $id_usuario; ?>">

    <input type="submit" value="Crear nueva clase">
  </form>
  <h2>Tus clases</h2>
  <?php
  // Verificar si hay clases para este profesor
  if (mysqli_num_rows($resultClases) > 0) {
  ?>
    <table class="tabla">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Opciones</th>
      </tr>
      <?php while ($row = mysqli_fetch_assoc($resultClases)) { ?>
        <tr>
          <td><?php echo $row['id_clases']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['descripcion']; ?></td>
          <td>
            <!-- Botón para eliminar la clase -->
            <?php echo "<input type='hidden' name='id' value='" . $row['id_clases'] . "'>"; ?>
            <a href="../../pages/area_profesor/eliminar_clase_profesor.php?id=<?php echo $row['id_clases']; ?>"><button>Eliminar</button></a>
            <!-- Botón para modificar la clase -->
            <a href="../../pages/area_profesor/modificar_clase_profesor.php?id=<?php echo $row['id_clases']; ?>"><button>Modificar</button></a>
          </td>
        </tr>
      <?php } ?>
    </table>
  <?php } else { ?>
    <p>No tienes clases aún.</p>
  <?php } ?>
  <h2>Registro de nueva sesión</h2>
  <form action="../../pages/area_profesor/crear_nueva_sesion_profesor.php" method="post">
    <span>Clases</span>
    <select name="id_clase" id="id_clase">
      <?php

      // Verificar si hay resultados
      if (mysqli_num_rows($resultClases2) > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = mysqli_fetch_assoc($resultClases2)) {
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
      $query_salas = "SELECT id_salas, nombre, aforo FROM SALAS";
      $result_salas = mysqli_query($conexion, $query_salas);

      // Verificar si hay resultados
      if (mysqli_num_rows($result_salas) > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = mysqli_fetch_assoc($result_salas)) {
          // Imprimir una opción para cada sala
          echo "<option value='" . $row['id_salas'] . "'>" . $row['nombre'] . "  Aforo: " . $row['aforo'] . "" . "</option>";
        }
      } else {
        echo "<option value='' disabled>No hay salas disponibles</option>";
      }
      ?>
    </select>
    <input type="hidden" id="id_profesor" name="id_profesor" value="<?php echo $id_usuario; ?>">

    <label for="fecha_hora_inicio">Fecha y Hora de Inicio:</label>
    <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio" required>

    <label for="fecha_hora_fin">Fecha y Hora de Fin:</label>
    <input type="datetime-local" id="fecha_hora_fin" name="fecha_hora_fin" required><br>

    <input type="submit" value="Enviar">

  </form>
  <h2>Tabla de sesiones</h2>
  <table class="tabla">
    <tr>
      <th>ID</th>
      <th>Nombre clase</th>
      <th>Nombre sala</th>
      <th>Hora ---- Inicio</th>
      <th>Hora ---- Fin</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultSesiones)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nombre_clase']; ?></td>
        <td><?php echo $row['nombre_sala']; ?></td>
        <td><?php echo $row['fecha_hora_inicio']; ?></td>
        <td><?php echo $row['fecha_hora_fin']; ?></td>
        <td>
          <!-- Botón para eliminar la sesion -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
          <a href="../../pages/area_profesor/eliminar_sesion_profesor.php?id=<?php echo $row['id']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la sesion --> 
          <a href="../../pages/area_profesor/modificar_sesion_profesor.php?id=<?php echo $row['id']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <h2>Inscripción en sesión</h2>

<?php
// Obtener la conexión a la base de datos
require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Consulta para obtener todas las sesiones disponibles
$querySesionesDisponibles = "SELECT sesiones.id, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin, clases.nombre AS nombre_clase, salas.nombre AS nombre_sala 
                             FROM sesiones 
                             INNER JOIN clases ON sesiones.id_clases = clases.id_clases 
                             INNER JOIN salas ON sesiones.id_salas = salas.id_salas";

$resultSesiones = mysqli_query($conexion, $querySesionesDisponibles);

if (mysqli_num_rows($resultSesiones) > 0) {
  // Mostrar formulario de inscripción PRUEBA
  ?>
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
/*
EJEMPLO DE INSCRIPCION
<?php
session_start();

// Verificar si se ha enviado el formulario de inscripción
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sesion"])) {
    // Obtener el ID de sesión seleccionado por el usuario
    $id_sesion = $_POST["sesion"];

    // Obtener el ID del usuario actual (suponiendo que ya esté autenticado)
    $id_usuario = $_SESSION["id_usuarios"];

    // Insertar la inscripción del usuario en la sesión seleccionada
    require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
    $conexion = mysqli_connect($host, $user, $password, $database, $port);
    if (!$conexion) {
        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
    }

    $queryInscripcion = "INSERT INTO USUARIOS_SESIONES (id_sesion, id_usuario) VALUES ($id_sesion, $id_usuario)";
    if (mysqli_query($conexion, $queryInscripcion)) {
        echo "Inscripción exitosa.";
    } else {
        echo "Error al inscribirse en la sesión: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    // Redirigir si se intenta acceder directamente a este script sin enviar el formulario
    header("Location: formulario_inscripcion.php");
    exit;
}
?>

*/
// Cerrar la conexión
mysqli_close($conexion);
?>
</body>

</html>