User
<?php

require_once(__DIR__ . "/../../models/database.php");
require_once(__DIR__ . "/../../models/calendar_models/calendar_queries.php");
session_start();

$database = new Database();
$conexion = $database->getConnection();

$calendarQueries = new CalendarQueries(); // Crear una instancia de CalendarQueries

for ($hora = 8; $hora <= 20; $hora++) {             
    echo "<tr>";                                    
    if ($hora <= 13) {                              
        echo "<td class='mannana'<div >$hora:00</div></td>";
    } else echo "<td class='tarde'<div >$hora:00</div></td>";

    for ($dia = 2; $dia <= 7; $dia++) {             
        
        // Obtener la sesión utilizando la clase CalendarQueries
        $sesion = $calendarQueries->getSesion($dia, $hora);
       
        if ($sesion) {                                
            $date1 = new DateTime($sesion['hora_inicio']); 
            $date = new DateTime($sesion['hora_fin']);     
            $horacom = $date1->format('H');                
            $usuario = 'pepe';                             
            $sess = $sesion['id_sesion1'];                 
            $profe = $sesion['profesor_clase'];            

            if ( $horacom <= 13) {                    
                if($usuario == $profe){              
                    echo "<td class='profesor-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']}  
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} $numinscrito/$aforo <a href='../salas/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
                }else{
                    echo "<td class='con-sesion-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                    - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')}</p></div>";                
                }
            } else {
                if($usuario == $profe){                
                    echo "<td class='profesor-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a href='../salas/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
                }else{
                    echo "<td class='con-sesion-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} </p></div>";
                }
            }
        } elseif($hora <= 13){                          
            echo "<td class='sin-sesion-mannana'><div ><p> <a href='../calendario/formulario_sesion_calendario.php'><button>Crear sesión</button><a></p></div>";
        }else {                                         
            echo "<td class='sin-sesion-tarde'><div ><p> <a href='../salas/formulario_nueva_sesion.html' ><button>Crear sesión</button><a></p></div>";
        }
        echo "</td>";                                   
    }

    $dia = 1;                                           
    $sesion = $calendarQueries->getSesion($dia, $hora); // Obtener la sesión para el domingo
    if ($sesion) {
        $date1 = new DateTime($sesion['hora_inicio']);
        $date = new DateTime($sesion['hora_fin']);
        $horacom = $date1->format('H');                
        $usuario = 'maría';                             
        $sess = $sesion['id_sesion1'];                 
        $profe = $sesion['profesor_clase'];            
        if ( $horacom <= 13) {                         
            if($usuario == $profe){              
                                                  
                echo "<td class='profesor-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']}  
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} $numinscrito/$aforo <a href='../sesiones/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
            }else{                                
                echo "<td class='con-sesion-mannana'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
                - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')}</p></div>";                
            }
        } else {
            if($usuario == $profe){                
                echo "<td class='profesor-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
            - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} <a href='../sesiones/eliminar_sesion.php' ><button>Borrar sesión</button><a></p></div>";
            }else{
                echo "<td class='con-sesion-tarde'><div><p >{$sesion['nombre_clase']} en {$sesion['nombre_sala']} 
            - Inicio: {$date1->format('H:i')} / Fin: {$date->format('H:i')} </p></div>";
            }
        }
    } elseif($hora <= 13){                          
        echo "<td class='sin-sesion-mannana'><div ><p> <a href='../calendario/formulario_sesion_calendario.php'><button>Crear sesión</button><a></p></div>";
    }else {                                         
        echo "<td class='sin-sesion-tarde'><div ><p> <a href='../sesion/formulario_nueva_sesion.html' ><button>Crear sesión</button><a></p></div>";
    }
    echo "</td>";                                  
}
?>