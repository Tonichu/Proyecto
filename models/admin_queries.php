<?php

class AdminQueries
{
  private $db;
  private $limit =3;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function setLimit($limit)
  {
    if (is_numeric($limit) && $limit >= 1 && $limit <= 10) {
      $this->limit = $limit;
    } else {
      echo "Por favor ingrese un número válido entre 1 y 10.";
    }
  }

  public function getAllUsers()
  {
    $id_usuarios = $_SESSION["id_usuarios"];
    $query = "SELECT * FROM usuarios WHERE id_usuarios != ? LIMIT " . $this->limit;
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
      die("Error en la preparación de la consulta: " . $this->db->errorInfo());
    }
    if (!$stmt->execute([$id_usuarios])) {
      die("Error al ejecutar la consulta: " . $stmt->errorInfo());
    }
    return $stmt;
  }

  public function getAllClasses()
  {
    $query = "SELECT c.id_clases, c.nombre, c.descripcion, u.nombre AS nombre_profesor, u.correo_electronico AS email_profesor
    FROM clases c 
    LEFT JOIN usuarios u ON c.id_profesor = u.id_usuarios LIMIT " . $this->limit;
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
      die("Error en la preparación de la consulta: " . $this->db->errorInfo());
    }
    if (!$stmt->execute()) {
      die("Error al ejecutar la consulta: " . $stmt->errorInfo());
    }
    return $stmt;
  }

  public function getAllRoom()
  {
    $query = "SELECT * FROM salas LIMIT " . $this->limit;
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
      die("Error en la preparación de la consulta: " . $this->db->errorInfo());
    }
    if (!$stmt->execute()) {
      die("Error al ejecutar la consulta: " . $stmt->errorInfo());
    }
    return $stmt;
  }

  public function getAllMachines()
  {
    $query = "SELECT maquinas.id_maquina, maquinas.nombre, maquinas.descripcion, maquinas.fecha_adquisicion, maquinas.ultima_revision, salas.nombre AS nombre_sala
    FROM maquinas
    INNER JOIN salas ON maquinas.id_sala = salas.id_salas LIMIT " . $this->limit;;
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
      die("Error en la preparación de la consulta: " . $this->db->errorInfo());
    }
    if (!$stmt->execute()) {
      die("Error al ejecutar la consulta: " . $stmt->errorInfo());
    }
    return $stmt;
  }
}
