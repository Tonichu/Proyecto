<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  session_start();
  require_once(__DIR__ . "/../controllers/role_controller.php");

  $roleController = new RoleController();
  $roleController->isTeacher($_SESSION);
  echo "Bienvenido a tu panel de profesor " . $_SESSION['nombre'];
  ?>

  <h1>Bienvenido teacher</h1>
</body>

</html>