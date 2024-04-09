<?php

require_once(__DIR__ . "/../../../models/teacher_models/class_model.php");
require_once(__DIR__ . "/../../role_controller.php");
require_once(__DIR__ . "/../../../models/database.php");

session_start();

$roleController = RoleController::getInstance();
$roleController->isTeacher($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $id_profesor = $_POST['id_profesor'];

  $db = new Database();
  $classModel = new ClassModel();

  $nameExists = $classModel->checkNameClassExists($nombre, $db);

  header("refresh:2;url=../../../views/teacher_panel.php");

  if (!$nameExists) {
    $resultado = $classModel->newClass($nombre, $descripcion, $id_profesor);


    echo "Clase creada con éxito.";
  } else {
    echo "La clase ya existe, prueba con otro nombre.";
  }
  
} else {
  echo "Error: No se ha enviado el formulario de modificación.";
}
