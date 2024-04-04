<?php
require_once(__DIR__ . "/../../controllers/admin_controller/class_controller.php");

// Verificar si se ha enviado el ID de la clase a modificar
if (isset($_GET['id'])) {
  // Obtener el ID de la clase
  $idClase = $_GET['id'];
  // Crear una instancia del controlador ClassController
  $classController = new ClassController();
}

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
</head>

<body>
  <h2>Modificar Clase</h2>
  <?php if (isset($clase)) : ?>

    <form action="../../controllers/admin_controller/class_modification.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $clase['id_clases']; ?>">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo $clase['nombre']; ?>"><br><br>
      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion"><?php echo $clase['descripcion']; ?></textarea><br><br>
      <label for="profesor">Profesor:</label>
      <select id="profesor" name="profesor">
        <?php
        // Obtener la lista de profesores
        foreach ($professors as $professor) {
          echo "<option value='" . $professor['id_usuarios'] . "'>" . $professor['nombre'] . " " . $professor['apellidos'] . "</option>";
        }
        ?>
      </select><br><br>
      <input type="submit" value="Guardar cambios">
    </form>
  <?php else : ?>
    <p>Error: ID de clase no válido</p>
  <?php endif; ?>
  <a href="../admin_panel.php"><button>Cancelar</button></a>
</body>

</html>