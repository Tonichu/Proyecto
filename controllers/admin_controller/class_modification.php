<?php
require_once(__DIR__ . "/../../models/admin_models/class_model.php");

// Verificar si se ha enviado el formulario de modificación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $tipoUsuario = $_POST['tipo_usuario'];

    // Crear una instancia del modelo de usuario
    $userModel = new UserModel();
    header("refresh:2;url=../../views/admin_panel.php");
    // Actualizar el tipo de usuario en la base de datos
    if ($userModel->updateUser($id, $tipoUsuario)) {
        // Redireccionar a la página de panel de control
        echo "Usuario actualizado.";
        exit();
    } else {
        echo "Error al actualizar el tipo de usuario.";
    }
} else {
    echo "Error: No se ha enviado el formulario de modificación.";
}
?>