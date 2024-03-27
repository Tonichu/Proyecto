<?php
require_once(__DIR__ . "/../models/admin_queries.php");
require_once(__DIR__ . "/../models/database.php");
class rowQueries
{
    public function setRowLimit($limit)
    {
        // Crear una instancia de AdminQueries
        $database = new Database();
        $db = $database->getConnection();
        $adminQueries = new AdminQueries($db);
        
        // Verificar si el número de filas es válido y llamar a setLimit si es así
        if (is_numeric($limit) && $limit >= 1 && $limit <= 10) {
            $adminQueries->setLimit($limit);
            // Redirigir a la página donde se muestra la lista de usuarios u otra acción
        } else {
            echo "Por favor ingrese un número válido entre 1 y 10.";
        }
        header("refresh:5; ../views/admin_panel.php");
    }
}

// Crear una instancia de rowQueries
$rowQueries = new rowQueries();

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero_filas"])) {

    echo $_POST["numero_filas"];
    $rowQueries->setRowLimit($_POST["numero_filas"]);
}
    
