<?php

require_once(__DIR__ . "/../../models/database.php");

class CalendarQueries
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function getAllSesion()
    {
        $stmt = $this->connection->prepare("SELECT 
                                                SE.id,
                                                C.nombre AS nombre_clase, 
                                                CONCAT(U.nombre, ' ', U.apellidos) AS nombre_profesor,
                                                S.nombre AS nombre_sala,
                                                SE.fecha_hora_inicio,
                                                SE.fecha_hora_fin
                                            FROM sesiones SE
                                            JOIN CLASES C ON SE.id_clases = C.id_clases
                                            JOIN SALAS S ON SE.id_salas = S.id_salas
                                            JOIN USUARIOS U ON C.id_profesor = U.id_usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSesionForProfesor($idProfesor)
    {
        $stmt = $this->connection->prepare("SELECT 
                                            SE.id,
                                            C.nombre AS nombre_clase, 
                                            CONCAT(U.nombre, ' ', U.apellidos) AS nombre_profesor,
                                            S.nombre AS nombre_sala,
                                            SE.fecha_hora_inicio,
                                            SE.fecha_hora_fin
                                        FROM sesiones SE
                                        JOIN CLASES C ON SE.id_clases = C.id_clases
                                        JOIN SALAS S ON SE.id_salas = S.id_salas
                                        JOIN USUARIOS U ON C.id_profesor = U.id_usuarios
                                        WHERE U.id_usuarios = :idProfesor");
        $stmt->bindParam(':idProfesor', $idProfesor);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSesion($dia, $hora)
    {
        $sql = "SELECT                              
                    C.nombre AS nombre_clase, 
                    C.id_profesor AS profesor_clase,
                    S.nombre AS nombre_sala,
                    S.aforo AS aforo_sala,
                    SE.fecha_hora_inicio AS hora_inicio,
                    SE.fecha_hora_fin AS hora_fin,
                    SE.id AS id_sesion1
                FROM sesiones SE
                JOIN CLASES C ON SE.id_clases = C.id_clases
                JOIN SALAS S ON SE.id_salas = S.id_salas 
                WHERE DAYOFWEEK(fecha_hora_inicio) = :dia AND HOUR(fecha_hora_inicio) = :hora";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':dia', $dia);
        $statement->bindParam(':hora', $hora);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
