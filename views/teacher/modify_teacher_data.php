<?php
session_start();
require_once(__DIR__ . "/../../models/teacher_models/teacher_queries.php");
require_once(__DIR__ . "/../../models/database.php");
require_once(__DIR__ . "/../../controllers/role_controller.php");

// Verificar si se ha enviado el ID de la clase a modificar
$roleController = RoleController::getInstance();
$roleController->isTeacher($_SESSION);

$id_usuario = $_SESSION['id_usuarios'];

$database = new Database();
$db = $database->getConnection();

$teacherQueries = new TeacherQueries($db);

$user = $teacherQueries->getTeacherById($id_usuario);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar usuario profesor</title>
  <link rel="stylesheet" href="../../public/css/teacher/modify_teacher_profile.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>



<body>


  <div class="container">

    <div id="header">
      <div>
        <span>Bienvenido
          <?php echo $_SESSION['nombre']; ?>. Va a modificar sus datos
        </span>
      </div>
    </div>

    <form action="../../controllers/teacher_controller/teacher_modification.php" method="POST" enctype="multipart/form-data" class="mt-3">

      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo $user['nombre']; ?>">
        <span id="nombre-error" class="error"></span>
      </div>


      <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" class="form-control" value="<?php echo $user['apellidos']; ?>">
        <span id="apellidos-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" class="form-control" value="<?php echo $user['telefono']; ?>">
        <span id="telefono-error" class="error"></span>
      </div>


      <div class="form-group">
        <label for="correo_electronico">Correo electrónico:</label>
        <input type="text" name="correo_electronico" class="form-control" value="<?php echo $user['correo_electronico']; ?>">
        <span id="correo-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" class="form-control" value="<?php echo $user['direccion']; ?>">
        <span id="direccion-error" class="error"></span>
      </div>


      <input type="hidden" name="current_pass" value="<?php echo $user['pass']; ?>">


      <div class="form-group">
        <label for="new_pass">Nueva contraseña:</label>
        <input type="password" name="new_pass" class="form-control" value="">
        <span id="pass-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="pass_confirm">Confirmar nueva contraseña:</label>
        <input type="password" name="pass_confirm" class="form-control" value="">
        <span id="confirm-pass-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="foto">Foto:</label>
        <input type="file" name="foto" class="form-control-file">
        <span id="foto-error" class="error"></span>
      </div>
      <!-- Por el momento la foto esta off -->

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="../../views/teacher_panel.php" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>

 <!-- Scripts de Bootstrap (opcional) -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Verificación de datos con js -->
  <script src="../../public/js/teacher/modify_teacher_profile.js" defer></script>

</body>

</html>