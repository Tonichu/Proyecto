<?php
// RoleController.php

class RoleController
{
    private static $instance;


    private function __construct()
    {
        // Constructor privado para prevenir la instanciación directa
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new RoleController();
        }
        return self::$instance;
    }


    public function redirectToIndex()
    {
        session_start();

        // Obtén la ruta base de la sesión
        $basePath = $_SESSION['root'];

        // Redirecciona a la página index.php utilizando la ruta base
        header("Location: $basePath");
        exit;
    }

    public function redirectToTeacher()
    {
        session_start();

        if (isset($_SESSION['root']) && !empty($_SESSION['root'])) {
            $rootTeacher = "/views/teacher_panel.php";
            $fullRoute = $_SESSION['root'] . $rootTeacher;
            header("Location: $fullRoute");
            exit;
        } else {
            echo "Error: la ruta base no está definida en la sesión.";
            exit;
        }
    }

    public function redirectToUser()
    {
        session_start();

        if (isset($_SESSION['root']) && !empty($_SESSION['root'])) {
            $rootTeacher = "/views/user_panel.php";
            $fullRoute = $_SESSION['root'] . $rootTeacher;
            header("Location: $fullRoute");
            exit;
        } else {
            echo "Error: la ruta base no está definida en la sesión.";
            exit;
        }
    }
    public function redirectToAdmin()
    {
        session_start();

        if (isset($_SESSION['root']) && !empty($_SESSION['root'])) {
            $rootTeacher = "/views/admin_panel.php";
            $fullRoute = $_SESSION['root'] . $rootTeacher;
            header("Location: $fullRoute");
            exit;
        } else {
            echo "Error: la ruta base no está definida en la sesión.";
            exit;
        }
    }

    public function isTeacher($session)
    {
        if (!isset($session["tipo_usuarios"]) || !isset($session["id_usuarios"])) {
            $this->redirectToIndex();
            exit;
        }
        if ($session["tipo_usuarios"] == 0) {
            $this->redirectToAdmin();
            exit;
        } elseif ($session["tipo_usuarios"] == 2) {
            $this->redirectToUser();
            exit;
        }
    }

    public function isAdmin($session)
    {
        if (!isset($session["tipo_usuarios"]) || !isset($session["id_usuarios"])) {
            echo "Acceso denegado. Debes iniciar sesión.";
            $this->redirectToIndex();
            exit;
        }
        if ($session["tipo_usuarios"] == 1) {
            echo "Acceso denegado. Debes ser un administrador.";
            $this->redirectToTeacher();
            exit;
        } elseif ($session["tipo_usuarios"] == 2) {
            echo "Acceso denegado. No tienes permiso para acceder a esta página.";
            $this->redirectToUser();
            exit;
        }
    }

    public function isUser($session)
    {
        if (!isset($session["tipo_usuarios"]) || !isset($session["id_usuarios"])) {
            echo "Acceso denegado. Debes iniciar sesión.";
            $this->redirectToIndex();
            exit;
        }
        if ($session["tipo_usuarios"] == 0) {
            echo "Acceso denegado. Debes ser un usuario normal.";
            $this->redirectToAdmin();
            exit;
        } elseif ($session["tipo_usuarios"] == 1) {
            echo "Acceso denegado. Debes ser un usuario normal.";
            $this->redirectToTeacher();
            exit;
        }
    }
}
