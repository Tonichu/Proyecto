<?php

require_once(__DIR__ . "/../../models/user_models/user_queries.php");

class EnrollmentController
{
    public function enrollClass($idUsuario, $idSesion)
{
    $userQueries = new UserQueries();
    $message = $userQueries->enrollInClass($idUsuario, $idSesion);
    
    if ($message === "Inscripción exitosa. ¡Bienvenido a la clase!") {
        // La inscripción fue exitosa
        echo $message;
    } else {
        // La inscripción falló
        echo "Lo sentimos, la clase ya está llena. No se pudo inscribir.";
    }

    // Redirigir al usuario después de 2 segundos
    header("refresh:2;url= ../../views/user_panel.php");
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
