<?php

// Obtener las sesiones
require_once(__DIR__ . "/../../models/calendar_models/calendar_queries.php");
$calendarQueries = new CalendarQueries();
$sesiones = $calendarQueries->getAllSesion();

// Obtener la fecha actual en el formato deseado (año/mes/día)
$fechaActualFormateada = date('Y-m-d');

// Inicializar un array multidimensional para almacenar las sesiones por día y hora
$sesionesPorDiaYHora = [];

// Iterar sobre las sesiones y agruparlas por día y hora
foreach ($sesiones as $sesion) {
    $fechaInicio = new DateTime($sesion['fecha_hora_inicio']);
    $fechaInicioFormateada = $fechaInicio->format('Y-m-d'); // Formatear la fecha de inicio al formato deseado (año-mes-día)

    // Verificar si la sesión ocurre en el día actual
    if ($fechaInicioFormateada == $fechaActualFormateada) {
        $horaInicio = $fechaInicio->format('G'); // Obtener la hora de inicio sin minutos
        $dia = $fechaInicio->format('N'); // Obtener el número del día de la semana (1 para lunes, 2 para martes, etc.)

        // Añadir la sesión al array correspondiente
        $sesionesPorDiaYHora[$dia][$horaInicio][] = $sesion;
    }
}

$currentDayOfMonth = date('d');

// Crear el calendario de la semana actual
echo '<table class="calendar">';
echo '<tr>';
echo '<th></th>'; // Celda vacía para alinear con las horas
$daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
foreach ($daysOfWeek as $day) {
    echo '<th class="day-name">' . $day . ' ' . $currentDayOfMonth . '</th>'; // Nombre del día
}
echo '</tr>';

// Horas de 8:00 a 20:00
for ($hour = 8; $hour <= 20; $hour++) {
    echo '<tr>';
    echo '<td>' . $hour . ':00</td>'; // Hora actual

    // Celdas vacías para alinear con los días de la semana
    for ($j = 0; $j < 7; $j++) {
        echo '<td class="calendar-day">';

        // Verificar si hay sesiones para este día y hora
        $dia = $j + 1; // Día de la semana (1 para lunes, 2 para martes, etc.)
        if (isset($sesionesPorDiaYHora[$dia][$hour])) {
            // Mostrar las sesiones
            foreach ($sesionesPorDiaYHora[$dia][$hour] as $sesion) {
                echo '<div>' . $sesion['nombre_clase'] . '</div>';
                echo '<div>' . $sesion['nombre_profesor'] . '</div>';
                echo '<div>' . $sesion['nombre_sala'] . '</div>';
            }
        }

        echo '</td>';
    }

    echo '</tr>';
}

echo '</table>';
?>
