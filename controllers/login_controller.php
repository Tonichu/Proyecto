<?php

class LoginController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function checkUser($mail, $pass) {
        $usuario = $this->userModel->getUserByEmail($mail);

        if (!$usuario) {
            return "Credenciales inválidas. Tu correo electrónico no está dado de alta.";
        } else {
            $hash = $usuario['pass'];

            if (password_verify($pass, $hash)) {
                return $usuario;
            } else {
                return "Credenciales inválidas. Tu contraseña es inválida.";
            }
        }
    }
}
?>