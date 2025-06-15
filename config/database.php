<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'fruteria_db';
    private $username = 'root';
    private $password = 'B2003.sor';
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            throw new PDOException("Error de conexión a la base de datos.");
        }
        return $this->conn;
    }
}
?>