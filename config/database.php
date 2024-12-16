<?php
class Database
{
    private $dsn = "sqlsrv:server=LAPTOP-EP40NKTO;database=tatibjtiv6";
    private $username = "sa";
    private $password = "123";
    protected $conn;
    protected $table;

    protected function getConneection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password); // username dan password ditambahkan ke PDO
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }
}
