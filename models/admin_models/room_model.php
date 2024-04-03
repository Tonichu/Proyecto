<?php

require_once(__DIR__ . "/../../models/database.php");

class roomModel
{
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->getConnection();
  }

  public function addRoom($nombre, $aforo)
  {
      try {
          $sql = "INSERT INTO salas (nombre, aforo) VALUES (?, ?)";
          $statement = $this->connection->prepare($sql);
          $statement->bindParam(1, $nombre, PDO::PARAM_STR);
          $statement->bindParam(2, $aforo, PDO::PARAM_STR);
          return $statement->execute();
      } catch (PDOException $e) {
          die("Error al insertar la sala: " . $e->getMessage());
      }
  }

  public function deleteRoom($id)
    {
      $sql = "DELETE FROM salas WHERE id_salas = ?";
  
      $statement = $this->connection->prepare($sql);
      $statement->bindParam(1, $id, PDO::PARAM_INT);
  
      if ($statement->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getRooms()
    {
        try {
            $sql = "SELECT * FROM salas";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $rooms = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $rooms;
        } catch (PDOException $e) {
            echo "Error al obtener los detalles de la sala: " . $e->getMessage();
            return null;
        }
    }

    public function getRoomById($id)
    {
        try {
            $sql = "SELECT * FROM salas WHERE id_salas = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->execute();
            $rooms = $statement->fetch(PDO::FETCH_ASSOC);
            return $rooms;
        } catch (PDOException $e) {
            echo "Error al obtener los detalles de la sala: " . $e->getMessage();
            return null;
        }
    }

    public function updateRoom($id, $nombre, $aforo)
    {
        try {
            $sql = "UPDATE salas SET nombre = :nombre, aforo = :aforo WHERE id_salas = :id";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':aforo', $aforo, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar la sala: " . $e->getMessage();
            return false;
        }
    }
}
