<?php

require_once(__DIR__ . "/../admin_controller/room_controller.php");


$roomController = new RoomController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nombre = $_POST['nombre'];
  $aforo = $_POST['aforo'];
  $resultado = $roomController->addRoom($nombre, $aforo);


  header("refresh:2;url=../../views/admin_panel.php");
  if ($resultado) {
    echo "La sala se ha creado correctamente.";
  } else {
    echo "Error al crear la sala.";
  }
}
