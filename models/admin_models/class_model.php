<?php

require_once(__DIR__ . "/../../models/database.php");

class ClassModel
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function addClass($nombre, $descripcion, $id_profesor)
    {
        try {
            $sql = "INSERT INTO clases (nombre, descripcion, id_profesor) VALUES (?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $nombre, PDO::PARAM_STR);
            $statement->bindParam(2, $descripcion, PDO::PARAM_STR);
            $statement->bindParam(3, $id_profesor, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $e) {
            die("Error al insertar la clase: " . $e->getMessage());
        }
    }

    public function deleteClass($id)
    {
      $sql = "DELETE FROM clases WHERE id_clases = ?";
  
      $statement = $this->connection->prepare($sql);
      $statement->bindParam(1, $id, PDO::PARAM_INT); // Usamos PDO::PARAM_INT para indicar que el parámetro es un entero
  
      if ($statement->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getClassById($id)
    {
        try {
            $sql = "SELECT * FROM CLASES WHERE id_clases = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->execute();
            $class = $statement->fetch(PDO::FETCH_ASSOC);
            return $class;
        } catch (PDOException $e) {
            echo "Error al obtener los detalles de la clase: " . $e->getMessage();
            return null;
        }
    }

    public function updateClass($id, $nombre, $descripcion, $idProfesor)
    {
        try {
            $sql = "UPDATE CLASES SET nombre = :nombre, descripcion = :descripcion, id_profesor = :idProfesor WHERE id_clases = :id";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam(':idProfesor', $idProfesor, PDO::PARAM_INT);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar la clase: " . $e->getMessage();
            return false;
        }
    }
}
?>