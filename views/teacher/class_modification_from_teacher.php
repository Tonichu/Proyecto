<?php
require_once(__DIR__ . "/../../models/teacher_models/class_model.php");

// Verificar si se ha enviado el ID de la clase a modificar

$idClase = $_GET['id'];

$classModel = new ClassModel();

$clase = $classModel->getClassById($idClase);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="../../controllers/teacher_controller/class/class_modification.php" method="POST">
    <input type="hidden" name="id_clases" value="<?php echo $clase['id_clases']; ?>">
    <input type="hidden" name="id_profesor" value="<?php echo $clase['id_profesor']; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $clase['nombre']; ?>"><br><br>
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"><?php echo $clase['descripcion']; ?></textarea><br><br>

    <input type="submit" value="Guardar cambios">
  </form>
</body>

</html>