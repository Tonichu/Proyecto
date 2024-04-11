<?php

class TeacherQueries
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }
  
  public function getAllClasses()
  {
    $id_usuario = $_SESSION["id_usuarios"];
    $query = "SELECT * from clases where id_profesor = ?";
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
      die("Error en la preparación de la consulta: " . $this->db->errorInfo());
    }
    if (!$stmt->execute([$id_usuario])) {
      die("Error al ejecutar la consulta: " . $stmt->errorInfo());
    }
    return $stmt;
  }
  public function getTeacherById($id)
  {
    $sql = "SELECT * FROM usuarios WHERE id_usuarios = ?";
    $statement = $this->db->prepare($sql);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->execute();

    // Obtener el resultado de la consulta
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);

    // Devolver el usuario encontrado
    return $usuario;
  }
  public function getAllRooms()
  {
    $query = "SELECT * FROM salas";
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
      die("Error en la preparación de la consulta: " . $this->db->errorInfo());
    }
    if (!$stmt->execute()) {
      die("Error al ejecutar la consulta: " . $stmt->errorInfo());
    }
    return $stmt;
  }

  public function inscriptionResult()
  {
    $id_usuario = $_SESSION["id_usuarios"];
    $query = "SELECT sesiones.id, clases.nombre AS nombre_clase, salas.nombre AS nombre_sala, sesiones.fecha_hora_inicio, sesiones.fecha_hora_fin 
  FROM sesiones 
  INNER JOIN clases ON sesiones.id_clases = clases.id_clases
  INNER JOIN salas ON sesiones.id_salas = salas.id_salas 
  WHERE clases.id_profesor = ?";
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
      die("Error en la preparación de la consulta: " . $this->db->errorInfo());
    }
    if (!$stmt->execute([$id_usuario])) {
      die("Error al ejecutar la consulta: " . $stmt->errorInfo());
    }
    return $stmt;
  }

  public function updateTeacher($id, $nombre, $apellidos, $telefono, $correo_electronico, $direccion, $pass_confirm = null)
  {
    try {
      // Construir la consulta SQL base
      $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono, correo_electronico = :correo_electronico, direccion = :direccion, pass = :hash_pass WHERE id_usuarios = :id";

      $statement = $this->db->prepare($sql);

      // Asignar valores a los parámetros
      $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $statement->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
      $statement->bindParam(':telefono', $telefono, PDO::PARAM_STR);
      $statement->bindParam(':correo_electronico', $correo_electronico, PDO::PARAM_STR);
      $statement->bindParam(':direccion', $direccion, PDO::PARAM_STR);
      $statement->bindParam(':hash_pass', $pass_confirm, PDO::PARAM_STR);

      // Asignar el parámetro de ID
      $statement->bindParam(':id', $id, PDO::PARAM_INT);

      // Ejecutar la consulta
      $statement->execute();

      return true;
    } catch (PDOException $e) {
      echo "Error al actualizar el profesor: " . $e->getMessage();
      return false;
    }
  }
}
