<?php
session_start();
require_once(__DIR__ . "/../../controllers/user/user_controller.php");


  $idSesion = $_GET['id'];
  $idUsuario = $_SESSION['id_usuarios'];
  
  $EnrollmentController = new EnrollmentController();
  $EnrollmentController->unenrollClass($idUsuario, $idSesion);

  