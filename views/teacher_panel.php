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
  require_once(__DIR__ . "/../controllers/role_controller.php");
  require_once(__DIR__ . "/../models/database.php");
  require_once(__DIR__ . "/../models/teacher_models/teacher_queries.php");

  $roleController = RoleController::getInstance();
  $roleController->isTeacher($_SESSION);

  $database = new Database();
  $db = $database->getConnection();

  $teacherQueries = new TeacherQueries($db);

  $resultClasses = $teacherQueries->getAllClasses();
  $resultClasses2 = $teacherQueries->getAllClasses();
  $resultRooms = $teacherQueries->getAllRooms();
  $resultInscription = $teacherQueries->inscriptionResult();

  $id_usuario = $_SESSION['id_usuarios'];

  echo "Bienvenido a tu panel de profesor " . $_SESSION['nombre'];

  ?>

  <h1>Bienvenido teacher</h1>
  <form action="../controllers/logout_controller.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>

  <form action="../area_profesor/modificar_perfil_profesor.php" method="post">
    <input type="submit" value="Modificar datos">
  </form>

  <h2>Crear nueva clase</h2>
  <form action="../controllers/teacher_controller/class/new_class.php" method="post">
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
  if ($resultClasses->rowCount() > 0) {
  ?>
    <table class="tabla">
      <tr>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Opciones</th>
      </tr>
      <?php while ($row = $resultClasses->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['descripcion']; ?></td>
          <td>
            <!-- Botón para eliminar la clase -->
            <input type='hidden' name='id' value='<?php echo $row['id_profesor']; ?>'>
            <a href="../controllers/teacher_controller/class/delete_class.php?id=<?php echo $row['id_clases']; ?>"><button>Eliminar</button></a>
            <!-- Botón para modificar la clase -->
            <a href="../views/teacher/class_modification_from_teacher.php?id=<?php echo $row['id_clases']; ?>"><button>Modificar</button></a>
          </td>
        </tr>
      <?php } ?>
    </table>
  <?php } else { ?>
    <p>No tienes clases aún.</p>
  <?php } ?>
  <h2>Registro de nueva sesión</h2>
  <form action="../controllers/teacher_controller/sessions/new_session.php" method="post">
    <span>Clases</span>
    <select name="id_clase" id="id_clase">
      <?php
      // Verificar si hay resultados
      if ($resultClasses2->rowCount() > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = $resultClasses2->fetch(PDO::FETCH_ASSOC)) {
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
      // Verificar si hay resultados
      if ($resultRooms->rowCount() > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = $resultRooms->fetch(PDO::FETCH_ASSOC)) {
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
      <th>Nombre clase</th>
      <th>Nombre sala</th>
      <th>Hora ---- Inicio</th>
      <th>Hora ---- Fin</th>
    </tr>

    <?php while ($row = $resultInscription->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td><?php echo $row['nombre_clase']; ?></td>
        <td><?php echo $row['nombre_sala']; ?></td>
        <td><?php echo $row['fecha_hora_inicio']; ?></td>
        <td><?php echo $row['fecha_hora_fin']; ?></td>
        <td>
          <!-- Botón para eliminar la sesion -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
          <a href="../controllers/teacher_controller/sessions/delete_session.php?id=<?php echo $row['id']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la sesion -->
          <a href="../views/teacher/session_modification_from_teacher.php?id=<?php echo $row['id']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>

</html>