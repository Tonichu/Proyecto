<?php

class UserController {
    public function index() {
        // Cargar modelo
        require_once('../app/models/UserModel.php');
        
        // Obtener datos de usuarios
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        
        // Cargar vista
        require_once('../app/views/index.php');
    }
}

?>