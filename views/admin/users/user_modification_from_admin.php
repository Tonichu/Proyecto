<?php
require_once(__DIR__ . "/../../../models/admin_models/user_model.php");


// Verificar si se ha enviado el ID del usuario a modificar
if (isset($_GET['id'])) {
    // Obtener el ID del usuario
    $idUsuario = $_GET['id'];
    
    // Crear una instancia del modelo UserModel
    $userModel = new UserModel();
    
    // Obtener los detalles del usuario por su ID
    $usuario = $userModel->getUserById($idUsuario);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar usuario</title>
</head>
<body>
  <h2>Modificar Usuario</h2>
  <?php if (isset($usuario)) :?>
    <form action="../../../controllers/admin_controller/user/user_modification.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $usuario['id_usuarios']; ?>">
      <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
      <p><strong>Apellido:</strong> <?php echo $usuario['apellidos']; ?></p>
      <p><strong>E-mail:</strong> <?php echo $usuario['correo_electronico']; ?></p>
      <label for="tipo_usuario">Tipo de usuario:</label>
      <select name="tipo_usuario">
        <option value="0" <?php if ($usuario['tipo_usuarios'] == 0) echo "selected"; ?>>admin</option>
        <option value="1" <?php if ($usuario['tipo_usuarios'] == 1) echo "selected"; ?>>profesor</option>
        <option value="2" <?php if ($usuario['tipo_usuarios'] == 2) echo "selected"; ?>>usuario</option>
      </select>
      <input type="submit" value="Guardar cambios">
    </form>
  <?php else : ?>
    <p>Error: ID de usuario no válido</p>
  <?php endif; ?>
  <a href="../admin_panel.php"><button>Cancelar</button></a>
</body>
</html>