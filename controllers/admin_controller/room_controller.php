<?php

require_once(__DIR__ . "/../../models/admin_models/room_model.php");

class roomController
{
  private $roomModel;

  public function __construct()
  {
    $this->roomModel = new roomModel();
  }

  public function addRoom($nombre, $aforo)
  {
    return $this->roomModel->addRoom($nombre, $aforo);
  }

  public function deleteRoom($id)
  {
    try {

      header("refresh:2;url=../../views/admin_panel.php");
      if ($this->roomModel->deleteRoom($id)) {
        return "sala eliminada correctamente.";
      } else {
        return "Error al eliminar la sala.";
      }
    } catch (Exception $e) {
      return "Error: " . $e->getMessage();
    }
  }

  public function getRoomById($id)
  {
      try {
          return $this->roomModel->getRoomById($id);
      } catch (Exception $e) {
          return "Error: " . $e->getMessage();
      }
  }
}