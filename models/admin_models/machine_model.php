<?php

require_once(__DIR__ . "/../../models/database.php");

class machineModel
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function addMachine($nombre, $descripcion, $foto, $fecha_adquisicion, $ultima_revision, $id_sala)
    {
        try {
            $sql = "INSERT INTO Maquinas (nombre, descripcion, foto, fecha_adquisicion, ultima_revision, id_sala) VALUES (?, ?, ?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $nombre, PDO::PARAM_STR);
            $statement->bindParam(2, $descripcion, PDO::PARAM_STR);
            $statement->bindParam(3, $foto, PDO::PARAM_LOB);
            $statement->bindParam(4, $fecha_adquisicion, PDO::PARAM_STR);
            $statement->bindParam(5, $ultima_revision, PDO::PARAM_STR);
            $statement->bindParam(6, $id_sala, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $e) {
            die("Error al insertar la máquina: " . $e->getMessage());
        }
    }

    public function deleteMachine($id)
    {
        $sql = "DELETE FROM Maquinas WHERE id_maquina = ?";
  
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id, PDO::PARAM_INT);
  
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMachineById($id)
    {
        try {
            $sql = "SELECT * FROM Maquinas WHERE id_maquina = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $machine = $statement->fetch(PDO::FETCH_ASSOC);
            return $machine;
        } catch (PDOException $e) {
            echo "Error al obtener los detalles de la máquina: " . $e->getMessage();
            return null;
        }
    }

    public function updateMachine($id, $nombre, $descripcion, $foto, $fecha_adquisicion, $ultima_revision, $id_sala)
    {
        try {
            $sql = "UPDATE Maquinas SET nombre = ?, descripcion = ?, foto = ?, fecha_adquisicion = ?, ultima_revision = ?, id_sala = ? WHERE id_maquina = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $nombre, PDO::PARAM_STR);
            $statement->bindParam(2, $descripcion, PDO::PARAM_STR);
            $statement->bindParam(3, $foto, PDO::PARAM_LOB);
            $statement->bindParam(4, $fecha_adquisicion, PDO::PARAM_STR);
            $statement->bindParam(5, $ultima_revision, PDO::PARAM_STR);
            $statement->bindParam(6, $id_sala, PDO::PARAM_INT);
            $statement->bindParam(7, $id, PDO::PARAM_INT);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar la máquina: " . $e->getMessage();
            return false;
        }
    }
}
?>