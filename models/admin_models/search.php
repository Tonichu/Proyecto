<?php

require_once(__DIR__ . "/../../models/database.php");

class Search
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function searchInTable($table, $search)
    {
        // Construir la lista de campos a seleccionar
        $selectedFields = "";
        switch ($table) {
            case 'usuarios':
                $selectedFields = "id_usuarios, nombre, apellidos, telefono, correo_electronico, direccion, tipo_usuarios";
                break;
            case 'clases':
                $selectedFields = "id_clases, nombre, descripcion, id_profesor";
                break;
            case 'salas':
                $selectedFields = "id_salas, nombre, aforo";
                break;
            case 'maquinas':
                $selectedFields = "id_maquina, nombre, descripcion, fecha_adquisicion, ultima_revision, id_sala";
                break;
            default:
                $selectedFields = "*"; // Si la tabla no está definida, seleccionar todos los campos
                break;
        }
    
        // Construir la consulta SQL para buscar en la tabla especificada
        $sql = "SELECT $selectedFields FROM $table WHERE nombre LIKE ?";
        $statement = $this->connection->prepare($sql);
        $search = "%" . $search . "%"; // Añadir comodines para buscar coincidencias parciales
        $statement->bindParam(1, $search, PDO::PARAM_STR);
        $statement->execute();
    
        // Obtener y retornar los resultados de la consulta
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}