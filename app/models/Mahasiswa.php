<?php
require_once __DIR__ . "/../../config/database.php";
class Mahasiswa{
    private $conn;
    private $table = "Mahasiswa";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    private function getDataMahasiswa($query, $id){
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // public function getDataMahasiswa($nim){
    //     $query = "SELECT * FROM " . $this->table . " WHERE nim = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $nim);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if ($result) {
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }

    public function getDataMahasiswaByMahasiswa($nim){
        $query = "SELECT * FROM " . $this->table . " WHERE nim = ?";
        return $this->getDataMahasiswa($query, $nim);
    }
    
    public function getDataMahasiswaByDosen($nip){
        $query = "SELECT * FROM " . $this->table . " WHERE nip = ?";
        return $this->getDataMahasiswa($query, $nip);
    }
}
?>