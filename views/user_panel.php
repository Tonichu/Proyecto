<?php
session_start();
require_once (__DIR__ . "/../controllers/role_controller.php");
require_once (__DIR__ . "/../models/user_models/user_queries.php");

$id_usuario = $_SESSION['id_usuarios'];

$roleController = RoleController::getInstance();
$roleController->isUser($_SESSION);

$userQueries = new UserQueries();

$user = $userQueries->getUserById($id_usuario);
$UnenrolledSessions = $userQueries->getUnenrolledSessions($id_usuario);
$EnrolledSessions = $userQueries->getEnrolledSessions($id_usuario);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página del usuario</title>
  <link rel="stylesheet" href="../public/css/user/user_style.css" />
  <link rel="stylesheet" href="../public/css/user/user_profile.css" />
  <link rel="stylesheet" href="../public/css/user/time.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


  <!-- Enlaces a Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+nWo9aS+yn4knpvKl5c4L3s5vfwsv5G4+1jOv8f" crossorigin="anonymous">
</head>

<body>

  <div id="header">
    <div class="welcome-container">
      <h1>Bienvenido a tu panel<?php echo $_SESSION['nombre']; ?></h1>
    </div>
  </div>

  <section class="user-profile-section">

    <div class="user-profile-header">
      <div class="button-container modificacion">
        <form action="../controllers/logout_controller.php" method="post">
          <input type="submit" value="Cerrar sesión" class="btn btn-custom">
        </form>
      </div>
      <div class="user-profile-cover">
        <div class="user-profile-avatar">
          <?php
          // Verificar si la imagen del usuario está definida
          if (!empty($user['foto'])) {
            // Mostrar la imagen del usuario
            echo '<img src="data:image/jpeg;base64,' . base64_encode($user['foto']) . '" alt="Foto de perfil" />';
          } else {
            // Mostrar una imagen por defecto si no hay imagen de usuario
            echo '<img src="https://img.freepik.com/foto-gratis/chico-guapo-seguro-posando-contra-pared-blanca_176420-32936.jpg" alt="Foto de perfil" />';
          }
          ?>
        </div>
      </div>
      <div class="button-container modificacion">
        <form action="../views/user/modify_user_data.php" method="post">
          <input type="submit" value="Modificar datos" class="btn btn-custom">
        </form>
      </div>
    </div>

    <div class="user-profile-body">
      <div class="user-profile-bio">
        <h3 class="title"><?php echo $user['nombre'];
        echo " ";
        echo $user['apellidos']; ?> </h3>
      </div>
      <div class="user-profile-footer">
        <ul class="data-list">
          <li><i class="icon fas fa-envelope"></i> Correo electrónico:</li>
          <li><i class="icon fas fa-phone-alt"></i> Teléfono:</li>
          <li><i class="icon fas fa-map-signs"></i> Dirección de usuario:</li>
        </ul>
        <ul class="data-list">
          <li><?php echo $user['correo_electronico']; ?></li>
          <li><?php echo $user['telefono']; ?></li>
          <li><?php echo $user['direccion']; ?></li>
        </ul>
      </div>
      <div class="social-media">
        <a href="https://www.facebook.com/" target="_blank"><img src="../public/img/icons/facebook.png"
            alt="Facebook" /></a>
        <a href="https://twitter.com/?lang=es" target="_blank"><img src="../public/img/icons/twitter.png"
            alt="Twitter" /></a>
        <a href="https://www.instagram.com/" target="_blank"><img src="../public/img/icons/instagram.png"
            alt="Instagram" /></a>
      </div>
    </div>
  </section>

  <section class="reloj">
    <p id="time">--:--:--</p>
    <p id="date">---</p>
    <div class="button-container">
      <a href="games/minigames.php" class="btn btn-success"><button >Crush Gym</button></a>
      <a href="calendar/calendarUser.php" class="btn btn-success"><button >Calendario</button></a>
    </div>
  </section>

  <div id="content-wrapper" class="container">
    <div class="row">
      <h3>Clases disponibles para inscripción</h3>
      <table class="table tabla">
        <thead class="thead-dark">
          <tr>
            <th>Clase</th>
            <th>Sala</th>
            <th>Hora de inicio</th>
            <th>Hora de fin</th>
            <th>Profesor</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($UnenrolledSessions as $row) { ?>
            <tr>
              <td><?php echo $row['class_name']; ?></td>
              <td><?php echo $row['sala_name']; ?></td>
              <td><?php echo $row['fecha_hora_inicio']; ?></td>
              <td><?php echo $row['fecha_hora_fin']; ?></td>
              <td><?php echo $row['profesor_name']; ?></td>
              <td>
                <a href="../views/user/enroll_class.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Inscribirse
                  a la clase</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <h3>Clases a las que estoy inscrito</h3>
      <table class="table tabla">
        <thead class="thead-dark">
          <tr>
            <th>Clase</th>
            <th>Sala</th>
            <th>Hora de inicio</th>
            <th>Hora de fin</th>
            <th>Profesor</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($EnrolledSessions as $row) { ?>
            <tr>
              <td><?php echo $row['class_name']; ?></td>
              <td><?php echo $row['sala_name']; ?></td>
              <td><?php echo $row['fecha_hora_inicio']; ?></td>
              <td><?php echo $row['fecha_hora_fin']; ?></td>
              <td><?php echo $row['profesor_name']; ?></td>
              <td>
                <a href="../views/user/unenroll_class.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Cancelar
                  inscripción</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </div>

  <div class="footer">
    <p id="frase-motivacional"></p>
  </div>

</body>

<script src="../public/js/user/time.js"></script>
<script src="../public/js/prices/motivationalQuotes.js"></script>

</html>