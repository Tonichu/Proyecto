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
require_once(__DIR__ . "/../../../models/admin_models/user_model.php");

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);

// Crear una instancia del modelo UserModel
$userModel = new UserModel();
$professors = $userModel->getProfessors();
?>
<h2>Registro de Clase</h2>
<form action="../../../controllers/admin_controller/class/new_class.php" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"></textarea><br><br>

    <label for="profesor">Profesor:</label>
    <select id="profesor" name="profesor">
        <?php
        // Obtener la lista de profesores
        
        foreach ($professors as $professor) {
            echo "<option value='" . $professor['id_usuarios'] . "'>" . $professor['nombre'] . " " . $professor['apellidos'] . "</option>";
        }
        ?>
    </select><br><br>

    <input type="submit" value="Registrar">
</form>
<a href="../../../views/admin_panel.php"><button>Cancelar</button></a>
</body>
</html>