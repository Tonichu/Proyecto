<?php

require_once(__DIR__ . "/../../../models/admin_models/machine_model.php");

class machineController
{
    private $machineModel;

    public function __construct()
    {
        $this->machineModel = new machineModel();
    }

    public function addMachine($nombre, $descripcion, $foto, $fecha_adquisicion, $ultima_revision, $id_sala)
    {
        return $this->machineModel->addMachine($nombre, $descripcion, $foto, $fecha_adquisicion, $ultima_revision, $id_sala);
    }

    public function deleteMachine($id)
    {
        try {
            header("refresh:2;url=../../../views/admin_panel.php");
            if ($this->machineModel->deleteMachine($id)) {
                return "Máquina eliminada correctamente.";
            } else {
                return "Error al eliminar la máquina.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getMachineById($id)
    {
        try {
            return $this->machineModel->getMachineById($id);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
