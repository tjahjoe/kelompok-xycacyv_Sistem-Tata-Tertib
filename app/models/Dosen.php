<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../assets/utils/setNewData.php";
class Dosen{
    private $conn;
    private $table = "Dosen";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getDataDosen($nip){
        $query = "SELECT 
        d.nip, 
        d.notelp, 
        d.nama_dosen as nama, 
        d.email, 
        u.role, 
        u.foto_diri 
        FROM " . $this->table . " d
        JOIN Users u
        ON u.id_users = d.nip 
        WHERE d.nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nip);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? setFirstnameAndLastname($result) : false;
    }
}
?>