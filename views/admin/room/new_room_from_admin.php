<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Clase</title>
</head>
<body>
<?php
session_start();

require_once(__DIR__ . "/../../../controllers/role_controller.php");

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);

?>
<h2>Registro de Sala nueva</h2>
<form action="../../../controllers/admin_controller/room/new_room.php" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br><br>

    <label for="aforo">aforo:</label>
    <input type="number" name="aforo" id="aforo">


    <input type="submit" value="Registrar">
</form>
<a href="../../../views/admin_panel.php"><button>Cancelar</button></a>
</body>
</html>