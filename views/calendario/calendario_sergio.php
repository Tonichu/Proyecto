<?php

require_once(__DIR__ . "/../../models/database.php");

session_start();

$db = new Database(); // Crear una instancia de la clase Database

try {
    // Realizar la consulta SQL para obtener el nombre de la clase, el nombre del profesor y las horas de inicio y fin de la clase
    $query = "SELECT c.nombre AS nombre_clase, u.nombre AS nombre_profesor, s.fecha_hora_inicio, s.fecha_hora_fin 
              FROM CLASES c
              LEFT JOIN SESIONES s ON c.id_clases = s.id_clases
              LEFT JOIN USUARIOS u ON c.id_profesor = u.id_usuarios";

    $statement = $db->getConnection()->prepare($query);
    $statement->execute();

    // Obtener los resultados de la consulta
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los resultados
    foreach ($result as $row) {
        echo "Nombre de la clase: " . $row['nombre_clase'] . "<br>";
        echo "Nombre del profesor: " . $row['nombre_profesor'] . "<br>";
        echo "Hora de inicio: " . $row['fecha_hora_inicio'] . "<br>";
        echo "Hora de fin: " . $row['fecha_hora_fin'] . "<br><br>";
    }
} catch (PDOException $e) {
    // Manejar cualquier error de la base de datos
    echo "Error: " . $e->getMessage();
}
?>