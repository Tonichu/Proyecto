<?php

require_once(__DIR__ . "/../../models/database.php");

class SessionModel
{
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->getConnection();
  }

  public function newSession($id_clases, $id_salas, $fecha_hora_inicio, $fecha_hora_fin)
  {
    try {
      $sql = "INSERT INTO sesiones (id_clases, id_salas, fecha_hora_inicio, fecha_hora_fin) VALUES (?, ?, ?, ?)";
      $statement = $this->connection->prepare($sql);
      $statement->bindParam(1, $id_clases, PDO::PARAM_STR);
      $statement->bindParam(2, $id_salas, PDO::PARAM_STR);
      $statement->bindParam(3, $fecha_hora_inicio, PDO::PARAM_STR);
      $statement->bindParam(4, $fecha_hora_fin, PDO::PARAM_STR);
      return $statement->execute();
    } catch (PDOException $e) {
      die("Error al insertar la sesion: " . $e->getMessage());
    }
  }
  public function deleteSession($id)
  {
    $sql = "DELETE FROM sesiones WHERE id = ?";

    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $id, PDO::PARAM_INT); // Usamos PDO::PARAM_INT para indicar que el parámetro es un entero

    if ($statement->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function updateSession($id, $id_clases, $id_salas, $fecha_hora_inicio, $fecha_hora_fin)
  {
    try {
      $sql = "UPDATE SESIONES SET id_clases = :id_clases, id_salas = :id_salas, fecha_hora_inicio = :fecha_hora_inicio, fecha_hora_fin = :fecha_hora_fin WHERE id = :id";
      $statement = $this->connection->prepare($sql);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->bindParam(':id_clases', $id_clases, PDO::PARAM_INT);
      $statement->bindParam(':id_salas', $id_salas, PDO::PARAM_INT);
      $statement->bindParam(':fecha_hora_inicio', $fecha_hora_inicio, PDO::PARAM_STR);
      $statement->bindParam(':fecha_hora_fin', $fecha_hora_fin, PDO::PARAM_STR);

      $statement->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error al actualizar la clase: " . $e->getMessage();
      return false;
    }

  }
/*
public function getSessionById($id)
{
    try {
        // Preparar la consulta SQL para obtener los detalles de la sesión por su ID
        $sql = "SELECT * FROM sesiones WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->execute();
        
        // Obtener el resultado de la consulta
        $session = $statement->fetch(PDO::FETCH_ASSOC);
        
        // Devolver la sesión encontrada
        return $session;
    } catch (PDOException $e) {
        echo "Error al obtener la sesión: " . $e->getMessage();
        return null;
    }
}
*/
public function getSessionById($id)
{
    try {
        // Preparar la consulta SQL para obtener los detalles de la sesión por su ID
        $sql = "SELECT sesiones.*, clases.nombre AS nombre_clase, salas.nombre AS nombre_sala
                FROM sesiones 
                INNER JOIN clases ON sesiones.id_clases = clases.id_clases
                INNER JOIN salas ON sesiones.id_salas = salas.id_salas
                WHERE sesiones.id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->execute();
        
        // Obtener el resultado de la consulta
        $session = $statement->fetch(PDO::FETCH_ASSOC);
        
        // Devolver la sesión encontrada
        return $session;
    } catch (PDOException $e) {
        echo "Error al obtener la sesión: " . $e->getMessage();
        return null;
    }
}
}
