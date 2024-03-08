<?php
session_start();

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mostrar"])) {
    // Obtener el número de filas del formulario
    $numero_filas = $_POST["numero_filas"];
    // Verificar si se proporcionó un número válido
    if (is_numeric($numero_filas) && $numero_filas > 0 && $numero_filas <= 10) {
        // Construir la consulta SQL con el nuevo número de filas
        $queryUsers = "SELECT * FROM USUARIOS LIMIT $numero_filas";
        echo $numero_filas." Consulta =" . $queryUsers;

        // Redirigir de vuelta a panelDeControl.php con los datos actualizados
        $_SESSION["numero_filas"] = $numero_filas;
        header("Location: ../pages/usuarios/panel_de_control.php?filas=$numero_filas");
        exit();
    } else {
        echo "Por favor, ingrese un número válido de filas.";
        header("refresh:1;url=../pages/usuarios/panel_de_control.php");
        exit();
    }
}
?>