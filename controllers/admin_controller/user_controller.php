<?php
require_once(__DIR__ . "/../../models/admin_models/user_model.php");
require_once(__DIR__ . "/../../models/database.php");

class UserController
{
    private UserModel $userModel;
    private Database $db;

    public function __construct(Database $database)
    {
        $this->userModel = new UserModel();
        $this->db = $database;
    }

    public function registerUser()
    {
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
                // Verificar si el correo electrónico ya está en uso
                $correo_existente = $this->userModel->checkEmailExists($correo, $this->db);
                if ($correo_existente) {
                    return "El correo electrónico ya está en uso. Por favor, utilice otro correo electrónico.";
                }

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
                $registro_exitoso = $this->userModel->createUser($nombre, $apellidos, $telefono, $correo, $direccion, $pass_hash, $tipo_usuario, $foto, $this->db);

                header("refresh:2;url=../../views/admin_panel.php");
                if ($registro_exitoso) {
                    return "¡Registro exitoso!";
                } else {
                    // Manejar errores de registro
                    return "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
                }
            }
        } 
    }
    public function deleteUser(int $id)
    {
        try {
            // Llamar al método eliminarUsuario del modelo
            header("refresh:2;url=../../views/admin_panel.php");
            if ($this->userModel->deleteUser($id)) {
                // Usuario eliminado exitosamente
                return "Usuario eliminado correctamente.";
            } else {
                // Error al eliminar usuario
                return "Error al eliminar usuario.";
            }
            
        } catch (Exception $e) {
            header("refresh:2;url=../../views/admin_panel.php");
            // Capturar y mostrar cualquier excepción ocurrida
            return "Error: " . $e->getMessage();
        }
    }
}


