<?php
require_once(__DIR__ . "/../../models/database.php");

class UserModel
{
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->getConnection();
  }

  public function deleteUser($id)
  {
    $sql = "DELETE FROM USUARIOS WHERE id_usuarios = ?";

    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $id, PDO::PARAM_INT); // Usamos PDO::PARAM_INT para indicar que el parámetro es un entero

    if ($statement->execute()) {
      return true;
    } else {
      return false;
    }
  }
  
  public function getUserById($id)
  {
      // Preparar la consulta SQL para obtener los detalles del usuario por su ID
      $sql = "SELECT * FROM usuarios WHERE id_usuarios = ?";
      $statement = $this->connection->prepare($sql);
      $statement->bindParam(1, $id, PDO::PARAM_INT);
      $statement->execute();
      
      // Obtener el resultado de la consulta
      $usuario = $statement->fetch(PDO::FETCH_ASSOC);
      
      // Devolver el usuario encontrado
      return $usuario;
  }
  public function updateUser($id, $tipoUsuario)
    {
        $sql = "UPDATE usuarios SET tipo_usuarios = ? WHERE id_usuarios = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $tipoUsuario, PDO::PARAM_INT);
        $statement->bindParam(2, $id, PDO::PARAM_INT);
        return $statement->execute();
    }

  public function getUserByEmail($email)
  {
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
  public function checkEmailExists($correo, $db)
  {
    $query = "SELECT COUNT(*) as count FROM usuarios WHERE correo_electronico = :correo";
    $statement = $db->getConnection()->prepare($query);
    $statement->bindParam(":correo", $correo);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
  }

  public function createUser($nombre, $apellidos, $telefono, $correo, $direccion, $pass_hash, $tipo_usuario, $foto, $db)
  {
    try {
      $query = "INSERT INTO usuarios (nombre, apellidos, telefono, correo_electronico, direccion, pass, tipo_usuarios, foto) VALUES (:nombre, :apellidos, :telefono, :correo, :direccion, :pass_hash, :tipo_usuario, :foto)";
      $statement = $db->getConnection()->prepare($query);
      $statement->bindParam(":nombre", $nombre);
      $statement->bindParam(":apellidos", $apellidos);
      $statement->bindParam(":telefono", $telefono);
      $statement->bindParam(":correo", $correo);
      $statement->bindParam(":direccion", $direccion);
      $statement->bindParam(":pass_hash", $pass_hash);
      $statement->bindParam(":tipo_usuario", $tipo_usuario);
      $statement->bindParam(":foto", $foto);

      // Imprimir la consulta SQL para verificarla
      //echo "Query: " . $query . "<br>";

      // Ejecutar la consulta
      $success = $statement->execute();

      // Devolver el resultado de la ejecución de la consulta
      return $success;
    } catch (PDOException $e) {
      // Manejar errores de PDO
      echo "Error al ejecutar la consulta: " . $e->getMessage();
      return false;
    }
  }
  public function getProfessors()
  {
      try {
          // Preparar la consulta SQL para obtener los usuarios con el rol de profesor
          $sql = "SELECT * FROM usuarios WHERE tipo_usuarios = ?";
          $statement = $this->connection->prepare($sql);
          $tipoProfesor = 1; // Tipo de usuario para profesor
          $statement->bindParam(1, $tipoProfesor, PDO::PARAM_INT);
          $statement->execute();

          // Obtener y devolver los resultados
          return $statement->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
          // Capturar y mostrar cualquier excepción ocurrida
          die("Error al obtener los profesores: " . $e->getMessage());
      }
  }

  
}
