<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../assets/utils/setNewData.php";
class Admin{
    private $conn;
    private $table = "Admin";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getDataAdmin($nip){
        $query = "SELECT 
        a.nip, 
        a.notelp, 
        a.nama_admin as nama, 
        a.email, 
        u.role, 
        u.foto_diri 
        FROM " . $this->table . " a
        JOIN Users u
        ON u.id_users = a.nip
        WHERE a.nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nip);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? setFirstnameAndLastname($result) : false;
    }
}
?>