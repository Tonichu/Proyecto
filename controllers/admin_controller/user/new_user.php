<?php


require_once(__DIR__ . "/user_controller.php");
require_once(__DIR__ . "/../../../models/admin_models/user_model.php");
require_once(__DIR__ . "/../../../models/database.php");

$database = new Database();

// Creamos una instancia de UserController pasando la instancia de Database como parámetro y registramos al usuario
$userController = new UserController($database);
echo $userController->registerUser();