<?php
require_once(__DIR__ . "/../../../models/teacher_models/session_model.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $id_clases = $_POST['clase'];
  $id_salas = $_POST['sala'];
  $fecha_hora_inicio = $_POST['fecha_hora_inicio'];
  $fecha_hora_fin = $_POST['fecha_hora_fin'];


  $SessionModel = new SessionModel();

  $result = $SessionModel->updateSession($id, $id_clases, $id_salas, $fecha_hora_inicio, $fecha_hora_fin);

  header("refresh:2;url=../../../views/teacher_panel.php");
  if ($result) {
    echo "sesión actualizada.";
    exit();
  } else {
    echo "Error al actualizar la sesión.";
  }
}
