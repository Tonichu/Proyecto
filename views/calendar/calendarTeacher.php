<?php
// Obtener las sesiones
session_start();
require_once (__DIR__ . "/../../controllers/role_controller.php");
require_once (__DIR__ . "/../../models/calendar_models/calendar_queries.php");
$calendarQueries = new CalendarQueries();
$id_usuario = $_SESSION['id_usuarios'];
$sesiones = $calendarQueries->getAllSesionForProfesor($id_usuario);

$roleController = RoleController::getInstance();
$roleController->isTeacher($_SESSION);

if (isset($_GET["semana"])) {
    $currentDate = new DateTime($_GET["semana"]);
} else {
    $currentDate = new DateTime();
}

// Variables globales para almacenar la fecha actual y la fecha de inicio de la semana actual

$startOfWeek = new DateTime($currentDate->format('Y-m-d'));
$startOfWeek->modify('-' . ($currentDate->format('N') - 1) . ' days');

$endOfWeek = clone $startOfWeek; //clonamos para poder modificar
$endOfWeek->modify('+6 days')->setTime('23', '59', '59'); // si no se pone esto pasa al 7 dia

$prevWeek = (clone $startOfWeek)->modify('-7 days')->format('Y-m-d'); //La semana anterior a la actual
$nextWeek = (clone $startOfWeek)->modify('+7 days')->format('Y-m-d'); //La semana siguiente a la actual

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
    $sessionDay = $fechaInicio->format('d');
    // Verificar si la sesión ocurre en el mes actual
    if (($fechaInicio >= $startOfWeek) && ($fechaInicio <= $endOfWeek)) {
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
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
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

        .btn {
            margin: 10px;
        }

        #calendar {
            max-height: 80vh;
        }

        .table {
            text-align: center;
        }

        .calendar thead th {
            vertical-align: middle;
        }

        .calendar tbody td {
            vertical-align: middle;
        }

        /* Estilo para filas impares */
        .calendar tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        /* Estilo para filas pares */
        .calendar tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div>
                <a href="calendarTeacher.php?semana=<?php echo $prevWeek ?>" class="btn btn-info">Semana anterior</a>
                <a href="calendarTeacher.php?semana=<?php echo $nextWeek ?>" class="btn btn-info">Siguiente Semana</a>
            </div>
        </div>
        <div id="calendar" class="table-responsive">
            <table class="table table-bordered calendar"> <!-- Agregué la clase "calendar" aquí -->
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="7"><?php echo $currentYear . ' de ' . $currentMonthName ?></th>
                    </tr>
                    <tr class="table-primary">
                        <th scope="col">Hora</th>
                        <?php
                        $daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                        $tempStartOfWeek = clone $startOfWeek;
                        for ($i = 0; $i < 7; $i++) {
                            $dayOfMonth = $tempStartOfWeek->format('j');
                            $formattedDate = $tempStartOfWeek->format('d');
                            echo '<th scope="col">' . $daysOfWeek[$i] . '<br>' . $formattedDate . '</th>';
                            $tempStartOfWeek->modify('+1 day');
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($hour = 8; $hour <= 20; $hour++) {
                        echo '<tr>';
                        echo '<th scope="row">' . $hour . ':00</th>';
                        for ($j = 0; $j < 7; $j++) {
                            echo '<td>';
                            $dia = $j + 1;
                            if (isset($sesionesPorDiaYHora[$dia][$hour])) {
                                foreach ($sesionesPorDiaYHora[$dia][$hour] as $sesion) {
                                    echo '<div>' . $sesion['nombre_clase'] . '</div>';
                                    echo '<div>' . $sesion['nombre_profesor'] . '</div>';
                                    echo '<div>' . $sesion['nombre_sala'] . '</div>';
                                    echo '<a href="../teacher/session_modification_from_teacher.php?id=' . $sesion['id'] . '" class="btn btn-success btn-sm">Modificar</a>';
                                    echo '<a href="../teacher/delete_session_calendar.php?id=' . $sesion['id'] . '" class="btn btn-danger btn-sm">Eliminar la clase</a>';
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
            <a href="../../views/teacher_panel.php" class="btn btn-secondary">Volver a tu panel</a>
        </div>
    </div>

    <!-- Scripts de Bootstrap (opcional, pero requerido para algunas funcionalidades) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>