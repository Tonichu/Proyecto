<?php

class TeacherQueries{

private $db;

public function __construct($db)
{
  $this->db = $db;
}
public function getAllClasses() {
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

}












?>