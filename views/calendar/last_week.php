<?php
// Variables globales para almacenar la fecha actual y la fecha de inicio de la semana actual
$currentDate = new DateTime();
$startOfWeek = new DateTime($currentDate->format('Y-m-d'));
$startOfWeek->modify('-' . ($currentDate->format('N') - 1) . ' days');

// Añadir 7 días a la fecha de inicio de la semana
$startOfWeek->modify('-7 days');

// Array con los nombres de los meses en español
$meses = array(
    1 => "enero",
    2 => "febrero",
    3 => "marzo",
    4 => "abril",
    5 => "mayo",
    6 => "junio",
    7 => "julio",
    8 => "agosto",
    9 => "septiembre",
    10 => "octubre",
    11 => "noviembre",
    12 => "diciembre"
);

// Obtener el nombre del mes en español
$currentMonthName = $meses[$startOfWeek->format('n')];
$currentYear = $startOfWeek->format('Y');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="calendar">
        <?php
        // Crear el calendario
        echo '<table class="calendar">';
        echo '<tr>';
        echo '<th></th>'; // Celda vacía para alinear con las horas
        echo '<th colspan="7">' . $currentYear . ' de ' . $currentMonthName . '</th>'; // Año
        echo '</tr>';

        // Días de la semana con el número del mes
        echo '<tr class="calendar-header">';
        echo '<th>Hora</th>'; // Cabecera de horas
        $daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $tempStartOfWeek = clone $startOfWeek; // Clonamos para evitar modificar la fecha original
        for ($i = 0; $i < 7; $i++) {
            $dayOfMonth = $tempStartOfWeek->format('j');
            $formattedDate = $tempStartOfWeek->format('d');
            echo '<th class="day-name">' . $daysOfWeek[$i] . '<br>' . $formattedDate . '</th>'; // Nombre del día y número del mes
            $tempStartOfWeek->modify('+1 day');
        }
        echo '</tr>';

        // Horas de 8:00 a 20:00
        for ($hour = 8; $hour <= 20; $hour++) {
            echo '<tr>';
            echo '<td>' . $hour . ':00</td>'; // Hora actual

            // Celdas vacías para alinear con los días de la semana
            for ($j = 0; $j < 7; $j++) {
                echo '<td class="calendar-day"></td>';
            }

            echo '</tr>';
        }

        echo '</table>';
        ?>
    </div>
    <button><a href="calendar.php">semana actual</a></button>
</body>

</html>