<?php
// Obtener las sesiones
session_start();
require_once (__DIR__ . "/../../models/user_models/user_queries.php");
require_once (__DIR__ . "/../../models/calendar_models/calendar_queries.php");

$calendarQueries = new CalendarQueries();
$id_usuario = $_SESSION['id_usuarios'];

$userQueries = new UserQueries();

$sesionesNoApuntado = $userQueries->getUnenrolledSessions($id_usuario);
$sesionesApuntado = $userQueries->getEnrolledSessions($id_usuario);

if (isset($_GET["semana"])) {
    $currentDate = new DateTime($_GET["semana"]);
} else {
    $currentDate = new DateTime();
}

$startOfWeek = new DateTime($currentDate->format('Y-m-d'));
$startOfWeek->modify('-' . ($currentDate->format('N') - 1) . ' days');

$endOfWeek = clone $startOfWeek;
$endOfWeek->modify('+6 days')->setTime('23', '59', '59');

$prevWeek = (clone $startOfWeek)->modify('-7 days')->format('Y-m-d');
$nextWeek = (clone $startOfWeek)->modify('+7 days')->format('Y-m-d');

$currentMonth = $currentDate->format('n');
$currentDay = $currentDate->format('j');

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

$currentMonthName = $meses[$currentMonth];
$currentYear = $startOfWeek->format('Y');

$sesionesPorDiaYHora = [];

foreach ($sesionesNoApuntado as $sesion) {
    $fechaInicio = new DateTime($sesion['fecha_hora_inicio']);
    $mesInicio = $fechaInicio->format('n');
    $dia = $fechaInicio->format('N');
    $sessionDay = $fechaInicio->format('d');

    if (($fechaInicio >= $startOfWeek) && ($fechaInicio <= $endOfWeek)) {
        $fechaFin = new DateTime($sesion['fecha_hora_fin']);

        $horaInicio = $fechaInicio->format('G');
        $horaFin = $fechaFin->format('G');

        $sesionesPorDiaYHora[$dia][$horaInicio][] = [
            'id' => $sesion['id'],
            'class_name' => $sesion['class_name'],
            'profesor_name' => $sesion['profesor_name'],
            'sala_name' => $sesion['sala_name'],
            'fecha_hora_inicio' => $sesion['fecha_hora_inicio'],
            'fecha_hora_fin' => $sesion['fecha_hora_fin'],
            'apuntado' => false
        ];
    }
}

foreach ($sesionesApuntado as $sesion) {
    $fechaInicio = new DateTime($sesion['fecha_hora_inicio']);
    $mesInicio = $fechaInicio->format('n');
    $dia = $fechaInicio->format('N');
    $sessionDay = $fechaInicio->format('d');

    if (($fechaInicio >= $startOfWeek) && ($fechaInicio <= $endOfWeek)) {
        $fechaFin = new DateTime($sesion['fecha_hora_fin']);

        $horaInicio = $fechaInicio->format('G');
        $horaFin = $fechaFin->format('G');

        $sesionesPorDiaYHora[$dia][$horaInicio][] = [
            'id' => $sesion['id'],
            'class_name' => $sesion['class_name'],
            'profesor_name' => $sesion['profesor_name'],
            'sala_name' => $sesion['sala_name'],
            'fecha_hora_inicio' => $sesion['fecha_hora_inicio'],
            'fecha_hora_fin' => $sesion['fecha_hora_fin'],
            'apuntado' => true
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .calendar th,
        .calendar td {
            text-align: center;
        }

        .btn {
            margin: 10px;
        }

        #calendar {
            max-height: 80vh;
        }

        /* Definición de colores alternados en el tbody */
        .calendar tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <a href="calendarUser.php?semana=<?php echo $prevWeek ?>" class="btn btn-info">Semana anterior</a>
            <a href="calendarUser.php?semana=<?php echo $nextWeek ?>" class="btn btn-info">Siguiente Semana</a>
        </div>
        <div id="calendar" class="table-responsive">
            <table class="calendar table table-bordered">
                <thead>
                    <tr>
                        <th colspan="8"><?php echo $currentYear . ' de ' . $currentMonthName; ?></th>
                    </tr>
                    <tr class="calendar-header">
                        <th>Hora</th>
                        <?php
                        $daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                        $tempStartOfWeek = clone $startOfWeek;
                        for ($i = 0; $i < 7; $i++) {
                            $dayOfMonth = $tempStartOfWeek->format('j');
                            $formattedDate = $tempStartOfWeek->format('d');
                            echo '<th class="day-name">' . $daysOfWeek[$i] . '<br>' . $formattedDate . '</th>';
                            $tempStartOfWeek->modify('+1 day');
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($hour = 8; $hour <= 20; $hour++) {
                        echo '<tr>';
                        echo '<td>' . $hour . ':00</td>';

                        for ($j = 0; $j < 7; $j++) {
                            echo '<td class="calendar-day">';
                            $dia = $j + 1;
                            if (isset($sesionesPorDiaYHora[$dia][$hour])) {
                                foreach ($sesionesPorDiaYHora[$dia][$hour] as $sesion) {
                                    echo '<div>' . $sesion['class_name'] . '</div>';
                                    echo '<div>' . $sesion['profesor_name'] . '</div>';
                                    echo '<div>' . $sesion['sala_name'] . '</div>';
                                    if ($sesion['apuntado']) {
                                        echo '<a href="../../views/user/unenroll_class.php?id=' . $sesion['id'] . ' "><button class="btn btn-danger">Cancelar la inscripción</button></a>';
                                    } else {
                                        echo '<a href="../../views/user/enroll_class.php?id=' . $sesion['id'] . ' "><button class="btn btn-success">Inscribirse a la clase</button></a>';
                                    }
                                }
                            }
                            echo '</td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <a href="../../views/user_panel.php" class="btn btn-secondary">Volver a tu panel</a>
        </div>
    </div>
</body>

</html>