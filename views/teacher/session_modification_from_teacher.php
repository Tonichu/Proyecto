<?php
session_start();
require_once (__DIR__ . "/../../models/teacher_models/session_model.php");
require_once (__DIR__ . "/../../models/database.php");
require_once (__DIR__ . "/../../models/teacher_models/teacher_queries.php");
require_once (__DIR__ . "/../../controllers/role_controller.php");

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
    <!-- Agregar Bootstrap (puedes cambiar la URL según tu configuración) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/teacher/session_modification_from_teacher.css">
</head>

<body>
    <div class="card">
        <h2 class="card-title">Modificar Sesión</h2>
        <form action="../../controllers/teacher_controller/sessions/session_modification.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="clase">Tus Clases disponibles</label>
                <select name="clase" id="clase" class="form-control">
                    <?php
                    if ($resultClasses->rowCount() > 0) {
                        while ($row = $resultClasses->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['id_clases'] == $SessionByIdi['id_clases']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $row['id_clases']; ?>" <?php echo $selected; ?>>
                                <?php echo $row['nombre']; ?>
                            </option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="" disabled>No hay clases disponibles</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sala">Salas</label>
                <select name="sala" id="sala" class="form-control">
                    <?php
                    if ($resultRooms->rowCount() > 0) {
                        while ($row = $resultRooms->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['id_salas'] == $SessionByIdi['id_salas']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $row['id_salas']; ?>" <?php echo $selected; ?>>
                                <?php echo $row['nombre'] . " Aforo: " . $row['aforo']; ?>
                            </option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="" disabled>No hay salas disponibles</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_hora_inicio">Fecha y hora de inicio:</label>
                <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio"
                    value="<?php echo $SessionByIdi['fecha_hora_inicio']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha_hora_fin">Fecha y hora de fin:</label>
                <input type="datetime-local" id="fecha_hora_fin" name="fecha_hora_fin"
                    value="<?php echo $SessionByIdi['fecha_hora_fin']; ?>" class="form-control">
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="../teacher_panel.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>