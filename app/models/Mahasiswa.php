<?php
require_once __DIR__ . "/../../config/database.php";
class Mahasiswa
{
    private $conn;
    private $table = "Mahasiswa";
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    private function getDataMahasiswa($query, $id)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result : false;
    }

    private function setFirstnameAndLastname($datas)
    {
        for ($i = 0; $i < count($datas); $i++) {
            $nama = $datas[$i]['nama_mahasiswa'];
            $pos = strrpos($nama, ' ');

            if ($pos) {
                $pos = $pos + 1;
            } else {
                $pos = 0;
            }

            $lastname = substr($nama, $pos + 1);
            $firstname = substr($nama, 0, strlen($nama) - strlen($lastname) - 1);

            $datas[$i]['nama_awal'] = $firstname;
            $datas[$i]['nama_akhir'] = $lastname;
        }

        return $datas;
    }

    public function getDataMahasiswaByMahasiswa($nim)
    {
        $query = "SELECT 
        nim, 
        notelp, 
        nama_mahasiswa ,
        email,
        role
        FROM " . $this->table . " m
        JOIN Users u ON 
        m.nim = u.id_users WHERE nim = ?";
        $datas = $this->getDataMahasiswa($query, $nim);
        return $this->setFirstnameAndLastname($datas);
    }

    public function getDataMahasiswaByDpa($nip)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE nip = ?";
        return $this->getDataMahasiswa($query, $nip);
    }

    public function getAllDataMahasiswa()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result ? $result : false;
    }
}
?>