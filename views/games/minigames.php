<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Games</title>
</head>
<body>

<h1>Crush gym</h1>
<p>Este pequeño minijuego se basa en clicear encima de las imágenes. Hay 3 niveles y si completas el último te llevas puntos extra.</p>

<a href="crush_gym/crush_gym.php"><button>Crush Gym!</button></a>
<a href="../user_panel.php"><button>Cancelar</button></a>

<h2>Tabla de puntuaciones</h2>

<?php
require_once(__DIR__ . "/../../models/user_models/user_queries.php");

session_start();

$userQueries = new UserQueries();
$scores = $userQueries->getAllScoresWithUsernames(); // Reemplaza $yourObject con la instancia adecuada de tu clase

echo "<table>";
echo "<tr><th>Nombre del usuario</th><th>Apellido del usuario</th><th>Puntuación</th><th>Fecha de registro</th></tr>";

foreach ($scores as $score) {
    echo "<tr>";
    echo "<td>" . $score['nombre'] . "</td>"; // Mostrar el nombre del usuario
    echo "<td>" . $score['apellidos'] . "</td>"; // Mostrar el apellido del usuario
    echo "<td>" . $score['puntuacion'] . "</td>";
    echo "<td>" . $score['fecha_registro'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>