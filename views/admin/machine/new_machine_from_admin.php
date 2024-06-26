<?php
session_start();

require_once (__DIR__ . "/../../../controllers/role_controller.php");
require_once (__DIR__ . "/../../../models/admin_models/room_model.php");

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);

$roomModel = new roomModel();
$rooms = $roomModel->getRooms();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Máquina</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../public/css/admin/machine/new_machine.css">
</head>

<body>
  <div class="card">
    <h2 class="text-center">Registro de Máquina</h2>
    <form action="../../../controllers/admin_controller/machine/new_machine.php" method="post"
      enctype="multipart/form-data">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion">
      </div>

      <div class="form-group">
        <label for="foto">Foto:</label>
        <input type="file" class="form-control-file" id="foto" name="foto" value="null">
      </div>

      <div class="form-group">
        <label for="fecha_adquisicion">Fecha de Adquisición:</label>
        <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" required>
      </div>

      <div class="form-group">
        <label for="ultima_revision">Última Revisión:</label>
        <input type="date" class="form-control" id="ultima_revision" name="ultima_revision" required>
      </div>

      <div class="form-group">
        <label for="sala">Sala:</label>
        <select class="form-control" id="sala" name="sala">
          <?php
          // Obtener la lista de salas
          foreach ($rooms as $room) {
            echo "<option value='" . $room['id_salas'] . "'>" . $room['nombre'] . "  Aforo " . $room['aforo'] . "</option>";
          }
          ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Registrar</button>
    </form>
    <a href="../../../views/admin_panel.php" class="btn btn-secondary btn-block mt-3">Cancelar</a>
  </div>



  </form>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>