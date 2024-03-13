<?php
require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
session_start();
usuarioAdmin();
$tipo_usuario = $_SESSION["tipo_usuarios"];
$id_usuarios = $_SESSION["id_usuarios"];
$conexion = mysqli_connect($host, $user, $password, $database, $port);

// Verifica si el tipo de usuario es 0 (admin)
echo "Bienvenido al panel de administrador " . $_SESSION['nombre'];

// Crear conexión a la base de datos
$conexion = mysqli_connect($host, $user, $password, $database, $port);

// Consulta para obtener los profesores
$queryProfesores = "SELECT id_usuarios, nombre, apellidos FROM usuarios WHERE tipo_usuarios = 1";
$resultProfesores = mysqli_query($conexion, $queryProfesores);

if (!$resultProfesores) {
  die("Error en la consulta de profesores: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nueva Clase</title>
</head>

<body>
  <h2>Registro de nueva Clase</h2>
  <form action="crear_clase.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br><br>
    
    <input type="hidden" id="id_profesor" name="id_profesor" value="">
    <label for="Asignar_Profesor">Asignar Profesor:</label>
    <select id="Asignar_Profesor" name="Asignar_Profesor">
      <option value="">No asignar profesor</option>
      <?php
      // Mostrar los profesores en el menú desplegable
      while ($row = mysqli_fetch_assoc($resultProfesores)) {
        echo "<option value='" . $row['id_usuarios'] . "'>" . $row['nombre'] . " " . $row['apellidos'] . "</option>";
      }
      ?>
    </select><br><br>

    <input type="submit" value="Enviar">
  </form>
  <a href="../usuarios/panel_de_control.php"><button>Cancelar</button></a>
</body>

</html>