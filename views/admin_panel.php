<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administrador</title>
</head>

<body>
  <?php
  session_start();
  require_once(__DIR__ . "/../controllers/role_controller.php");
  require_once(__DIR__ . "/../models/database.php");
  require_once(__DIR__ . "/../models/admin_queries.php");

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

  <h1>Bienvenido al Panel de Administrador <?php echo $_SESSION['nombre'] ?></h1>
  <form action="../controllers/logout_controller.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="numero_filas">Selecciona el número de filas que quieres ver (1-10:)</label>
    <input type="number" id="numero_filas" name="numero_filas" min="1" max="10">
    <button type="submit" name="mostrar">Mostrar</button>
  </form>
  <h2>Tabla de Usuarios</h2>
  <a href="admin/new_user_from_admin.php"><button>Crear usuario</button></a>
  <table class="tabla">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Tipo de usuario</th>
      <th>Teléfono</th>
      <th>Correo electrónico</th>
      <th>Dirección</th>
      <th>Acciones</th>
    </tr>
    <?php while ($row = $resultUser->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td><?php echo $row['id_usuarios']; ?></td>
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
          <!-- Botón para eliminar el usuario -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id_usuarios'] . "'>"; ?>
          <a href="eliminar_usuario.php?id=<?php echo $row['id_usuarios']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar el usuario -->
          <a href="formulario_modificar_user.php?id=<?php echo $row['id_usuarios']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <h2>Tabla de Clases</h2>
  <a href="../clases/formulario_nuevo_clase.php"><button>Crear clases</button></a>
  <table class="tabla">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Profesor</th>
      <th>Email Profesor</th>
    </tr>
    <?php while ($row = $resultClasses->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td><?php echo $row['id_clases']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['descripcion']; ?></td>
        <td><?php echo $row['nombre_profesor'] ?? ' Sin profesor'; ?></td>
        <td><?php echo $row['email_profesor'] ?? ' Sin Email'; ?></td>
        <td>
          <!-- Botón para eliminar la clase -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id_clases'] . "'>"; ?>
          <a href="../clases/eliminar_clase.php?id=<?php echo $row['id_clases']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la clase -->
          <a href="../clases/modificar_clase.php?id=<?php echo $row['id_clases']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <h2>Tabla de Salas</h2>
  <a href="../salas/formulario_nueva_sala.html"><button>Crear sala</button></a>
  <table class="tabla">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Aforo</th>
    </tr>
    <?php while ($row = $resultRooms->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td><?php echo $row['id_salas']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['aforo']; ?></td>
        <td>
          <!-- Botón para eliminar la sala -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id_salas'] . "'>"; ?>
          <a href="../salas/eliminar_sala.php?id=<?php echo $row['id_salas']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la sala -->
          <a href="../salas/modificar_sala.php?id=<?php echo $row['id_salas']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <h2>Tabla de maquinas</h2>
  <a href="../maquinas/formulario_nueva_maquina.php"><button>Crear Máquina</button></a>
  <table class="tabla">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Fecha de adquisición</th>
      <th>Ultima revisión</th>
      <th>Sala en la que se encuentra</th>
    </tr>
    <?php while ($row = $resultMachines->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td><?php echo $row['id_maquina']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['descripcion']; ?></td>
        <td><?php echo $row['fecha_adquisicion']; ?></td>
        <td><?php echo $row['ultima_revision']; ?></td>
        <td><?php echo $row['nombre_sala']; ?></td>
        <td>
          <!-- Botón para eliminar la maquina -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id_maquina'] . "'>"; ?>
          <a href="../maquinas/eliminar_maquina.php?id=<?php echo $row['id_maquina']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la maquina -->
          <a href="../maquinas/modificar_maquina.php?id=<?php echo $row['id_maquina']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>

</html>