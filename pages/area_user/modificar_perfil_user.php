<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<h2>Modificar datos</h2>
  <?php
  // iniciamos la sesion
  session_start();
  // Datos de conexión a la base de datos

  require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
   require_once(__DIR__ . "/../../librerias/utils/usuario_normal.php");
   usuarioNormal(); // solo acceso profesor
  // Crear conexión a la base de datos
  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  // Comprobar si la conexión ha sido exitosa
  if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
  }
  echo "Bienvenido " . $_SESSION['nombre'];
  // Si el usuario no ha iniciado sesión o es de otro tipo, redirigir a la página de inicio de sesión

  // Si se recibió un ID de usuario válido, recuperar los datos del usuario y mostrar el formulario de edición
  $id = $_SESSION['id_usuarios'];
  $query = "SELECT * FROM usuarios WHERE id_usuarios=$id";
  $resultado = mysqli_query($conexion, $query);
  $usuario = mysqli_fetch_assoc($resultado);
  ?>
  <form action="modificacion_datos.php" method="POST" enctype="multipart/form-data">

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo $usuario['apellidos']; ?>"><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>"><br>

    <label for="correo_electronico">Correo electrónico:</label>
    <input type="text" name="correo_electronico" value="<?php echo $usuario['correo_electronico']; ?>"><br>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $usuario['direccion']; ?>"><br>

    <label for="pass">Nueva contraseña:</label>
    <input type="password" name="newPass" value=""><br>

    <label for="pass">Confirmar nueva contraseña:</label>
    <input type="password" name="newPass" value=""><br>

    <label for="foto">Foto:</label>
    <input type="file" name="foto">
    <!-- Aquí puedes añadir el campo para la foto si lo necesitas -->

    <br><input type="submit" value="Guardar cambios">
  </form>
  <a href="../usuarios/usuario.php"><button>Cancelar</button></a>

</body>
</body>
</html>