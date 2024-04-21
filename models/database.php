<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "gym";
    private $port = "3306";
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->database}",
                $this->user,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>