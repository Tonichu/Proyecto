<?php
session_start();
require_once(__DIR__ . "/../../../controllers/admin_controller/class/class_controller.php");
require_once(__DIR__ . "/../../../controllers/role_controller.php");

require_once (__DIR__ . "/../../../controllers/admin_controller/class/class_controller.php");
// Verificar si se ha enviado el ID de la clase a modificar
if (isset($_GET['id'])) {
  // Obtener el ID de la clase
  $idClase = $_GET['id'];
}

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);

$classController = new ClassController();

$data = $classController->getViewData($idClase);
$professors = $data["professors"];
$clase = $data["class"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Clase</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../public/css/admin/class/classs_modification.css">
</head>

<body>
  <div class="card">
    <h2 class="text-center">Modificar Clase</h2>
    <?php if (isset($clase)): ?>
      <form action="../../../controllers/admin_controller/class/class_modification.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $clase['id_clases']; ?>">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $clase['nombre']; ?>">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción:</label>
          <textarea class="form-control" id="descripcion"
            name="descripcion"><?php echo $clase['descripcion']; ?></textarea>
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
        <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
      </form>
    <?php else: ?>
      <p class="text-danger">Error: ID de clase no válido</p>
    <?php endif; ?>
    <a href="../../admin_panel.php" class="btn btn-secondary mt-3">Cancelar</a>
  </div>

  <!-- jQuery y Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>