<?php
require_once(__DIR__ . "/../../controllers/admin_controller/room_controller.php");

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
</head>

<body>
  <h2>Modificar Sala</h2>
  <?php if (isset($room)) : ?>

    <form action="../../controllers/admin_controller/room_modification.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $room['id_salas']; ?>">

      <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $room['nombre']; ?>"><br><br>

    <label for="aforo">aforo:</label>
    <input type="number" name="aforo" id="aforo" value="<?php echo $room['aforo']; ?>">

   
      <input type="submit" value="Guardar cambios">
    </form>
  <?php else : ?>
    <p>Error: ID de sala no válido</p>
  <?php endif; ?>
  <a href="../admin_panel.php"><button>Cancelar</button></a>
</body>

</html>