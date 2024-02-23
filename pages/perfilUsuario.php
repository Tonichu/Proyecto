<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuario</title>
</head>

<body>
  <h2>Editar Usuario</h2>
  <form action="usuarios/editar_usuario.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_usuario" value="1">
    <!-- Aquí se debe reemplazar "1" con el ID del usuario que estás editando -->

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="Nombre Actual del Usuario" required><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="Apellidos Actuales del Usuario" required><br><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" value="Teléfono Actual del Usuario"><br><br>

    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" value="Correo Electrónico Actual del Usuario" required><br><br>
    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" value="Dirección Actual del Usuario"><br><br>

    <label for="pass">Contraseña:</label>
    <input type="password" id="pass" name="pass" placeholder="Introduce una nueva contraseña"><br><br>

    <label for="foto">Foto de Perfil:</label>
    <input type="file" id="foto" name="foto"><br><br>

    <input type="submit" value="Guardar Cambios">
  </form>