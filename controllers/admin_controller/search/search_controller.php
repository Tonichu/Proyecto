<?php

// Incluir el modelo de búsqueda
require_once(__DIR__ . "/../../../models/admin_models/search.php");

// Función para obtener el nombre del tipo de usuario
function getUserType($type) {
    switch ($type) {
        case 0:
            return "Administrador";
        case 1:
            return "Profesor";
        case 2:
            return "Usuario";
        default:
            return "Desconocido";
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $table = $_POST['tabla'];
    $search = $_POST['busqueda'];
  
    // Instanciar el objeto de búsqueda
    $searchObj = new Search();

    // Realizar la búsqueda en la tabla especificada
    $results = $searchObj->searchInTable($table, $search);

    // Mostrar los resultados
    if ($results) {
        echo "<h2>Resultados de la búsqueda en la tabla $table:</h2>";
        echo "<table border='1'>";
        echo "<tr>";
        
        // Imprimir los encabezados de la tabla
        switch ($table) {
            case 'usuarios':
                echo "<th>ID</th><th>Nombre</th><th>Apellidos</th><th>Teléfono</th><th>Correo Electrónico</th><th>Dirección</th><th>Tipo de Usuario</th>";
                break;
            case 'clases':
                echo "<th>ID</th><th>Nombre</th><th>Descripción</th><th>ID del Profesor</th>";
                break;
            case 'salas':
                echo "<th>ID</th><th>Nombre</th><th>Aforo</th>";
                break;
            case 'maquinas':
                echo "<th>ID</th><th>Nombre</th><th>Descripción</th><th>Fecha de Adquisición</th><th>Última Revisión</th><th>ID de la Sala</th>";
                break;
            default:
                // Si la tabla no está definida, seleccionar todos los campos
                echo "<th>ID</th><th>Nombre</th><th>Descripción</th><th>ID del Profesor</th>";
                break;
        }
        
        echo "<th>Acciones</th>"; // Agregar una columna para acciones
        echo "</tr>";
        
        foreach ($results as $result) {
            echo "<tr>";
            
            // Imprimir cada campo del resultado
            foreach ($result as $key => $value) {
                if ($key === 'tipo_usuarios') {
                    // Obtener el nombre del tipo de usuario
                    $userType = getUserType($value);
                    echo "<td>$userType</td>";
                } else {
                    echo "<td>$value</td>";
                }
            }
            
            // Obtener el nombre del campo de ID correspondiente
            $idFieldName = "";
            switch ($table) {
                case 'usuarios':
                    $idFieldName = "id_usuarios";
                    break;
                case 'clases':
                    $idFieldName = "id_clases";
                    break;
                case 'salas':
                    $idFieldName = "id_salas";
                    break;
                case 'maquinas':
                    $idFieldName = "id_maquina";
                    break;
                default:
                    $idFieldName = "id";
                    break;
            }
            
            // Agregar botones de modificar y eliminar
            echo "<td>";
            switch ($table) {
                case 'usuarios':
                    echo "<a href='../../../views/admin/users/user_modification_from_admin.php?id={$result[$idFieldName]}'><button>Modificar</button></a>";
                    
                    echo "<a href='../user/delete_user.php?id={$result[$idFieldName]}'><button>Eliminar</button></a>";
                    break;
                case 'clases':
                    echo "<a href='../../../views/admin/class/class_modification_from_admin.php?id={$result[$idFieldName]}'><button>Modificar</button></a>";
                    echo "<a href='../class/delete_class.php?id={$result[$idFieldName]}'><button>Eliminar</button></a>";
                    break;
                case 'salas':
                    echo "<a href='../../../views/admin/room/room_modification_from_admin.php?id={$result[$idFieldName]}'><button>Modificar</button></a>";
                    echo "<a href='../room/delete_room.php?id={$result[$idFieldName]}'><button>Eliminar</button></a>";
                    break;
                case 'maquinas':
                    echo "<a href='../../../views/admin/machine/machine_modification_from_admin.php?id={$result[$idFieldName]}'><button>Modificar</button></a>";
                    echo "<a href='../machine/delete_machine.php?id={$result[$idFieldName]}'><button>Eliminar</button></a>";
                    break;
                default:
                    echo "No se encontro la tabla";
                    break;
            }
            echo "</td>";
            
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No se encontraron resultados para la búsqueda en la tabla $table.</p>";
    }
}

?>
<a href="../../../views/admin_panel.php"><button>Volver al administrador</button></a>



