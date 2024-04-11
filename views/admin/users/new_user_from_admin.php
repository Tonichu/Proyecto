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
  
  require_once(__DIR__ . "/../../../controllers/role_controller.php");
  $roleController = RoleController::getInstance();
  $roleController->isAdmin($_SESSION);

  ?>
<h2>Registro de Usuario</h2>
<form action="../../../controllers/admin_controller/user/new_user.php" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos"><br><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono"><br><br>

    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" required><br><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion"><br><br>

    <label for="pass">Contraseña:</label>
    <input type="password" id="pass" name="pass"><br><br>

    <label for="pass1">Confirmar Contraseña:</label>
    <input type="password" id="pass1" name="pass1"><br><br>

    <label for="tipo_usuario">Tipo de usuario:</label>
      <select id="tipo_usuario" name="tipo_usuario">
        <option value="2">Usuario</option>
        <option value="1">Profesor</option>
        <option value="0">Admin</option>
      </select><br><br>

    <label for="foto">Foto de Perfil:</label>
    <input type="file" id="foto" name="foto"><br><br>

    <input type="submit" value="Registrar">
</form>
<a href="../../admin_panel.php"><button>Cancelar</button></a>
</body>
</html>