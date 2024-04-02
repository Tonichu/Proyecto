<?php
require_once(__DIR__ . "/../../models/admin_models/user_model.php");

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function registerUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $telefono = $_POST["telefono"];
            $correo = $_POST["correo"];
            $direccion = $_POST["direccion"];
            $pass = $_POST["pass"];
            $pass_confirm = $_POST["pass1"];
            $tipo_usuario = $_POST["tipo_usuario"];
            
            // Verificar si las contraseñas coinciden
            if ($pass !== $pass_confirm) {
                // Manejar el error de contraseñas no coincidentes
                return "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
            } else {
                // Hashear la contraseña
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

                // Procesar la imagen si se ha subido
                $foto = null;
                /*
                if ($_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
                    $foto_temp = $_FILES["foto"]["tmp_name"];
                    $foto_name = $_FILES["foto"]["name"];
                    $foto = "ruta/donde/guardar/".$foto_name;
                    move_uploaded_file($foto_temp, $foto);
                }*/

                // Intentar registrar al usuario
                $registro_exitoso = $this->userModel->createUser($nombre, $apellidos, $telefono, $correo, $direccion, $pass_hash, $tipo_usuario, $foto);

                if ($registro_exitoso) {
                    
                    return "¡Registro exitoso!";
                } else {
                    // Manejar errores de registro
                    return "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
                }
            }
        } else {
            // Si no se ha enviado el formulario, mostrar el formulario de registro
            include_once(__DIR__ . "/../Views/registro_usuario.php");
        }
    }
}

// Ejemplo de uso:
// $userController = new UserController();
// echo $userController->registerUser();
?>