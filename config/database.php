<?php
class Database{
    private $dsn = "sqlsrv:server=CHLZ\SQLEXPRESS;database=tatibjtiv6";
    public $conn;

    public function getConneection(){
        $this->conn = null;
        try {
            $this->conn = new PDO($this->dsn);
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>