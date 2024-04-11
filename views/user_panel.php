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
  require_once(__DIR__ . "/../models/user_models/user_queries.php");

  $id_usuario = $_SESSION['id_usuarios'];

  $roleController = RoleController::getInstance();
  $roleController->isUser($_SESSION);


  $userQueries = new UserQueries();
  $UnenrolledSessions = $userQueries->getUnenrolledSessions($id_usuario);
  $EnrolledSessions = $userQueries->getEnrolledSessions($id_usuario);

  echo "Bienvenido a tu panel " . $_SESSION['nombre'];
  ?>
  <form action="../controllers/logout_controller.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
  <form action="../views/user/modify_user_data.php" method="post">

    <input type="submit" value="Modificar datos">
  </form>
  <h2>Clases disponibles</h2>
  <table class="tabla">
    <tr>
      <th>Clase</th>
      <th>Sala</th>
      <th>Hora ---- Inicio</th>
      <th>Hora ---- Fin</th>
      <th>Profesor </th>
    </tr>
    <?php foreach ($UnenrolledSessions as $row) { ?>
      <tr>
        <td><?php echo $row['class_name']; ?></td>
        <td><?php echo $row['sala_name']; ?></td>
        <td><?php echo $row['fecha_hora_inicio']; ?></td>
        <td><?php echo $row['fecha_hora_fin']; ?></td>
        <td><?php echo $row['profesor_name']; ?></td>
        <td>
          <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
          <!-- Botón para inscribirse en la clase -->

          <a href="../views/user/enroll_class.php?id=<?php echo $row['id']; ?>"><button>Inscribirse a la clase</button></a>
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

    <?php foreach ($EnrolledSessions as $row) { ?>
      <tr>
        <td><?php echo $row['class_name']; ?></td>
        <td><?php echo $row['sala_name']; ?></td>
        <td><?php echo $row['fecha_hora_inicio']; ?></td>
        <td><?php echo $row['fecha_hora_fin']; ?></td>
        <td><?php echo $row['profesor_name']; ?></td>
        <td>
          <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
          <!-- Botón para inscribirse en la clase -->
          <a href="../views/user/unenroll_class.php?id=<?php echo $row['id']; ?>"><button>Cancelar la inscripción</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>
</body>

</html>