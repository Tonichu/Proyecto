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
</head>

<body>
  <h2>Modificar Máquina</h2>
  <?php if (isset($maquina)) :
    //enctype="multipart/form-data" es para permitir la carga de archivos pero en controller la pongo en null ?>

    <form action="../../../controllers/admin_controller/machine/machine_modification.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $maquina['id_maquina']; ?>">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo $maquina['nombre']; ?>"><br><br>
      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion"><?php echo $maquina['descripcion']; ?></textarea><br><br>
      <label for="foto">Foto:</label>
      <input type="file" id="foto" name="foto"><br><br>
      <label for="fecha_adquisicion">Fecha de Adquisición:</label>
      <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" value="<?php echo $maquina['fecha_adquisicion']; ?>"><br><br>
      <label for="ultima_revision">Última Revisión:</label>
      <input type="date" id="ultima_revision" name="ultima_revision" value="<?php echo $maquina['ultima_revision']; ?>"><br><br>
      <label for="sala">Sala:</label>
      <select id="sala" name="sala">
        <?php
        // Obtener la lista de salas
        foreach ($rooms as $room) {
          $selected = ($room['id_salas'] == $maquina['id_sala']) ? "selected" : "";
          echo "<option value='" . $room['id_salas'] . "' $selected>" . $room['nombre'] . " Aforo " . $room['aforo'] . "</option>";
        }
        ?>
      </select><br><br>

      <input type="submit" value="Guardar cambios">
    </form>
  <?php else : ?>
    <p>Error: ID de máquina no válido</p>
  <?php endif; ?>
  <a href="../../../views/admin_panel.php"><button>Cancelar</button></a>
</body>

</html>