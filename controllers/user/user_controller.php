<?php

require_once(__DIR__ . "/../../models/user_models/user_queries.php");

class EnrollmentController
{
    public function enrollClass($idUsuario, $idSesion)
    {
        $userQueries = new UserQueries();
        $userQueries->enrollInClass($idUsuario, $idSesion);
        header("refresh:2;url= ../../views/user_panel.php");
        echo "Te has inscrito en la clase";

        exit;
    }

    public function unenrollClass($idUsuario, $idSesion)
    {
        $userQueries = new UserQueries();
        $userQueries->cancelEnrollment($idUsuario, $idSesion);
        header("refresh:2;url= ../../views/user_panel.php");
        echo "Te has borrado de la clase";
        
        exit;
    }
}
