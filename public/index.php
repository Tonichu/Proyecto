<?php

// Cargar controlador
require_once('../app/controllers/UserController.php');

$userController = new UserController();
$userController->index();

?>