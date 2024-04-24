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

    public function userExistsByEmail($email)
    {
        $sql = "SELECT COUNT(*) AS count FROM usuarios WHERE correo_electronico = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $email, PDO::PARAM_STR);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row['count'] > 0;
    }

    public function insertScore($id_usuario, $totalScore, $fecha_registro)
    {
        // Verificar si ya existe una entrada para este usuario
        $existingScore = $this->getMaxScore($id_usuario);

        if ($totalScore > $existingScore) {
            // La nueva puntuación es mejor, actualizar la entrada existente o insertar una nueva fila
            if ($existingScore !== null) {
                // Ya existe una entrada para este usuario, actualizarla
                $query = "UPDATE PUNTUACIONES SET puntuacion = ?, fecha_registro = ? WHERE id_usuario = ?";
                $stmt = $this->connection->prepare($query);

                if (!$stmt) {
                    die("Error en la preparación de la consulta: " . $this->connection->errorInfo());
                }

                if (!$stmt->execute([$totalScore, $fecha_registro, $id_usuario])) {
                    die("Error al ejecutar la consulta: " . $stmt->errorInfo());
                }
            } else {
                // No existe una entrada para este usuario, insertar una nueva fila
                $query = "INSERT INTO PUNTUACIONES (id_usuario, puntuacion, fecha_registro) VALUES (?, ?, ?)";
                $stmt = $this->connection->prepare($query);

                if (!$stmt) {
                    die("Error en la preparación de la consulta: " . $this->connection->errorInfo());
                }

                if (!$stmt->execute([$id_usuario, $totalScore, $fecha_registro])) {
                    die("Error al ejecutar la consulta: " . $stmt->errorInfo());
                }
            }
            return true; // Indicar que la inserción o actualización fue exitosa
        } else {
            // La nueva puntuación no es mejor, no es necesario actualizar
            return false;
        }
    }

    public function getAllScoresWithUsernames()
    {
        $query = "SELECT PUNTUACIONES.id_puntuacion, USUARIOS.nombre, USUARIOS.apellidos, PUNTUACIONES.puntuacion, PUNTUACIONES.fecha_registro 
                  FROM PUNTUACIONES 
                  INNER JOIN USUARIOS ON PUNTUACIONES.id_usuario = USUARIOS.id_usuarios 
                  ORDER BY PUNTUACIONES.puntuacion DESC 
                  LIMIT 10";

        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->connection->errorInfo());
        }

        if (!$stmt->execute([])) {
            die("Error al ejecutar la consulta: " . $stmt->errorInfo());
        }

        // Obtener todas las filas de resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    private function getMaxScore($id_usuario)
    {
        $query = "SELECT MAX(puntuacion) AS max_score FROM PUNTUACIONES WHERE id_usuario = ?";
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->connection->errorInfo());
        }

        if (!$stmt->execute([$id_usuario])) {
            die("Error al ejecutar la consulta: " . $stmt->errorInfo());
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['max_score'] ?? null; // Si no hay ninguna puntuación existente, se devuelve null
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id_usuarios = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->execute();

        // Obtener el resultado de la consulta
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

        // Devolver el usuario encontrado
        return $usuario;
    }

    public function insertNewUser($nombre, $apellidos, $telefono, $correo_electronico, $direccion, $pass)
    {
        try {
            // Construir la consulta SQL para insertar un nuevo usuario
            $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, correo_electronico, direccion, pass) VALUES (:nombre, :apellidos, :telefono, :correo_electronico, :direccion, :hash_pass)";

            $statement = $this->connection->prepare($sql);

            // Asignar valores a los parámetros
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $statement->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam(':correo_electronico', $correo_electronico, PDO::PARAM_STR);
            $statement->bindParam(':direccion', $direccion, PDO::PARAM_STR);
            $statement->bindParam(':hash_pass', $pass, PDO::PARAM_STR);

            // Ejecutar la consulta
            $statement->execute();

            // Devolver verdadero si la inserción fue exitosa
            return true;
        } catch (PDOException $e) {
            // Manejar cualquier error que ocurra durante la inserción
            echo "Error al insertar un nuevo usuario: " . $e->getMessage();
            return false;
        }
    }

    public function updateUser($id, $nombre, $apellidos, $telefono, $correo_electronico, $direccion, $pass_confirm = null)
    {
        try {
            // Construir la consulta SQL base
            $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono, correo_electronico = :correo_electronico, direccion = :direccion, pass = :hash_pass WHERE id_usuarios = :id";


            $statement = $this->connection->prepare($sql);

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
            echo "Error al actualizar el usuario: " . $e->getMessage();
            return false;
        }
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
            // Consulta para verificar si la sala tiene capacidad disponible
            $sql = "
            SELECT SALAS.aforo, COUNT(*) AS enrolled_count
            FROM SESIONES
            INNER JOIN SALAS ON SESIONES.id_salas = SALAS.id_salas
            LEFT JOIN INSCRIPCIONES ON SESIONES.id = INSCRIPCIONES.id_sesion
            WHERE SESIONES.id = ?
            GROUP BY SESIONES.id
        ";

            $statement = $this->connection->prepare($sql);
            $statement->execute([$idSesion]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result['enrolled_count'] < $result['aforo']) {
                // La sala tiene capacidad disponible, inscribir al usuario en la sesión
                $queryInscripcion = "INSERT INTO INSCRIPCIONES (id_sesion, id_usuario) VALUES (?, ?)";
                $statement = $this->connection->prepare($queryInscripcion);
                $statement->execute([$idSesion, $idUsuario]);
                return "Inscripción exitosa. ¡Bienvenido a la clase!";
            } else {
                // La sala está llena para esta sesión, no se puede inscribir al usuario
                return "Lo sentimos, la clase ya está llena. No se pudo inscribir.";
            }
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
