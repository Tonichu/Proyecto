<?php
// Obtener las sesiones
session_start();


require_once(__DIR__ . "/../../models/calendar_models/calendar_queries.php");
$calendarQueries = new CalendarQueries();
$id_usuario = $_SESSION['id_usuarios'];
$sesiones = $calendarQueries->getAllSesionForProfesor($id_usuario);


// Variables globales para almacenar la fecha actual y la fecha de inicio de la semana actual
$currentDate = new DateTime();
$startOfWeek = new DateTime($currentDate->format('Y-m-d'));

$startOfWeek->modify('-' . ($currentDate->format('N') - 1) . ' days');

// Mes actual
$currentMonth = $currentDate->format('n');
$currentDay = $currentDate->format('j');
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
$currentMonthName = $meses[$currentMonth];
$currentYear = $startOfWeek->format('Y');

// Inicializar un array multidimensional para almacenar las sesiones por día y hora
$sesionesPorDiaYHora = [];


// Iterar sobre las sesiones y agruparlas por día y hora
foreach ($sesiones as $sesion) {
    $fechaInicio = new DateTime($sesion['fecha_hora_inicio']);
    $mesInicio = $fechaInicio->format('n');
    $dia = $fechaInicio->format('N'); // Obtener el número del día de la semana (1 para lunes, 2 para martes, etc.)
    // Verificar si la sesión ocurre en el mes actual
    if ($mesInicio == $currentMonth) {

        $fechaFin = new DateTime($sesion['fecha_hora_fin']);
       
        $horaInicio = $fechaInicio->format('G'); // Obtener la hora de inicio sin minutos
        $horaFin = $fechaFin->format('G'); // Obtener la hora de fin sin minutos

      
            // Añadir la sesión al array correspondiente
            $sesionesPorDiaYHora[$dia][$horaInicio][] = [
                'id' => $sesion['id'],
                'nombre_clase' => $sesion['nombre_clase'],
                'nombre_profesor' => $sesion['nombre_profesor'],
                'nombre_sala' => $sesion['nombre_sala'],
                'fecha_hora_inicio' => $sesion['fecha_hora_inicio'],
                'fecha_hora_fin' => $sesion['fecha_hora_fin']
            ];
    
        }}
        foreach ($sesiones as $sesion) {
            $fechaInicio = new DateTime($sesion['fecha_hora_inicio']);
            $mesInicio = $fechaInicio->format('n');
            $diaInicio = $fechaInicio->format('j');
        
            // Verificar si la sesión ocurre en el mes y el día actual
            if ($mesInicio == $currentMonth && $diaInicio >= $startOfWeek->format('j')) {
                echo '<pre>';
                print_r($sesion);
                echo '</pre>';
            }
        }
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
                echo '<td class="calendar-day">';

                // Verificar si hay sesiones para este día y hora
                $dia = $j + 1; // Día de la semana (1 para lunes, 2 para martes, etc.)
                if (isset($sesionesPorDiaYHora[$dia][$hour])) {
                    // Mostrar las sesiones
                    foreach ($sesionesPorDiaYHora[$dia][$hour] as $sesion) {
                        echo '<div>' . $sesion['nombre_clase'] . '</div>';
                        echo '<div>' . $sesion['nombre_profesor'] . '</div>';
                        echo '<div>' . $sesion['nombre_sala'] . '</div>';
                        //echo '<div>' . $sesion['id'] . '</div>';
                        echo '<a href="otro_sitio.php"><button>inscribirse</button></a>'; // Botón que lleva a otro sitio
                    }
                }

                echo '</td>';
            }

            echo '</tr>';
        }

        echo '</table>';
        ?>
    </div>

    <!-- Enlace para avanzar a la siguiente semana -->
    <button><a href="last_week.php">semana anterior</a></button>
    <button><a href="next_week.php">Siguiente Semana</a></button>
</body>

</html>