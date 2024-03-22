<?php
require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
  }

//
//Añadir a la celta también aforo??
//Mirar como hacer para que la casilla sea un modal, el cual onclick registre al usuario en la clase. PARA VISTA TRABAJADOR
//Botón para que el usuario se apunte. Falta añadir la funcionalidad.
//Mirar como hacer para que el usuario vea sus clases registradas con otro color. 

for ($hora = 8; $hora <= 20; $hora++) { //La hora, es decir la fila
    echo "<tr>"; //Abro la fila de la hora
    echo "<td class='chora'<div >$hora:00</div></td>";
    for ($dia = 2; $dia <= 7; $dia++) {
        //echo "<td>"; //abro la columna del día en la fila de la hora
        //consulta bbdd vieja, 
        //$sql = "SELECT * FROM sesiones WHERE DAYOFWEEK(fecha_hora_inicio) = $dia AND HOUR(fecha_hora_inicio) = $hora";
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
            //meto en un div por probar porque no me va bien el css, no funciono. Al date le doy formato para que me de solo horas y minutos.
            echo "<td class='con-sesion'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <button>test</button> </p></div>";
        } else {
            // Si no hay una sesión programada, deja la celda vacía. Esta en un div por testear cosas
            echo "<td class='sin-sesion'><div ><p>-- <button class='reg'>registro</button> </p></div>";
        }
        echo "</td>";
    }
    // Para el día domingo (1) se repite lo anterior modificando el día a 1
    //echo "<td>";
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
        $date1 = new DateTime($sesion['hora_inicio']); //guardamos la hora de inicio y final en una variable
        $date = new DateTime($sesion['hora_fin']);
        echo "<td class='con-sesion'><div><p>{$sesion['nombre_clase']} en {$sesion['nombre_sala']} - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')}</p></div>";
    } else {
        echo "<td class='sin-sesion'><div><p>--</p></div>";
    }
    echo "</td>"; // Cerrar la columna del domingo
    echo "</tr>"; // Cerrar la tablaS
}
    


?>