<?php

// Incluir el modelo de búsqueda
require_once(__DIR__ . "/../../../models/admin_models/search.php");

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
        echo "<ul>";
        foreach ($results as $result) {
            echo "<li>";
            // Imprimir cada campo del resultado
            foreach ($result as $key => $value) {
                if ($key === 'tipo_usuarios') {
                    // Traducir el tipo de usuario
                    switch ($value) {
                        case 0:
                            echo "<strong>Tipo de usuario:</strong> Admin<br>";
                            break;
                        case 1:
                            echo "<strong>Tipo de usuario:</strong> Profesor<br>";
                            break;
                        case 2:
                            echo "<strong>Tipo de usuario:</strong> Usuario<br>";
                            break;
                        default:
                            echo "<strong>Tipo de usuario:</strong> Desconocido<br>";
                            break;
                    }
                } else {
                    echo "<strong>$key:</strong> $value<br>";
                }
            }
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No se encontraron resultados para la búsqueda en la tabla $table.</p>";
    }
}
?>
