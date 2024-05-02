<?php
require_once(__DIR__ . "/../../ConexionBdd/conexion_bdd.php");
                                                    //Meter verificación de que el usuario es profesor sería redundante?
session_start();
$conexion = mysqli_connect($host, $user, $password, $database, $port);
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}


for ($hora = 8; $hora <= 20; $hora++) {             //La hora, es decir la fila. Bucle que recurre todas las horas que operativas.
    echo "<tr>";                                    //Abro la fila de la hora.                                                     
    if ($hora <= 13) {                              //Para hacer división entre horas de mañana y tarde
        echo "<td class='mannana'<div >$hora:00</div></td>";
    } else echo "<td class='tarde'<div >$hora:00</div></td>";

    for ($dia = 2; $dia <= 7; $dia++) {             //El lunes es 2 para mysql, bucle que recorre del 2 al 7.
                                                    //Consulta compleja a la base de datos.
        $sql = "SELECT                              
                    C.nombre AS nombre_clase, 
                    C.id_profesor AS profesor_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.fecha_hora_inicio AS hora_inicio,
                    SE.fecha_hora_fin AS hora_fin,
                    SE.id AS id_sesion1
                  FROM sesiones SE
                  JOIN CLASES C ON SE.id_clases = C.id_clases
                  JOIN SALAS S ON SE.id_salas = S.id_salas 
                  WHERE DAYOFWEEK(fecha_hora_inicio) = $dia AND HOUR(fecha_hora_inicio) = $hora";
        $result = mysqli_query($conexion, $sql); //Conjunto de resultados de msqli query.
        $sesion = mysqli_fetch_assoc($result);   //Se guarda el resultado del msqli query como array asociativo.
       
        //  A Ñ A D I R  - control de errores a la consulta. 

        // M O D I F I C A R   -   Falta la funcionalidad de los botones de registrar y borrar sesión
        //                     -   Mostrar el aforo en la casilla? o mucho texto? o con color?
        //                     -   Idea para el administrador - muestra las sesiones y, en las que se apunte al menos un usuario de un color.


        if ($sesion) {                                //Si en el dia seleccionado hay una sesión

            $date1 = new DateTime($sesion['hora_inicio']); //Hora inicio de la sesion
            $date = new DateTime($sesion['hora_fin']);     //Hora fin de la sesion
            $horacom = $date1->format('H');                //Hora inicio sin minutos
            $usuario = 'pepe';                             //Profesor que está logueado en la web.   I M P O R T A N T E    ta sin hacer.
            $sess = $sesion['id_sesion1'];                 //Id de la sesión
            $profe = $sesion['profesor_clase'];            //Profesor de la sesión
            /*$aforo = $sesion['aforo_sala'];              // M E    D A   E R R O R   R A R O -  Consulta de aforo. Error al hacer consulta, dice que inscripciones no exisite
            echo"$sess A";
            echo"$profe b "; //No me sale profesor en la sesion
            echo"$aforo C ";
                                                           //Consulta para tener un array de los usuarios inscritos, se puede hacer más simple pero está asi por si se modifica la bdd
            $sql = "SELECT                                  
                        I.id_usuario AS usuario_inscrito
                        FROM INSCRIPCIONES I
                        WHERE id_sesion = $sess";
            $result = mysqli_query($conexion, $sql);
            $inscritos = mysqli_fetch_assoc($result);
            $numinscrito = count($inscritos);
            */
                    
            if ( $horacom <= 13) {                    //Si la hora es menor o igual a 13. El else es igual, pero cambia mañana por tarde.
                if($usuario == $profe){              //A su vez, si el usuario logueado es el profesor.
                                                      //Genera la casilla con la clase profesor-mañana.
                    echo "<td class='profesor-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']}  
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} $numinscrito/$aforo <a href='../salas/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
                }else{                                //Si hay sesión pero no es el profesor el usuario, clase con sesion mañana. No puede borrar la sesion.
                    echo "<td class='con-sesion-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')}</p></div>";                
                }
            } else {
                if($usuario == $profe){                //Si el usuario es el profesor, tiene una clase distinta y sale el botón de borrar sesión.
                    echo "<td class='profesor-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a href='../salas/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
                }else{
                    echo "<td class='con-sesion-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} </p></div>";
                }
            }
        } elseif($hora <= 13){                          //De no haber sesión, siendo la hora a las 13 o antes.
            echo "<td class='sin-sesion-mannana'><div ><p> <a href='../calendario/formulario_sesion_calendario.php'><button>Crear sesión</button><a></p></div>";
        }else {                                         //De no haber sesión, después de las 13.
            echo "<td class='sin-sesion-tarde'><div ><p> <a href='../salas/formulario_nueva_sesion.html' ><button>Crear sesión</button><a></p></div>";
        }
        echo "</td>";                                   //Formulario de registro de sesión hecho por mi o el de /salas, no funciona ninguno.
    }

    // D O M I N G O 

    $dia = 1;                                           // Para MySQL, el día 1 es domingo.
    $sql = "SELECT                              
                    C.nombre AS nombre_clase, 
                    C.id_profesor AS profesor_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.fecha_hora_inicio AS hora_inicio,
                    SE.fecha_hora_fin AS hora_fin,
                    SE.id AS id_sesion1
                  FROM sesiones SE
                  JOIN CLASES C ON SE.id_clases = C.id_clases
                  JOIN SALAS S ON SE.id_salas = S.id_salas 
                  WHERE DAYOFWEEK(fecha_hora_inicio) = $dia AND HOUR(fecha_hora_inicio) = $hora";
        $result = mysqli_query($conexion, $sql);
        $sesion = mysqli_fetch_assoc($result);

        if ($sesion) {
            $date1 = new DateTime($sesion['hora_inicio']);
            $date = new DateTime($sesion['hora_fin']);
            $horacom = $date1->format('H');                //Hora inicio sin minutos
            $usuario = 'pepe';                             //Profesor que está logueado en la web.   I M P O R T A N T E    ta sin hacer.
            $sess = $sesion['id_sesion1'];                 //Id de la sesión
            $profe = $sesion['profesor_clase'];            //Profesor de la sesión
            if ( $horacom <= 13) {                         //Igual que durante la semana
                if($usuario == $profe){              
                                                      
                    echo "<td class='profesor-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']}  
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} $numinscrito/$aforo <a href='../salas/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
                }else{                                //Si hay sesión pero no es el profesor el usuario, clase con sesion mañana. No puede borrar la sesion.
                    echo "<td class='con-sesion-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')}</p></div>";                
                }
            } else {
                if($usuario == $profe){                //Si el usuario es el profesor, tiene una clase distinta y sale el botón de borrar sesión.
                    echo "<td class='profesor-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a href='../salas/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
                }else{
                    echo "<td class='con-sesion-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} </p></div>";
                }
            }
        } elseif($hora <= 13){                          //De no haber sesión, siendo la hora a las 13 o antes.
            echo "<td class='sin-sesion-mannana'><div ><p> <a href='../calendario/formulario_sesion_calendario.php'><button>Crear sesión</button><a></p></div>";
        }else {                                         //De no haber sesión, después de las 13.
            echo "<td class='sin-sesion-tarde'><div ><p> <a href='../salas/formulario_nueva_sesion.html' ><button>Crear sesión</button><a></p></div>";
        }
        echo "</td>";                                   //Formulario de registro de sesión hecho por mi o el de /salas, no funciona ninguno.
    }

