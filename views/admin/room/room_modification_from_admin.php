<?php
session_start();
require_once(__DIR__ . "/../../../controllers/admin_controller/room/room_controller.php");
require_once(__DIR__ . "/../../../controllers/role_controller.php");

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);
require_once (__DIR__ . "/../../../controllers/admin_controller/room/room_controller.php");

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $roomController = new roomController();

  $room = $roomController->getRoomById($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Sala</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../public/css/admin/room/room_modification.css">
</head>

<body>
  <div class="card">
    <h2 class="text-center">Modificar Sala</h2>
    <?php if (isset($room)): ?>
      <form action="../../../controllers/admin_controller/room/room_modification.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $room['id_salas']; ?>">

        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $room['nombre']; ?>">
        </div>

        <div class="form-group">
          <label for="aforo">Aforo:</label>
          <input type="number" class="form-control" id="aforo" name="aforo" value="<?php echo $room['aforo']; ?>">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
      </form>
    <?php else: ?>
      <p class="text-danger">Error: ID de sala no válido</p>
    <?php endif; ?>
    <a href="../../../views/admin_panel.php" class="btn btn-secondary btn-block mt-3">Cancelar</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>