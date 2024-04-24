<?php
date_default_timezone_set('Europe/Madrid');
require_once(__DIR__ . "/../../../../models/user_models/user_queries.php");
session_start();

if (isset($_GET['totalScore'])) {
    try {
        // Obtener los valores de la puntuación total y puntuación actual de la URL
        $totalScore = $_GET['totalScore'];
        $id_usuario = $_SESSION['id_usuarios'];
        $fecha_registro = date("Y-m-d H:i:s");

        // Crear una instancia de UserQueries
        $userQueries = new UserQueries();
        // Insertar la puntuación en la base de datos
        $result = $userQueries->insertScore($id_usuario, $totalScore, $fecha_registro);
        header("refresh:2; ../crush_gym.php");
        // Verificar si la inserción fue exitosa
        if ($result) {
            echo "Puntuación actualizada, bien hecho!.";
        } else {
            echo "No es tu mejor puntuacion, esfuerzate!!.";
        }
    } catch (PDOException $e) {
        // Manejar excepciones de PDO
        echo "Error de base de datos: " . $e->getMessage();
    } catch (Exception $e) {
        // Manejar otras excepciones
        echo "Error: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntuación</title>
</head>

<body>
    <a href="../crush_gym.php"><button>Cancelar</button></a>
</body>

</html>