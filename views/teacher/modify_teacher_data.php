<?php
session_start();
require_once(__DIR__ . "/../../models/teacher_models/teacher_queries.php");
require_once(__DIR__ . "/../../models/database.php");

$id_usuario = $_SESSION['id_usuarios'];

$database = new Database();
$db = $database->getConnection();

$teacherQueries = new TeacherQueries($db);

$user = $teacherQueries->getTeacherById($id_usuario);

?>

<body>
  <h2>Modificar Usuario</h2>
  <form action="../../controllers/teacher_controller/teacher_modification.php" method="POST" enctype="multipart/form-data">

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>"><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo $user['apellidos']; ?>"><br>

    <label for="telefono">Teléfono:</label>
    <input type="tel" name="telefono" value="<?php echo $user['telefono']; ?>"><br>

    <label for="correo_electronico">Correo electrónico:</label>
    <input type="text" name="correo_electronico" value="<?php echo $user['correo_electronico']; ?>"><br>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $user['direccion']; ?>"><br>
    <input type="hidden" name="current_pass" value="<?php echo $user['pass']; ?>">

    <label for="new_pass">Nueva contraseña:</label>
    <input type="password" name="new_pass" value=""><br>

    <label for="pass_confirm">Confirmar nueva contraseña:</label>
    <input type="password" name="pass_confirm" value=""><br>

    <label for="foto">Foto:</label>
    <input type="file" name="foto">
    <!-- Por el momento la foto esta off -->

    <br><input type="submit" value="Guardar cambios">
  </form>

  <a href="../../views/teacher_panel.php"><button>Cancelar</button></a>
</body>