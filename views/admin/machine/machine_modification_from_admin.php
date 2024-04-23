<?php
session_start();
require_once(__DIR__ . "/../../../controllers/admin_controller/machine/machine_controller.php");
require_once(__DIR__ . "/../../../models/admin_models/room_model.php");
require_once(__DIR__ . "/../../../controllers/role_controller.php");

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);


// Verificar si se ha enviado el ID de la máquina a modificar
if (isset($_GET['id'])) {
  // Obtener el ID de la máquina
  $idMaquina = $_GET['id'];

  // Crear una instancia del controlador MachineController
  $machineController = new MachineController();

  // Obtener los detalles de la máquina por su ID
  $maquina = $machineController->getMachineById($idMaquina);
}
$roomModel = new roomModel();
$rooms = $roomModel->getRooms();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Máquina</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background-color: #f8f9fa;
    }

    .card {
      width: 400px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="card">
    <h2 class="text-center">Modificar Máquina</h2>
    <?php if (isset($maquina)): ?>
      <form action="../../../controllers/admin_controller/machine/machine_modification.php" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $maquina['id_maquina']; ?>">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $maquina['nombre']; ?>">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción:</label>
          <textarea class="form-control" id="descripcion"
            name="descripcion"><?php echo $maquina['descripcion']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="foto">Foto:</label>
          <input type="file" class="form-control-file" id="foto" name="foto">
        </div>
        <div class="form-group">
          <label for="fecha_adquisicion">Fecha de Adquisición:</label>
          <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion"
            value="<?php echo $maquina['fecha_adquisicion']; ?>">
        </div>
        <div class="form-group">
          <label for="ultima_revision">Última Revisión:</label>
          <input type="date" class="form-control" id="ultima_revision" name="ultima_revision"
            value="<?php echo $maquina['ultima_revision']; ?>">
        </div>
        <div class="form-group">
          <label for="sala">Sala:</label>
          <select class="form-control" id="sala" name="sala">
            <?php
            // Obtener la lista de salas
            foreach ($rooms as $room) {
              $selected = ($room['id_salas'] == $maquina['id_sala']) ? "selected" : "";
              echo "<option value='" . $room['id_salas'] . "' $selected>" . $room['nombre'] . " Aforo " . $room['aforo'] . "</option>";
            }
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
      </form>
    <?php else: ?>
      <p class="text-danger">Error: ID de máquina no válido</p>
    <?php endif; ?>
    <a href="../../../views/admin_panel.php" class="btn btn-secondary btn-block mt-3">Cancelar</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>