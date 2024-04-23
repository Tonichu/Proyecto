<?php
session_start();

require_once (__DIR__ . "/../../../controllers/role_controller.php");
require_once (__DIR__ . "/../../../models/admin_models/user_model.php");

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);

// Crear una instancia del modelo UserModel
$userModel = new UserModel();
$professors = $userModel->getProfessors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clase</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/admin/class/new_class.css">
</head>

<body>

    <div class="card">
        <h2 class="text-center">Registro de Clase</h2>
        <form action="../../../controllers/admin_controller/class/new_class.php" method="post"
            enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>

            <div class="form-group">
                <label for="profesor">Profesor:</label>
                <select class="form-control" id="profesor" name="profesor">
                    <?php
                    // Obtener la lista de profesores
                    foreach ($professors as $professor) {
                        echo "<option value='" . $professor['id_usuarios'] . "'>" . $professor['nombre'] . " " . $professor['apellidos'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>
        <a href="../../../views/admin_panel.php" class="btn btn-secondary btn-block mt-3">Cancelar</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>