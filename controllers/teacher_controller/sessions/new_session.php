<?php

require_once(__DIR__ . "/../../../models/teacher_models/session_model.php");
require_once(__DIR__ . "/../../role_controller.php");
require_once(__DIR__ . "/../../../models/database.php");

session_start();

$roleController = RoleController::getInstance();
$roleController->isTeacher($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario

  $id_clases = $_POST['id_clase'];
  $id_salas = $_POST['id_sala'];
  $fecha_hora_inicio = $_POST['fecha_hora_inicio'];
  $fecha_hora_fin = $_POST['fecha_hora_inicio'];

  $db = new Database();
  $sessionModel = new SessionModel();

  $resultado = $sessionModel->newSession($id_clases, $id_salas, $fecha_hora_inicio, $fecha_hora_fin);

  header("refresh:2;url=../../../views/teacher_panel.php");
  echo "sesión creada con éxito.";
} else {
  echo "Error: No se ha enviado el formulario de modificación.";
}
