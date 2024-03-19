<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Clase</title>
</head>
<body>
  <h2>Modificar Clase</h2>
  <?php
 session_start();
 require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
 require_once(__DIR__ . "/../../librerias/utils/usuario_profesor.php");
 usuarioProfesor();
 
 $conexion = mysqli_connect($host, $user, $password, $database, $port);
 if (!$conexion) {
   die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
 }

  // Si se recibió un ID de clase válido, recuperar los datos de la clase y mostrar el formulario de edición
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM clases WHERE id_clases=$id";
    $resultado = mysqli_query($conexion, $query);
    $clase = mysqli_fetch_assoc($resultado);
  ?>
    <form action="modificacion_clase_profe.php" method="POST">
      <input name="id" hidden value="<?php echo $clase['id_clases']; ?>">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" value="<?php echo $clase['nombre']; ?>" required>
      
      <label for="descripcion">Descripción:</label>
      <input type="text" name="descripcion" value="<?php echo $clase['descripcion']; ?>" required>
      
      <input type="submit" value="Guardar cambios">
    </form>
    
  <?php
  } else {
    // Si no se recibió un ID de clase válido, mostrar un mensaje de error
    echo "<p>Error: ID de clase no válido</p>";
    header("refresh:2;../usuarios/usuario_profe.php");
  }
  ?>
  <a href="../usuarios/usuario_profe.php"><button>Cancelar</button></a>
</body>
</html>