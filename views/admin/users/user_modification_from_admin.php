<?php
<<<<<<< HEAD
session_start();
require_once(__DIR__ . "/../../../models/admin_models/user_model.php");
require_once(__DIR__ . "/../../../controllers/role_controller.php");
=======
require_once (__DIR__ . "/../../../models/admin_models/user_model.php");
>>>>>>> ac0acabf3f05a3439e08234f49fbfa628513151f

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);

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
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    
    .card {
      margin: auto;
      margin-top: 50px;
      max-width: 500px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
  <div class="card">
    <h2 class="text-center">Modificar Usuario</h2>
    <?php if (isset($usuario)): ?>
      <form action="../../../controllers/admin_controller/user/user_modification.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id_usuarios']; ?>">
        <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
        <p><strong>Apellido:</strong> <?php echo $usuario['apellidos']; ?></p>
        <p><strong>E-mail:</strong> <?php echo $usuario['correo_electronico']; ?></p>
        <label for="tipo_usuario">Tipo de usuario:</label>
        <select class="form-control" name="tipo_usuario">
          <option value="0" <?php if ($usuario['tipo_usuarios'] == 0)
            echo "selected"; ?>>admin</option>
          <option value="1" <?php if ($usuario['tipo_usuarios'] == 1)
            echo "selected"; ?>>profesor</option>
          <option value="2" <?php if ($usuario['tipo_usuarios'] == 2)
            echo "selected"; ?>>usuario</option>
        </select>
        <button type="submit" class="btn btn-primary btn-block mt-3">Guardar cambios</button>
      </form>
    <?php else: ?>
      <p class="text-danger">Error: ID de usuario no válido</p>
    <?php endif; ?>
    <a href="../../admin_panel.php" class="btn btn-secondary btn-block mt-3">Cancelar</a>
  </div>
</body>

</html>