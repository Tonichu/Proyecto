<?php
require_once(__DIR__ . "/../models/admin_queries.php");
class rowQueries
{
    public function rowQueries()
    {
        session_start();
        $db = 0;
        $adminQueries = new AdminQueries($db);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero_filas"])) {
          // Obtener el número de filas del formulario
          $numeroFilas = $_POST["numero_filas"];
          
          // Verificar si el número de filas es válido y llamar a setLimit si es así
          if (is_numeric($numeroFilas) && $numeroFilas >= 1 && $numeroFilas <= 10) {
      
              $adminQueries->setLimit($numeroFilas);
              
              // Redirigir a la página donde se muestra la lista de usuarios u otra acción
          } else {
              echo "Por favor ingrese un número válido entre 1 y 10.";
          }
      }
  
    }
}

// Instanciar y ejecutar el controlador
$filasController = new FilasController();
$filasController->procesarFormulario();
?>