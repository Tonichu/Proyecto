<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Games</title>
  <!-- Enlaces a Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-QTucV6PmVbIy7a5c8Mv8+wDs2tbblPy+2PymTs3lpvbWY2tKeBvEzP3zs2l+l/6h" crossorigin="anonymous">
    </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-pzjw8f+ua8z5+sm3gD9OXclOpXwfsqAW+b/zV3vLIgaL1Rxg/1fOWtPmY2O5Tsa" crossorigin="anonymous">
    </script>

  <style>
    body {
      display: flex;
      min-height: 100vh;
      align-items: center;
      justify-content: center;
    }

    button {
      margin-right: 10px;
    }
  </style>

</head>

<body>
  <div class="container text-center">
    <h1>Crush gym</h1>
    <p>Este pequeño minijuego se basa en clickear encima de las imágenes. Hay 3 niveles y si completas el último te
      llevas
      puntos extra.</p>

    <a href="crush_gym/crush_gym.php" class="btn btn-primary">Crush Gym!</a>
    <a href="../user_panel.php" class="btn btn-secondary">Cancelar</a>

    <h2>Tabla de puntuaciones</h2>

    <?php
    require_once (__DIR__ . "/../../models/user_models/user_queries.php");

    session_start();

    $userQueries = new UserQueries();
    $scores = $userQueries->getAllScoresWithUsernames();
    
    echo "<div class='table-responsive'>"; // Envolver la tabla para hacerla responsive
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead class='thead-dark'>"; // Encabezado oscuro
    echo "<tr><th>Nombre del usuario</th><th>Apellido del usuario</th><th>Puntuación</th><th>Fecha de registro</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($scores as $score) {
      echo "<tr>";
      echo "<td>" . $score['nombre'] . "</td>"; // Mostrar el nombre del usuario
      echo "<td>" . $score['apellidos'] . "</td>"; // Mostrar el apellido del usuario
      echo "<td>" . $score['puntuacion'] . "</td>";
      echo "<td>" . $score['fecha_registro'] . "</td>";
      echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    ?>
  </div>
</body>

</html>