<?php
// RoleController.php

class RoleController {
    private static $instance;
    
    
    private function __construct() {
        // Constructor privado para prevenir la instanciación directa
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new RoleController();
        }
        return self::$instance;
    }

    public function isTeacher($session) {
        if (!isset($session["tipo_usuarios"]) || !isset($session["id_usuarios"])) {
            echo "Acceso denegado. Debes iniciar sesión.";
            header("refresh:2; ../../index.php");
            exit;
        }
        if ($session["tipo_usuarios"] == 0) {
            echo "Acceso denegado. Debes ser un profesor.";
            header("refresh:2; ../views/admin_panel.php");
            exit;
        } elseif ($session["tipo_usuarios"] == 2) {
            echo "Acceso denegado. No tienes permiso para acceder a esta página.";
            header("refresh:2; ../views/user_panel.php");
            exit;
        }
    }

    public function isAdmin($session) {
        if (!isset($session["tipo_usuarios"]) || !isset($session["id_usuarios"])) {
            echo "Acceso denegado. Debes iniciar sesión.";
            header("refresh:2; ../../index.php");
            exit;
        }
        if ($session["tipo_usuarios"] == 1) {
            echo "Acceso denegado. Debes ser un administrador.";
            header("refresh:2; ../views/teacher_panel.php");
            exit;
        } elseif ($session["tipo_usuarios"] == 2) {
            echo "Acceso denegado. No tienes permiso para acceder a esta página.";
            header("refresh:2; ../views/user_panel.php");
            exit;
        }
    }

    public function isUser($session) {
        if (!isset($session["tipo_usuarios"]) || !isset($session["id_usuarios"])) {
            echo "Acceso denegado. Debes iniciar sesión.";
            header("refresh:2; ../../index.php");
            exit;
        }
        if ($session["tipo_usuarios"] == 0) {
            echo "Acceso denegado. Debes ser un usuario normal.";
            header("refresh:2; ../views/admin_panel.php");
            exit;
        } elseif ($session["tipo_usuarios"] == 1) {
            echo "Acceso denegado. Debes ser un usuario normal.";
            header("refresh:2; ../views/teacher_panel.php");
            exit;
        }
    }
}
?>