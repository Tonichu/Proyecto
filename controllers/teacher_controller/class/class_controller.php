<?php
require_once(__DIR__ . "/../../../models/teacher_models/class_model.php");



class ClassController
{
  private $classModel;

  public function __construct()
  {
    $this->classModel = new ClassModel();
  }

  public function newClass($nombre, $descripcion, $id_profesor)
  {
    return $this->classModel->newClass($nombre, $descripcion, $id_profesor);
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
      header("refresh:2;url=../../../views/teacher_panel.php");
      if ($this->classModel->deleteClass($id)) {
        // clase eliminado exitosamente
        return "clase eliminada correctamente.";
      } else {
        // Error al eliminar la clase
        return "Error al eliminar la clase.";
      }
    } catch (Exception $e) {
      // Capturar y mostrar cualquier excepción ocurrida
      return "Error: " . $e->getMessage();
    }
  }
}
