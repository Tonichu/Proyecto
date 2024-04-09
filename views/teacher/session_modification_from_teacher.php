<?php
session_start();
require_once(__DIR__ . "/../../models/teacher_models/session_model.php");
require_once(__DIR__ . "/../../models/database.php");
require_once(__DIR__ . "/../../models/teacher_models/teacher_queries.php");
require_once(__DIR__ . "/../../controllers/role_controller.php");

$id = $_GET['id'];

$roleController = RoleController::getInstance();
$roleController->isTeacher($_SESSION);

$database = new Database();
$db = $database->getConnection();

$teacherQueries = new TeacherQueries($db);
$resultClasses = $teacherQueries->getAllClasses();

$resultRooms = $teacherQueries->getAllRooms();

$sessionModel = new SessionModel();
$SessionByIdi = $sessionModel->getSessionById($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  
<form action="../../controllers/teacher_controller/sessions/session_modification.php" method="post">
    <!-- Campo oculto para pasar el ID -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <br>
    <span>Tus Clases disponibles</span>
    <select name="clase" id="clase">
    <?php
    // Verificar si hay clases disponibles
    if ($resultClasses->rowCount() > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = $resultClasses->fetch(PDO::FETCH_ASSOC)) {
            // Verificar si el ID de la clase coincide con el ID de la clase seleccionada en la sesión
            $selected = ($row['id_clases'] == $SessionByIdi['id_clases']) ? 'selected' : '';
    ?>
            <option value="<?php echo $row['id_clases']; ?>" <?php echo $selected; ?>><?php echo $row['nombre']; ?></option>
    <?php
        }
    } else {
    ?>
        <option value="" disabled>No hay clases disponibles</option>
    <?php
    }
    ?>
</select>
    <br><br><span>Salas</span>
    <select name="sala" id="sala">
    <?php
    // Verificar si hay salas disponibles
    if ($resultRooms->rowCount() > 0) {
        // Iterar sobre cada fila de resultados
        while ($row = $resultRooms->fetch(PDO::FETCH_ASSOC)) {
            // Verificar si el ID de la sala coincide con el ID de la sala seleccionada en la sesión
            $selected = ($row['id_salas'] == $SessionByIdi['id_salas']) ? 'selected' : '';
    ?>
            <option value="<?php echo $row['id_salas']; ?>" <?php echo $selected; ?>><?php echo $row['nombre'] . " Aforo: " . $row['aforo']; ?></option>
    <?php
        }
    } else {
    ?>
        <option value="" disabled>No hay salas disponibles</option>
    <?php
    }
    ?>
</select><br><br>
    <label for="fecha_hora_inicio">Fecha y hora de inicio:</label>
        <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio" value="<?php echo $SessionByIdi['fecha_hora_inicio']; ?>"><br><br>
        <label for="fecha_hora_fin">Fecha y hora de fin:</label>
        <input type="datetime-local" id="fecha_hora_fin" name="fecha_hora_fin" value="<?php echo $SessionByIdi['fecha_hora_fin']; ?>"><br><br>
        <input type="submit" value="Guardar cambios">
    </form>
</body>

</html>