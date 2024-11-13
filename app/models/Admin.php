<?php
require_once __DIR__ . "/../../config/database.php";
class Admin{
    private $conn;
    private $table = "Admin";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    private function setFirstnameAndLastname($data)
    {
        $nama = $data["nama"];
        $pos = strrpos($nama, ' ');

        if ($pos) {
            $pos = $pos + 1;
        } else {
            $pos = 0;
        }

        $lastname = substr($nama, $pos + 1);
        $firstname = substr($nama, 0, strlen($nama) - strlen($lastname) - 1);

        $data['nama_awal'] = $firstname;
        $data['nama_akhir'] = $lastname;

        return $data;
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
        return $result ? $this->setFirstnameAndLastname($result) : false;
    }
}
?>