<?php
session_start();

require_once(__DIR__ . "/../models/user_models/user_queries.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $pass = $_POST['pass'];
    // Obtener la foto de perfil del formulario

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Obtener la foto de perfil del formulario
        $foto_temp = $_FILES['foto']['tmp_name'];
        // Leer la imagen en binario
        $foto_contenido = file_get_contents($foto_temp);
    } else {
        // Si no se ha subido ninguna foto, establecer la foto en null
        $foto_contenido = null;
    }



    /*
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_nombre = $_FILES['foto']['name'];

    // Leer la imagen en binario
    $foto_contenido = file_get_contents($foto_temp);
*/
    // Insertar el nuevo usuario en la base de datos
    // Verificar si el usuario ya existe
    $userQueries = new UserQueries();

    $result = $userQueries->userExistsByEmail($correo);
    header("refresh:2; ../index.php");
    if ($result === null) {
        // Si hay un error en la consulta SQL, mostrar el mensaje de error
        echo "Error en la consulta SQL: No se pudo ejecutar la consulta.";
    } else {
        if ($result) {
            // Si el usuario ya existe, mostrar un mensaje de error y volver a intentarlo
            echo "El usuario ya existe. Por favor, intenta con otro nombre de usuario o reinicia la contraseña.";
        } else {
            // Crear un hash de la contraseña
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            // Insertar los datos del nuevo usuario en la tabla "usuarios" con la foto de perfil
            $success = $userQueries->insertNewUser($nombre, $apellidos, $telefono, $correo, $direccion, $pass_hash, $foto_contenido);
           
            if ($success) {
                echo "Usuario creado con éxito, ya puedes acceder desde <strong>área clientes.</strong>";
            } else {
                echo "Error al crear usuario.";
            }
        }
    }
}
?>
