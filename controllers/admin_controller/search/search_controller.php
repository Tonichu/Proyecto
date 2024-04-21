<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <!-- Incluye el archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 20px;
        }

        .table thead tr {
            text-align: center;
        }

        .table tbody tr {
            text-align: center;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .btn-primary {
            margin-right: 5px;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <?php

    // Incluir el modelo de búsqueda
    require_once (__DIR__ . "/../../../models/admin_models/search.php");

    // Función para obtener el nombre del tipo de usuario
    function getUserType($type)
    {
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
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'>";
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
            echo "</thead>";
            echo "<tbody>";

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

                // Agregar botones de modificar y eliminar con clases de Bootstrap
                echo "<td>";
                switch ($table) {
                    case 'usuarios':
                        echo "<a href='../../../views/admin/users/user_modification_from_admin.php?id={$result[$idFieldName]}' class='btn btn-primary'>Modificar</a>";

                        echo "<a href='../user/delete_user.php?id={$result[$idFieldName]}' class='btn btn-danger'>Eliminar</a>";
                        break;
                    case 'clases':
                        echo "<a href='../../../views/admin/class/class_modification_from_admin.php?id={$result[$idFieldName]}' class='btn btn-primary'>Modificar</a>";
                        echo "<a href='../class/delete_class.php?id={$result[$idFieldName]}' class='btn btn-danger'>Eliminar</a>";
                        break;
                    case 'salas':
                        echo "<a href='../../../views/admin/room/room_modification_from_admin.php?id={$result[$idFieldName]}' class='btn btn-primary'>Modificar</a>";
                        echo "<a href='../room/delete_room.php?id={$result[$idFieldName]}' class='btn btn-danger'>Eliminar</a>";
                        break;
                    case 'maquinas':
                        echo "<a href='../../../views/admin/machine/machine_modification_from_admin.php?id={$result[$idFieldName]}' class='btn btn-primary'>Modificar</a>";
                        echo "<a href='../machine/delete_machine.php?id={$result[$idFieldName]}' class='btn btn-danger'>Eliminar</a>";
                        break;
                    default:
                        echo "No se encontró la tabla";
                        break;
                }
                echo "</td>";

                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No se encontraron resultados para la búsqueda en la tabla $table.</p>";
        }
    }

    ?>
    <div class="btn-container">
        <a href="../../../views/admin_panel.php" class="btn btn-primary btn-administrador">Volver al administrador</a>
    </div>

</body>

</html>