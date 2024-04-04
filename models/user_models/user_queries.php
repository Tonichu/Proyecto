<?php

require_once(__DIR__ . "/../../models/database.php");

class UserQueries
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function getUnenrolledSessions($userId)
    {
        try {
            $sql = "
                SELECT sesiones.id, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin, 
                       clases.nombre AS class_name, salas.nombre AS sala_name, 
                       usuarios.nombre AS profesor_name
                FROM sesiones 
                INNER JOIN clases ON sesiones.id_clases = clases.id_clases 
                INNER JOIN salas ON sesiones.id_salas = salas.id_salas
                LEFT JOIN usuarios ON clases.id_profesor = usuarios.id_usuarios
                WHERE sesiones.id NOT IN (
                    SELECT id_sesion
                    FROM inscripciones
                    WHERE id_usuario = ?
                )";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $userId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener las sesiones no inscritas: " . $e->getMessage());
        }
    }

  public function getEnrolledSessions($userId)
  {
    $sql = "
            SELECT sesiones.id, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin, 
                   clases.nombre AS class_name, salas.nombre AS sala_name, 
                   usuarios.nombre AS profesor_name
            FROM sesiones 
            INNER JOIN clases ON sesiones.id_clases = clases.id_clases 
            INNER JOIN salas ON sesiones.id_salas = salas.id_salas
            LEFT JOIN usuarios ON clases.id_profesor = usuarios.id_usuarios
            INNER JOIN inscripciones ON sesiones.id = inscripciones.id_sesion
            WHERE inscripciones.id_usuario = ?
            ";

    $statement = $this->connection->prepare($sql);
    $statement->execute([$userId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  
  public function enrollInClass($idUsuario, $idSesion)
  {
      try {
          $queryInscripcion = "INSERT INTO INSCRIPCIONES (id_sesion, id_usuario) VALUES (?, ?)";
          $statement = $this->connection->prepare($queryInscripcion);
          $statement->execute([$idSesion, $idUsuario]);
      } catch (PDOException $e) {
          die("Error al inscribirse en la clase: " . $e->getMessage());
      }
  }

  public function cancelEnrollment($idUsuario, $idSesion)
{
    try {
        $queryDesinscripcion = "DELETE FROM INSCRIPCIONES WHERE id_sesion = ? AND id_usuario = ?";
        $statement = $this->connection->prepare($queryDesinscripcion);
        $statement->execute([$idSesion, $idUsuario]);
    } catch (PDOException $e) {
        die("Error al cancelar la inscripción en la clase: " . $e->getMessage());
    }
}
}