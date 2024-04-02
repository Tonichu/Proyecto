<?php
require_once(__DIR__."/../../ConexionBdd/conexion_bdd.php");

class UserModel {
    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE correo_electronico=:email";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    public function createUser($nombre, $apellidos, $telefono, $correo, $direccion, $pass_hash, $tipo_usuario, $foto)
  {
    $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, correo_electronico, direccion, pass, tipo_usuarios, foto) VALUES (:nombre, :apellidos, :telefono, :correo, :direccion, :pass, :tipo_usuario, :foto)";
    $statement = $this->connection->prepare($sql);
    $success = $statement->execute(array(
      ':nombre' => $nombre,
      ':apellidos' => $apellidos,
      ':telefono' => $telefono,
      ':correo' => $correo,
      ':direccion' => $direccion,
      ':pass' => $pass_hash,
      ':tipo_usuario' => $tipo_usuario,
      ':foto' => $foto
    ));

    return $success;
  }
}
?>