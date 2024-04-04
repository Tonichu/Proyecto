<?php
require_once(__DIR__ . "/../../models/admin_models/class_model.php");
require_once(__DIR__ . "/../../models/admin_models/user_model.php");


class ClassController
{
  private $classModel;

  public function __construct()
  {
    $this->classModel = new ClassModel();
  }

  public function addClass($nombre, $descripcion, $id_profesor)
  {
    return $this->classModel->addClass($nombre, $descripcion, $id_profesor);
  }

  public function getClassById($id)
  {
    try {
      // Llamar al método getClassById del modelo
      return $this->classModel->getClassById($id);
    } catch (Exception $e) {
      // Capturar y mostrar cualquier excepción ocurrida
      return "Error: " . $e->getMessage();
    }
  }
  public function getViewData($idClase)
  {
    $userModel = new UserModel();
    $professors = $userModel->getProfessors();
    return [
      "professors" => $professors,
      "class" => $this->getClassById($idClase)
    ];
  }

  public function deleteClass($id)
  {
    try {

      // Llamar al método eliminar clase del modelo
      header("refresh:2;url=../../views/admin_panel.php");
      if ($this->classModel->deleteClass($id)) {
        // Usuario eliminado exitosamente
        return "clase eliminado correctamente.";
      } else {
        // Error al eliminar usuario
        return "Error al eliminar la clase.";
      }
    } catch (Exception $e) {
      header("refresh:2;url=../../views/admin_panel.php");
      // Capturar y mostrar cualquier excepción ocurrida
      return "Error: " . $e->getMessage();
    }
  }
}
