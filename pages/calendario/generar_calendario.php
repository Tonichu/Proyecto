<?php
require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
session_start();
$conn = mysqli_connect($host, $user, $password, $database, $port);

//Añadir en la base de datos, en la tabla sesiones el día y hora.
//Si metemos los datos de fecha y hora con datetime / timestamp en sesiones podemos utilizar la función DAYOFWEEK y HOUR -> '2024-03-04 08:00:00' -- Lunes a las 8:00 AM
// El día de la semana se representa como un número entre 1 y 7, donde 1 es domingo y 7 es sábado. Modificar el código cambiando el $día por 2 y luego hacer el domingo fuera del bucle.

//Probarlo todo - Esta sin probar espero que chusque
//Añadir a la celta también aforo??
//Mirar como hacer para que la casilla sea un modal, el cual onclick registre al usuario en la clase. 
//Mirar como hacer para que el usuario vea sus clases registradas con otro color.

for ($hora = 8; $hora <= 20; $hora++) { //La hora, es decir la fila
    echo "<tr>"; //Abro la fila de la hora
    echo "<td>$hora:00</td>";
    for ($dia = 2; $dia <= 7; $dia++) {
        echo "<td>"; //abro la columna del día en la fila de la hora
        //consulta bbdd
        //$sql = "SELECT * FROM sesiones WHERE dia = $dia AND hora inicio = $hora"; // Selecionar todo de la tabla sesiones donde el día y hora sean los que se ponen arriba
        $sql = "SELECT * FROM sesiones WHERE DAYOFWEEK(inicio) = $dia AND HOUR(inicio) = $hora";
        $result = mysqli_query($conn, $sql);
        $sesion = mysqli_fetch_assoc($result);

        if ($sesion) {
            // Si hay una sesión programada, muestra los detalles en la celda
            echo "<td>{$sesion['nombre_clase']} en {$sesion['nombre_sala']}</td>";
        } else {
            // Si no hay una sesión programada, deja la celda vacía
            echo "--";
        }
        echo "</td>";
    }
    // Para el día domingo (1)
    echo "<td>"; // Abrir la columna para el domingo en la fila de la hora   
    // Consultar la base de datos 
    $sql = "SELECT * FROM sesiones WHERE DAYOFWEEK(inicio) = 1 AND HOUR(inicio) = $hora";
    $result = mysqli_query($conn, $sql);
    $sesion = mysqli_fetch_assoc($result);

    if ($sesion) {
        // Si hay una sesión programada, mostrar los detalles en la celda
        echo "{$sesion['nombre_clase']} en {$sesion['nombre_sala']}";
    } else {
        // Si no hay una sesión programada, mostrar un guion o dejar la celda vacía
        echo "--";
    }
    echo "</td>"; // Cerrar la columna del domingo
    echo "</tr>";
}
    


?>