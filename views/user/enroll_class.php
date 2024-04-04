<?php
session_start();
require_once(__DIR__ . "/../../controllers/user/user_controller.php");


// Verifica si se ha enviado el ID de la sesión a inscribirse

  $idSesion = $_GET['id'];
  $idUsuario = $_SESSION['id_usuarios'];

  $inscripcionController = new InscripcionController();
  $inscripcionController->enrollClass($idUsuario, $idSesion);
