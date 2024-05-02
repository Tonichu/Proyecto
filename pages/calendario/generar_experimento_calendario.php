<?php
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}


                // ESTE SERÍA EL CALENDARIO PARA EL USUARIO. PARA EL TRABAJADOR, DE INCLUIRLO EN LA WEB SE MODIFICA PARA QUE SOLO SALGAN SUS SESIONES.
                // CAMBIO 1: CAMBIAN LOS BOTONES POR CREAR O ELIMINAR SESION.
                // CAMBIO 2: ELIMINAR CONSULTA A INSCRIPCIÓN.
                // CAMBIO 3: AÑADIR A LA CONSULTA EL ID_PROFESOR DE LA TABLA CLASES.
                // CAMBIO 4: CONSULTA A USUARIOS DE TODOS LOS ID, COMPARAR A ID_PROFESOR PARA SACAR SU NOMBRE.
                // CAMBIO 5: AJUSTAR LA GENERACIÓN DEL HTML PARA QUE SEA COERENTE.




for ($hora = 8; $hora <= 20; $hora++) {             //La hora, es decir la fila. Bucle que recurre todas las horas que operativas.
    echo "<tr>";                                    //Abro la fila de la hora.                                                     
    if ($hora <= 13) {                              //Para hacer división entre horas de mañana y tarde
        echo "<td class='mannana'<div >$hora:00</div></td>";
    } else echo "<td class='tarde'<div >$hora:00</div></td>";

    for ($dia = 2; $dia <= 7; $dia++) {             //El lunes es 2 para mysql, bucle que recorre del 2 al 7.
                                                    //Consulta compleja a la base de datos.
        $sql = "SELECT                              
                    C.nombre AS nombre_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.id AS id_sesion1,
                    SE.fecha_hora_inicio AS hora_inicio,
                    SE.fecha_hora_fin AS hora_fin
                  FROM sesiones SE
                  JOIN CLASES C ON SE.id_clases = C.id_clases
                  JOIN SALAS S ON SE.id_salas = S.id_salas 
                  WHERE DAYOFWEEK(fecha_hora_inicio) = $dia AND HOUR(fecha_hora_inicio) = $hora";
        $result = mysqli_query($conexion, $sql); //Conjunto de resultados de msqli query.
        $sesion = mysqli_fetch_assoc($result);   //Se guarda el resultado del msqli query como array asociativo.

        //  A Ñ A D I R  - control de errores a la consulta. 

        // M O D I F I C A R   -   Falta la funcionalidad de los botones de apuntarse y desapuntarse. Código ya hecho, ajustarlo con el del MVC 
        //                     -   Mostrar el aforo en la casilla? o mucho texto? 
        //                     -   Adaptación del calendario al profesor - se hace al final? 
        //                     -   Idea para el administrador - muestra las sesiones y, en las que se apunte al menos un usuario de un color.


        if ($sesion) {                                //Si en el dia seleccionado hay una sesión
            $idses1 = $sesion['id_sesion1'];
            $date1 = new DateTime($sesion['hora_inicio']);
            $date = new DateTime($sesion['hora_fin']);
            $horacom = $date1->format('H');
            $user = 'pepe';                         //Usuario que está logueado en la web.   I M P O R T A N T E    ta sin hacer.
                                                       //Consulta compleja a la base de datos. 
            $sql2 = "SELECT 
                        I.id_usuario AS nombre_usuario,
                    FROM INSCRIPCIONES I
                    WHERE sesion_actual = $idses1 AND id_usuario = $user";
            $result2 = mysqli_query($conexion, $sql); //Conjunto de resultados de msqli query.
            $sesion2 = mysqli_fetch_assoc($result2);  //Se guarda el resultado del msqli query como array asociativo.
            
                    
            if ( $horacom <= 13) {                    //Si la hora es menor o igual a 13. El else es igual, pero cambia mañana por tarde.
                if($sesion2){              //A su vez, si el usuario logueado está presente en la sesión.
                                                      //Genera la casilla con la clase apuntado-mañana.
                    echo "<td class='apuntado-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']}  
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Desapuntarse de la clase</button><a></p></div>";
                }else{                                //Si hay sesión pero no está apuntado, clase con sesion mañana.
                    echo "<td class='con-sesion-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Apuntarse a la clase</button><a></p></div>";                
                }
            } else {
                if($sesion2){
                    echo "<td class='apuntado-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Desapuntarse a la clase</button><a></p></div>";
                }else{
                    echo "<td class='con-sesion-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a><button>Apuntarse a la clase</button><a></p></div>";
                }
            }
        } elseif($hora <= 13){                          //De no haber sesión, siendo la hora a las 13 o antes.
            echo "<td class='sin-sesion-mannana'><div ><p>--</p></div>";
        }else {                                         //De no haber sesión, después de las 13.
            echo "<td class='sin-sesion-tarde'><div ><p>--</p></div>";
        }
        echo "</td>";
    }



    // D O M I N G O     S I N    M O D I F I C A R     C O N    S I    U S E R    E S T A   A P U N T A D O  - Es un copia pega simple, lo dejo así por si rompo mucho el código arriba.




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

