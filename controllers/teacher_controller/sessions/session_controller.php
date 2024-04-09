<?php
require_once(__DIR__ . "/../../../models/teacher_models/session_model.php");



class SessionController
{
  private $SessionController;

  public function __construct()
  {
    $this->SessionController = new SessionModel();
  }

  public function newSession($id_clases, $id_salas, $fecha_hora_inicio, $fecha_hora_fin)
  {
    return $this->SessionController->newSession($id_clases, $id_salas, $fecha_hora_inicio, $fecha_hora_fin);
  }

  public function deleteSession($id)
  {
    try {
      // Llamar al método eliminar sesion del modelo
      header("refresh:2;url=../../../views/teacher_panel.php");
      if ($this->SessionController->deleteSession($id)) {
        // sesion eliminada exitosamente
        return "sesión eliminada correctamente.";
      } else {
        // Error al eliminar la sesión
        return "Error al eliminar la sesión.";
      }
    } catch (Exception $e) {
      // Capturar y mostrar cualquier excepción ocurrida
      return "Error: " . $e->getMessage();
    }
  }

  
  
}
