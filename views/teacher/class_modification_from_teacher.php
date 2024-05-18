<?php
session_start();
require_once (__DIR__ . "/../../models/teacher_models/class_model.php");
require_once (__DIR__ . "/../../controllers/role_controller.php");

// Verificar si se ha enviado el ID de la clase a modificar
$roleController = RoleController::getInstance();
$roleController->isTeacher($_SESSION);
$id_clases = $_GET['id'];

$classModel = new ClassModel();

$clase = $classModel->getClassById($id_clases);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Clase</title>
  <link rel="stylesheet" href="styles.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/teacher/class_modification_from_teacher.css">
</head>

<body>
  <div class="card-container">
    <div class="container card">
      <h2 class="card-title">Modificar Clase Existente</h2>
      <form action="../../controllers/teacher_controller/class/class_modification.php" method="POST">
        <input type="hidden" name="id_clases" value="<?php echo $clase['id_clases']; ?>">
        <input type="hidden" name="id_profesor" value="<?php echo $clase['id_profesor']; ?>">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" value="<?php echo $clase['nombre']; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción:</label>
          <textarea id="descripcion" name="descripcion"
            class="form-control"><?php echo $clase['descripcion']; ?></textarea>
        </div>
        <div class="button-container">
          <input type="submit" value="Guardar cambios" class="btn btn-primary">
          <a href="../teacher_panel.php" class="btn btn-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS (optional) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>