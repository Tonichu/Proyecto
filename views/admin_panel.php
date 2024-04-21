<?php
session_start();
require_once (__DIR__ . "/../controllers/role_controller.php");
require_once (__DIR__ . "/../models/database.php");
require_once (__DIR__ . "/../models/admin_models/admin_queries.php");

$roleController = RoleController::getInstance();
$roleController->isAdmin($_SESSION);

$database = new Database();
$db = $database->getConnection();

$adminQueries = new AdminQueries($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero_filas"])) {
  // Obtener el número de filas del formulario
  $numeroFilas = $_POST["numero_filas"];

  // Verificar si el número de filas es válido y llamar a setLimit si es así
  if (is_numeric($numeroFilas) && $numeroFilas >= 1 && $numeroFilas <= 10) {

    $adminQueries->setLimit($numeroFilas);

    // Redirigir a la página donde se muestra la lista de usuarios u otra acción
  } else {
    echo "Por favor ingrese un número válido entre 1 y 10.";
  }
}

$resultUser = $adminQueries->getAllUsers();
$resultClasses = $adminQueries->getAllClasses();
$resultRooms = $adminQueries->getAllRoom();
$resultMachines = $adminQueries->getAllMachines();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administrador</title>
  <link rel="stylesheet" href="../public/css/admin/administrator.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <div class="container">
    <h1 class="text-center titulo">Bienvenido al Panel de Administrador <?php echo $_SESSION['nombre'] ?></h1>
    <form action="../controllers/logout_controller.php" method="post" class="text-center">
      <input type="submit" value="Cerrar sesión de Administrador" class="btn btn-danger">
    </form>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="text-center">
      <div class="form-row align-items-center justify-content-center">
        <div class="col-auto">
          <label for="numero_filas" class="sr-only">Selecciona el número de filas que quieres ver (1-10):</label>
          <input type="number" id="numero_filas" name="numero_filas" min="1" max="10"
            class="form-control form-control-sm" style="width: 100%;">
        </div>
        <div class="col-auto">
          <button type="submit" name="mostrar" class="btn btn-primary">Mostrar</button>
        </div>
      </div>
    </form>
    <!-- Formulario de búsqueda -->
    <form method="post" action="../controllers/admin_controller/search/search_controller.php" class="text-center">
      <p>¿En qué tabla quieres buscar?</p>
      <div class="form-row align-items-center justify-content-center">
        <div class="col-auto">
          <select name="tabla" id="tabla" class="form-control">
            <option value="usuarios">Usuarios</option>
            <option value="clases">Clases</option>
            <option value="salas">Salas</option>
            <option value="maquinas">Máquinas</option>
          </select>
        </div>
        <div class="col-auto">
          <label for="busqueda" class="sr-only">Búsqueda por nombre:</label>
          <input type="text" id="busqueda" name="busqueda" class="form-control" placeholder="Búsqueda por nombre">
        </div>
        <div class="col-auto">
          <input type="submit" value="Buscar" class="btn btn-primary">
        </div>
      </div>
    </form>
    <!-- Tabla de Usuarios -->
    <h2 class="text-center">Usuarios</h2>
    <a href="admin/users/new_user_from_admin.php" class="btn btn-success mb-3">Crear nuevo usuario</a>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Tipo de usuario</th>
            <th>Teléfono</th>
            <th>Correo electrónico</th>
            <th>Dirección</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí va el contenido de la tabla de usuarios -->
          <?php while ($row = $resultUser->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><?php echo $row['nombre']; ?></td>
              <td><?php echo $row['apellidos']; ?></td>
              <td><?php
              if ($row['tipo_usuarios'] == 0) {
                echo 'Admin';
              } elseif ($row['tipo_usuarios'] == 1) {
                echo 'Profesor';
              } else {
                echo 'Usuario normal';
              }
              ?></td>
              <td><?php echo $row['telefono']; ?></td>
              <td><?php echo $row['correo_electronico']; ?></td>
              <td><?php echo $row['direccion']; ?></td>
              <td>
                <!-- Botones para eliminar y modificar el usuario -->
                <a href="../controllers/admin_controller/user/delete_user.php?id=<?php echo $row['id_usuarios']; ?>"
                  class="btn btn-danger">Eliminar</a>
                <a href="../views/admin/users/user_modification_from_admin.php?id=<?php echo $row['id_usuarios']; ?>"
                  class="btn btn-warning">Modificar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- Tabla de Clases -->
    <h2 class="text-center">Clases</h2>
    <a href="../views/admin/class/new_class_from_admin.php" class="btn btn-success mb-3">Crear nueva clase</a>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Profesor</th>
            <th>Email Profesor</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí va el contenido de la tabla de clases -->
          <?php while ($row = $resultClasses->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><?php echo $row['nombre']; ?></td>
              <td><?php echo $row['descripcion']; ?></td>
              <td><?php echo $row['nombre_profesor'] ?? ' Sin profesor'; ?></td>
              <td><?php echo $row['email_profesor'] ?? ' Sin Email'; ?></td>
              <td>
                <!-- Botones para eliminar y modificar la clase -->
                <a href="../controllers/admin_controller/class/delete_class.php?id=<?php echo $row['id_clases']; ?>"
                  class="btn btn-danger">Eliminar</a>
                <a href="../views/admin/class/class_modification_from_admin.php?id=<?php echo $row['id_clases']; ?>"
                  class="btn btn-warning">Modificar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- Tabla de Salas -->
    <h2 class="text-center">Salas</h2>
    <a href="../views/admin/room/new_room_from_admin.php" class="btn btn-success mb-3">Crear nueva sala</a>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Aforo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí va el contenido de la tabla de salas -->
          <?php while ($row = $resultRooms->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><?php echo $row['nombre']; ?></td>
              <td><?php echo $row['aforo']; ?></td>
              <td>
                <!-- Botones para eliminar y modificar la sala -->
                <a href="../controllers/admin_controller/room/delete_room.php?id=<?php echo $row['id_salas']; ?>"
                  class="btn btn-danger">Eliminar</a>
                <a href="../views/admin/room/room_modification_from_admin.php?id=<?php echo $row['id_salas']; ?>"
                  class="btn btn-warning">Modificar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- Tabla de Máquinas -->
    <h2 class="text-center">Máquinas</h2>
    <a href="../views/admin/machine/new_machine_from_admin.php" class="btn btn-success mb-3">Crear nueva Máquina</a>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha de adquisición</th>
            <th>Última revisión</th>
            <th>Sala en la que se encuentra</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí va el contenido de la tabla de máquinas -->
          <?php while ($row = $resultMachines->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><?php echo $row['nombre']; ?></td>
              <td><?php echo $row['descripcion']; ?></td>
              <td><?php echo $row['fecha_adquisicion']; ?></td>
              <td><?php echo $row['ultima_revision']; ?></td>
              <td><?php echo $row['nombre_sala']; ?></td>
              <td>
                <!-- Botones para eliminar y modificar la máquina -->
                <a href="../controllers/admin_controller/machine/delete_machine.php?id=<?php echo $row['id_maquina']; ?>"
                  class="btn btn-danger">Eliminar</a>
                <a href="../views/admin/machine/machine_modification_from_admin.php?id=<?php echo $row['id_maquina']; ?>"
                  class="btn btn-warning">Modificar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>