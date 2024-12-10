<?php
class Database{
    private $dsn = "sqlsrv:server=PARTICLE\SQLEXPRESS;database=tatibjti7";
    protected $conn;
    protected $table;
    protected function getConneection(){
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