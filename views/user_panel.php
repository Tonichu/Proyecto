<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de usuario</title>
  <link rel="stylesheet" href="../public/css/user/user_profile.css" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
</head>

<body>

    <section class="user-profile-section">
      <div class="user-profile-header">
        <div class="user-profile-cover">
          <div class="user-profile-avatar">
            <img
              src="https://img.freepik.com/foto-gratis/chico-guapo-seguro-posando-contra-pared-blanca_176420-32936.jpg"
              alt="Foto de perfil"
            />
          </div>
        </div>
      </div>
      <div class="user-profile-body">
        <div class="user-profile-bio">
          <h3 class="title">Nombre y apellidos de la persona</h3>
        </div>
        <div class="user-profile-footer">
          <ul class="data-list">
            <li><i class="icon fas fa-envelope"></i> Correo electrónico:</li>
            <li><i class="icon fas fa-phone-alt"></i> Teléfono:</li>
            <li><i class="icon fas fa-map-signs"></i> Dirección de usuario:</li>
          </ul>
          <ul class="data-list">
            <li>juan@gmail.com</li>
            <li>659444586</li>
            <li>Madrid calle Tom</li>
          </ul>
        </div>
        <div class="social-media">
          <a href="https://www.facebook.com/" target="_blank"
            ><img src="librerias/iconos/facebook.png" alt="Facebook"
          /></a>
          <a href="https://twitter.com/?lang=es" target="_blank"
            ><img src="librerias/iconos/twitter.png" alt="Twitter"
          /></a>
          <a href="https://www.instagram.com/" target="_blank"
            ><img src="librerias/iconos/instagram.png" alt="Instagram"
          /></a>
        </div>
      </div>
    </section>

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