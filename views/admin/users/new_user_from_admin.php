<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear usuario desde administrador</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../public/css/admin/user/new_user.css">
</head>

<body>
  <div class="card">
    <h2 class="card-title">Registro de Usuario</h2>
    <form action="../../../controllers/admin_controller/user/new_user.php" method="post" enctype="multipart/form-data">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required class="form-control">

      <label for="apellidos">Apellidos:</label>
      <input type="text" id="apellidos" name="apellidos" class="form-control">

      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono" class="form-control">

      <label for="correo">Correo Electrónico:</label>
      <input type="email" id="correo" name="correo" required class="form-control">

      <label for="direccion">Dirección:</label>
      <input type="text" id="direccion" name="direccion" class="form-control">

      <label for="pass">Contraseña:</label>
      <input type="password" id="pass" name="pass" class="form-control">

      <label for="pass1">Confirmar Contraseña:</label>
      <input type="password" id="pass1" name="pass1" class="form-control">

      <label for="tipo_usuario">Tipo de usuario:</label>
      <select id="tipo_usuario" name="tipo_usuario" class="form-control">
        <option value="2">Usuario</option>
        <option value="1">Profesor</option>
        <option value="0">Admin</option>
      </select>

      <label for="foto">Foto de Perfil:</label>
      <input type="file" id="foto" name="foto" class="form-control-file">

      <input type="submit" value="Registrar" class="btn btn-primary">
    </form>
    <a href="../../admin_panel.php" class="btn btn-secondary">Cancelar</a>
  </div>
</body>

</html>