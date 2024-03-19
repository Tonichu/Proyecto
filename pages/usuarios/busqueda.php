<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
  session_start();
  // Datos de conexión a la base de datos
  require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
  require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
  usuarioAdmin(); // solo acceso admin
  // Crear conexión a la base de datos
  $conexion = mysqli_connect($host, $user, $password, $database, $port);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $tabla = $_POST["tabla"];
    $busqueda = $_POST["busqueda"];

    // Escapar el valor de búsqueda para evitar inyección SQL
    $busqueda = mysqli_real_escape_string($conexion, $busqueda);

    // Construir la consulta SQL
    $query = "SELECT * FROM $tabla WHERE nombre LIKE '%$busqueda%'";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) > 0) {
      // Mostrar los resultados
      echo "<h2>Resultados de la búsqueda en $tabla:</h2>";
      echo "<table border='1'>";
      echo "<tr>";
      // Encabezados de la tabla
      $row = mysqli_fetch_assoc($result);
      foreach ($row as $key => $value) {
        if ($key !== 'pass') { // Verificar si la columna no es "pass"
          echo "<th>$key</th>";
        }
      }
      echo "</tr>";
      // Mostrar los datos
      mysqli_data_seek($result, 0); // Reiniciar el puntero del resultado
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $key => $value) {
          if ($key !== 'pass') { // Verificar si la columna no es "pass"
            // Traducir los valores numéricos de tipo_usuarios a descripciones
            if ($key === 'tipo_usuarios') {
              switch ($value) {
                case 0:
                  echo "<td>Administrador</td>";
                  break;
                case 1:
                  echo "<td>Profesor</td>";
                  break;
                case 2:
                  echo "<td>Usuario</td>";
                  break;
                default:
                  echo "<td>$value</td>";
                  break;
              }
            } else {
              echo "<td>$value</td>";
            }
          }
        }
        echo "</tr>";
      }
      echo "</table>";
      // Botón para ir atrás
      echo '<form method="get" action="' . $_SERVER['HTTP_REFERER'] . '">';
      echo '<input type="submit" value="Ir Atrás">';
      echo '</form>';
      exit();
    } else {
      echo "<span>No se encontraron resultados.</span>";
      // Botón para ir atrás
      echo '<form method="get" action="' . $_SERVER['HTTP_REFERER'] . '">';
      echo '<input type="submit" value="Ir Atrás">';
      echo '</form>';
      exit();
    }
    // Cerrar la conexión
    mysqli_close($conexion);
  }
  ?>
  <a href="panel_de_control.php"><button>Cancelar</button></a>
</body>

</html>