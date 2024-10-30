<?php
require_once __DIR__ . "/../../config/database.php";
class Mahasiswa{
    private $conn;
    private $table = "Mahasiswa";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getDataMahasiswa($nim){
        $query = "SELECT * FROM " . $this->table . " WHERE nim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}
?>