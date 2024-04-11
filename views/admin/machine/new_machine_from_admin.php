<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Máquina</title>
</head>

<body>
  <?php
  session_start();

  require_once(__DIR__ . "/../../../controllers/role_controller.php");
  require_once(__DIR__ . "/../../../models/admin_models/room_model.php");

  $roleController = RoleController::getInstance();
  $roleController->isAdmin($_SESSION);

  $roomModel = new roomModel();
  $rooms = $roomModel->getRooms();
  ?>

  <h2>Registro de Máquina</h2>
  <form action="../../../controllers/admin_controller/machine/new_machine.php" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion"><br><br>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" value="null"><br><br>

    <label for="fecha_adquisicion">Fecha de Adquisición:</label>
    <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" required><br><br>

    <label for="ultima_revision">Última Revisión:</label>
    <input type="date" id="ultima_revision" name="ultima_revision" required><br><br>


    <label for="sala">Sala:</label>
    <select id="sala" name="sala">
      <?php
      // Obtener la lista de salas
      foreach ($rooms as $room) {
        echo "<option value='" . $room['id_salas'] . "'>" . $room['nombre'] ."  Aforo " . $room['aforo'] . "</option>";
    }
      ?>
    </select><br><br>

    <input type="submit" value="Registrar">
  </form>
  <a href="../../../views/admin_panel.php"><button>Cancelar</button></a>
</body>

</html>