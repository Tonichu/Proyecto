<?php
session_start();
require_once (__DIR__ . "/../controllers/role_controller.php");
require_once (__DIR__ . "/../models/database.php");
require_once (__DIR__ . "/../models/teacher_models/teacher_queries.php");

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

$infoTeacher = $teacherQueries->getTeacherById($id_usuario);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Profesor</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+nWo9aS+yn4knpvKl5c4L3s5vfwsv5G4+1jOv8f" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/css/teacher/teacher_profile.css">
  <link rel="stylesheet" href="../public/css/user/user_profile.css" />
  <link rel="stylesheet" href="../public/css/user/time.css" />
  <script src="../public/js/teacher/validate_hours.js" defer></script>
</head>

<body>
  <div id="header">
    <div class="welcome-container">
      <h1>Bienvenido al Panel de Profesor <?php echo $_SESSION['nombre'] ?></h1>
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
          if (!empty($infoTeacher['foto'])) {
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
        <form action="../views/teacher/modify_teacher_data.php" method="post">
          <input type="submit" value="Modificar datos" class="btn btn-custom">
        </form>
      </div>
    </div>

    <div class="user-profile-body">
      <div class="user-profile-bio">
        <h3 class="title"><?php echo $infoTeacher['nombre'];
        echo " ";
        echo $infoTeacher['apellidos']; ?> </h3>
      </div>
      <div class="user-profile-footer">
        <ul class="data-list">
          <li><i class="icon fas fa-envelope"></i> Correo electrónico:</li>
          <li><i class="icon fas fa-phone-alt"></i> Teléfono:</li>
          <li><i class="icon fas fa-map-signs"></i> Dirección de usuario:</li>
        </ul>
        <ul class="data-list">
          <li><?php echo $infoTeacher['correo_electronico']; ?></li>
          <li><?php echo $infoTeacher['telefono']; ?></li>
          <li><?php echo $infoTeacher['direccion']; ?></li>
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
      <a href="calendar/calendarTeacher.php" class="btn btn-success"><button>Calendario profesor</button></a>
    </div>
  </section>

  <div class="container">
    <div class="container-fluid h-100">
      <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="card-title mb-4">Crear nueva clase</h2>
              <form action="../controllers/teacher_controller/class/new_class.php" method="post">
                <div class="form-group row">
                  <label for="nombre" class="col-sm-3 col-form-label font-weight-bold">Nombre:</label>
                  <div class="col-sm-9">
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="descripcion" class="col-sm-3 col-form-label font-weight-bold">Descripción:</label>
                  <div class="col-sm-9">
                    <input type="text" id="descripcion" name="descripcion" class="form-control" required>
                  </div>
                </div>
                <input type="hidden" id="id_profesor" name="id_profesor" value="<?php echo $id_usuario; ?>">
                <button type="submit" class="btn btn-primary btn-block">Crear nueva clase</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h2>Tus clases</h2>
    <?php
    // Verificar si hay clases para este profesor
    if ($resultClasses->rowCount() > 0) {
      ?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $resultClasses->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td>
                  <!-- Botón para eliminar la clase -->
                  <a href="../controllers/teacher_controller/class/delete_class.php?id=<?php echo $row['id_clases']; ?>"
                    class="btn btn-danger">Eliminar</a>
                  <!-- Botón para modificar la clase -->
                  <a href="../views/teacher/class_modification_from_teacher.php?id=<?php echo $row['id_clases']; ?>"
                    class="btn btn-primary">Modificar</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      <p>No tienes clases aún.</p>
    <?php } ?>


    <div class="container-fluid h-100">
      <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="card-title mb-4">Registro de nueva sesión</h2>
              <form action="../controllers/teacher_controller/sessions/new_session.php" id="form_sessions"
                method="post">
                <div class="form-group row">
                  <label for="id_clase" class="col-sm-3 col-form-label font-weight-bold">Clases:</label>
                  <div class="col-sm-9">
                    <select name="id_clase" id="id_clase" class="form-control">
                      <?php if ($resultClasses2->rowCount() > 0) { ?>
                        <?php while ($row = $resultClasses2->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?= $row['id_clases'] ?>"><?= $row['nombre'] ?></option>
                        <?php } ?>
                      <?php } else { ?>
                        <option value="" disabled>No hay clases disponibles</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_sala" class="col-sm-3 col-form-label font-weight-bold">Salas:</label>
                  <div class="col-sm-9">
                    <select name="id_sala" id="id_sala" class="form-control">
                      <?php if ($resultRooms->rowCount() > 0) { ?>
                        <?php while ($row = $resultRooms->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?= $row['id_salas'] ?>"><?= $row['nombre'] ?> (Aforo: <?= $row['aforo'] ?>)
                          </option>
                        <?php } ?>
                      <?php } else { ?>
                        <option value="" disabled>No hay salas disponibles</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <input type="hidden" id="id_profesor" name="id_profesor" value="<?= $id_usuario ?>">
                <div class="form-group row">
                  <label for="fecha_hora_inicio" class="col-sm-3 col-form-label font-weight-bold">Fecha y Hora de
                    Inicio:</label>
                  <div class="col-sm-9">
                    <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio" class="form-control"
                      required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fecha_hora_fin" class="col-sm-3 col-form-label font-weight-bold">Fecha y Hora de
                    Fin:</label>
                  <div class="col-sm-9">
                    <input type="datetime-local" id="fecha_hora_fin" name="fecha_hora_fin" class="form-control"
                      required>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>




    <h2>Tabla de sesiones</h2>
    <?php if ($resultInscription->rowCount() > 0) { ?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th>Nombre clase</th>
              <th>Nombre sala</th>
              <th>Hora de inicio</th>
              <th>Hora de fin</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $resultInscription->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['nombre_clase']; ?></td>
                <td><?php echo $row['nombre_sala']; ?></td>
                <td><?php echo $row['fecha_hora_inicio']; ?></td>
                <td><?php echo $row['fecha_hora_fin']; ?></td>
                <td>
                  <form action="../controllers/teacher_controller/sessions/delete_session.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                  <a href="../views/teacher/session_modification_from_teacher.php?id=<?php echo $row['id']; ?>"
                    class="btn btn-primary">Modificar</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      <p>No hay sesiones disponibles.</p>
    <?php } ?>

  </div>

  <div class="footer">
    <p id="frase-motivacional"></p>
  </div>
</body>

<script src="../public/js/user/time.js"></script>
<script src="../public/js/prices/motivationalQuotes.js"></script>

</html>