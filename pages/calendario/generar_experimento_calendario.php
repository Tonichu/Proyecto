<?php
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

for ($hora = 8; $hora <= 20; $hora++) { //La hora, es decir la fila
    echo "<tr>"; //Abro la fila de la hora
    //Para hacer división entre horas de mañana y tarde 
    if ($hora <= 13) {
        echo "<td class='mannana'<div >$hora:00</div></td>";
    } else echo "<td class='tarde'<div >$hora:00</div></td>";

    for ($dia = 2; $dia <= 7; $dia++) {

        $sql = "SELECT 
                    C.nombre AS nombre_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.fecha_hora_inicio AS hora_inicio,
                    SE.fecha_hora_fin AS hora_fin
                  FROM sesiones SE
                  JOIN CLASES C ON SE.id_clases = C.id_clases
                  JOIN SALAS S ON SE.id_salas = S.id_salas 
                  WHERE DAYOFWEEK(fecha_hora_inicio) = $dia AND HOUR(fecha_hora_inicio) = $hora";
        $result = mysqli_query($conexion, $sql);
        $sesion = mysqli_fetch_assoc($result);

        //  A Ñ A D I R  - control de errores a la consulta. 

        if ($sesion) {
            $date1 = new DateTime($sesion['hora_inicio']);
            $date = new DateTime($sesion['hora_fin']);
            $horacom = $date1->format('H');
            if ( $horacom <= 13) {
                echo "<td class='con-sesion-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Apuntarse a la clase</button><a></p></div>";
            } else {
                echo "<td class='con-sesion-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Apuntarse a la clase</button><a></p></div>";
            }
        } elseif($hora <= 13){
            echo "<td class='sin-sesion-mannana'><div ><p>--</p></div>";
        }else {
            echo "<td class='sin-sesion-tarde'><div ><p>--</p></div>";
        }
        echo "</td>";
    }
    $dia = 1; // Código para el domingo
    $sql = "SELECT 
                    C.nombre AS nombre_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.fecha_hora_inicio AS hora_inicio,
                    SE.fecha_hora_fin AS hora_fin
                  FROM sesiones SE
                  JOIN CLASES C ON SE.id_clases = C.id_clases
                  JOIN SALAS S ON SE.id_salas = S.id_salas 
                  WHERE DAYOFWEEK(fecha_hora_inicio) = $dia AND HOUR(fecha_hora_inicio) = $hora";

        $result = mysqli_query($conexion, $sql);
        $sesion = mysqli_fetch_assoc($result);

        if ($sesion) {
            $date1 = new DateTime($sesion['hora_inicio']);
            $date = new DateTime($sesion['hora_fin']);
            $horacom = $date1->format('H');
            if ( $horacom <= 13) {
                echo "<td class='con-sesion-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Apuntarse a la clase</button><a></p></div>";
            } else {
                echo "<td class='con-sesion-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Apuntarse a la clase</button><a></p></div>";
            }
        } elseif($hora <= 13){
            echo "<td class='sin-sesion-mannana'><div ><p>--</p></div>";
        }else {
            echo "<td class='sin-sesion-tarde'><div ><p>--</p></div>";
        }
        echo "</td>";
}

