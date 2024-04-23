<?php
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.Php");
session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
  }

//se repite todo el codigo del cliente, con modificaciones. Se quitan los colores.

for ($hora = 8; $hora <= 20; $hora++) { //La hora, es decir la fila
    echo "<tr>"; //Abro la fila de la hora
    echo "<td><div class='chora'>$hora:00</div></td>";
    for ($dia = 2; $dia <= 7; $dia++) {
        echo "<td>"; //abro la columna del día en la fila de la hora
        //Consulta en la base de datos compleja
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
          //bucle para revisar si existe una sesión en esa hora  
        if ($sesion) {
            $date1 = new DateTime($sesion['hora_inicio']); //guardamos la hora de inicio y final en una variable
            $date = new DateTime($sesion['hora_fin']);
            echo "<div class='ctrabajador'><p>{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} </p></div>";
        } else {
            // Si no hay una sesión programada, deja la celda vacía. Esta en un div y un p por testear cosas
            echo "<div class='ctrabajador'><p><a href='formulario_sesion_calendario.html'><button>Registrar clase</button></a></p></div>";
        }
        echo "</td>";
    }
    // Para el día domingo (1) se repite lo anterior modificando el día a 1      S I N     A C T U A L I Z A R      E L     D O M I N G O
    /*echo "<td>";
    $dia = 1;
    $sql = "SELECT 
                    C.nombre AS nombre_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.fecha_hora_inicio,
                    SE.fecha_hora_fin AS hora_fin
                FROM 
                    sesiones SE
                JOIN 
                    CLASES C ON SE.id_clases = C.id_clases
                JOIN 
                    SALAS S ON SE.id_salas = S.id_salas 
                    WHERE DAYOFWEEK(fecha_hora_inicio) = $dia AND HOUR(fecha_hora_inicio) = $hora";

    $result = mysqli_query($conexion, $sql);
    $sesion = mysqli_fetch_assoc($result);

    if ($sesion) {
        echo "<div class='ctrabajador'><p>{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')}</p></div>";
    } else {
        echo "<div class='ctrabajador'><p>--</p></div>";
    }
    echo "</td>"; // Cerrar la columna del domingo
    echo "</tr>"; // Cerrar la tablaS*/
}
    


?>