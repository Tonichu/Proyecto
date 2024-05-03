<?php

require_once(__DIR__ . "/../../models/database.php");

session_start();

// Crear una instancia de la clase Database
$database = new Database();
$conexion = $database->getConnection();

if (!$conexion) {
    die("La conexión a la base de datos ha fallado");
}

for ($hora = 8; $hora <= 20; $hora++) {
    echo "<tr>";

    $periodo = ($hora <= 13) ? "mannana" : "tarde";
    echo "<td class='$periodo'><div>$hora:00</div></td>";

    for ($dia = 2; $dia <= 7; $dia++) {
        $sql = "SELECT                              
                    C.nombre AS nombre_clase, 
                    C.id_profesor AS profesor_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.fecha_hora_inicio AS hora_inicio,
                    SE.fecha_hora_fin AS hora_fin,
                    SE.id AS id_sesion
                  FROM sesiones SE
                  JOIN CLASES C ON SE.id_clases = C.id_clases
                  JOIN SALAS S ON SE.id_salas = S.id_salas 
                  WHERE DAYOFWEEK(fecha_hora_inicio) = ? AND HOUR(fecha_hora_inicio) = ?";
        
        // Preparar la consulta
        $statement = $conexion->prepare($sql);

        // Ejecutar la consulta
        $statement->execute([$dia, $hora]);

        // Obtener los resultados de la consulta
        $sesion = $statement->fetch(PDO::FETCH_ASSOC);

        if ($sesion) {
            $date1 = new DateTime($sesion['hora_inicio']);
            $date = new DateTime($sesion['hora_fin']);
            $profesor = $sesion['profesor_clase'];
            $clase = ($profesor == 'pepe') ? 'profesor' : 'con-sesion';
            echo "<td class='$clase-$periodo'><div><p>{$sesion['nombre_clase']} en {$sesion['nombre_sala']}  
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')}</p></div>";
        } else {
            $formulario = ($hora <= 13) ? "formulario_sesion_calendario.php" : "formulario_nueva_sesion.html";
            echo "<td class='sin-sesion-$periodo'><div><p><a href='../calendario/$formulario'><button>Crear sesión</button></a></p></div>";
        }
        echo "</td>";
    }

    echo "</tr>";
}
?>

