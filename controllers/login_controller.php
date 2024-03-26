<?php

class LoginController {
    private $usuarioModel;

    public function __construct($usuarioModel) {
        $this->usuarioModel = $usuarioModel;
    }

    public function comprobarUsuario($correo, $pass) {
        $usuario = $this->usuarioModel->getUserByEmail($correo);

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