<?php
require_once __DIR__ . "/../../config/database.php";
class Dosen{
    private $conn;
    private $table = "Dosen";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    private function setFirstnameAndLastname($data)
    {
        $nama = $data["nama_dosen"];
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

    public function getDataDosen($nip){
        $query = "SELECT 
        d.nip, 
        d.notelp, 
        d.nama_dosen, 
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
        return $result ? $this->setFirstnameAndLastname($result) : false;
    }
}
?>