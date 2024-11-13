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

    // private function getDataMahasiswa($query, $id)
    // {
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $id);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //     return $result ? $result : false;
    // }

    private function setFirstnameAndLastname($data)
    {
        $nama = $data["nama_mahasiswa"];
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

    public function getDataMahasiswa($nim)
    {
        $query = "SELECT 
        nim, 
        notelp, 
        nama_mahasiswa ,
        email,
        role,
        foto_diri
        FROM " . $this->table . " m
        JOIN Users u ON 
        m.nim = u.id_users WHERE nim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $this->setFirstnameAndLastname($result) : false;
    }

    // public function getDataMahasiswaByDpa($nip)
    // {
    //     $query = "SELECT * FROM " . $this->table . " WHERE nip = ?";
    //     return $this->getDataMahasiswa($query, $nip);
    // }

    // public function getAllDataMahasiswa()
    // {
    //     $query = "SELECT * FROM " . $this->table;
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     return $result ? $result : false;
    // }
}
?>