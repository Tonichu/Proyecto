<?php
session_start();
require_once (__DIR__ . "/../../librerias/utils/usuario_normal.php");
require_once (__DIR__ . "/../../ConexionBdd/conexion_bdd.php");

usuarioNormal();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../librerias/css/usuario/modificar_perfil_user.css">
  <title>Modificación datos usuario</title>
  <!-- Vinculo Bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container">

    <div id="header">
      <div>
        <span>Bienvenido
          <?php echo $_SESSION['nombre']; ?>. Va a modificar sus datos
        </span>
      </div>
    </div>

    <?php
    // Crear conexión a la base de datos
    $conexion = mysqli_connect($host, $user, $password, $database, $port);

    // Comprobar si la conexión ha sido exitosa
    if (!$conexion) {
      die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
    }
    // Si el usuario no ha iniciado sesión o es de otro tipo, redirigir a la página de inicio de sesión
    
    // Si se recibió un ID de usuario válido, recuperar los datos del usuario y mostrar el formulario de edición
    $id = $_SESSION['id_usuarios'];
    $query = "SELECT * FROM usuarios WHERE id_usuarios=$id";
    $resultado = mysqli_query($conexion, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    ?>

    <form action="modificacion_datos.php" method="POST" enctype="multipart/form-data" class="mt-3">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo $usuario['nombre']; ?>">
        <span id="nombre-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" class="form-control" value="<?php echo $usuario['apellidos']; ?>">
        <span id="apellidos-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" class="form-control" value="<?php echo $usuario['telefono']; ?>">
        <span id="telefono-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="correo_electronico">Correo electrónico:</label>
        <input type="text" name="correo_electronico" class="form-control"
          value="<?php echo $usuario['correo_electronico']; ?>">
        <span id="correo-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" class="form-control" value="<?php echo $usuario['direccion']; ?>">
        <span id="direccion-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="newPass">Nueva contraseña:</label>
        <input type="password" name="newPass" class="form-control" value="">
        <span id="pass-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="confirmNewPass">Confirmar nueva contraseña:</label>
        <input type="password" name="confirmNewPass" class="form-control" value="">
        <span id="confirm-pass-error" class="error"></span>
      </div>

      <div class="form-group">
        <label for="foto">Foto:</label>
        <input type="file" name="foto" class="form-control-file">
        <span id="foto-error" class="error"></span>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="../usuarios/usuario.php" class="btn btn-secondary">Cancelar</a>
      </div>

    </form>
  </div>

  <!-- Scripts de Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Verificación de datos con js -->
  <script src="../../librerias/javascript/modificar_perfil_user.js" defer></script>

</body>

</html>