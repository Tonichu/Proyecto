<?php

class UsuarioModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByEmail($correo) {
        $query = "SELECT * FROM USUARIOS WHERE correo_electronico = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->errorInfo());
        }
        if (!$stmt->execute([$correo])) {
            die("Error al ejecutar la consulta: " . $stmt->errorInfo());
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>