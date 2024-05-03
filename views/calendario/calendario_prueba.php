<?php

require_once(__DIR__ . "/../../models/database.php");

session_start();

$db = new Database(); // Crear una instancia de la clase Database

// Consultar las sesiones de clases
$query = "SELECT SESIONES.*, CLASES.nombre AS nombre_clase FROM SESIONES INNER JOIN CLASES ON SESIONES.id_clases = CLASES.id_clases";
$stmt = $db->getConnection()->prepare($query);
$stmt->execute();

$sesiones = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Clases</title>
    <link rel="stylesheet" href="styles.css"> <!-- Agrega tus estilos CSS -->
</head>
<body>
    <div id="calendar"></div>

    <script>
        const sesiones = <?php echo json_encode($sesiones); ?>; // Obtener las sesiones de PHP

        // Función para mostrar las sesiones en el calendario
        function mostrarSesiones() {
            const calendar = document.getElementById('calendar');
            let html = '<table>'; // Crear una tabla para el calendario

            // Recorrer cada sesión y agregarla al calendario
            sesiones.forEach(sesion => {
                html += `<tr><td>${sesion.nombre_clase}</td><td>${sesion.fecha_hora_inicio}</td><td>${sesion.fecha_hora_fin}</td><td>${sesion.id}</td></tr>`;
                // Puedes agregar más información sobre la sesión aquí, como la disponibilidad o si el usuario está inscrito
            });

            html += '</table>'; // Cerrar la tabla
            calendar.innerHTML = html; // Agregar el contenido al elemento HTML
        }

        mostrarSesiones(); // Llamar a la función para mostrar las sesiones cuando se cargue la página
    </script>
</body>
</html>
