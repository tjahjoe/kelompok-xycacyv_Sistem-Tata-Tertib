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

    public function getDataMahasiswa($nim)
    {
        $query = "SELECT 
        m.nim, 
        m.notelp, 
        m.nama_mahasiswa as nama,
        m.email,
        u.role,
        u.foto_diri
        FROM " . $this->table . " m
        JOIN Users u ON 
        m.nim = u.id_users WHERE nim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : false;
        // return $result ? setFirstnameAndLastname($result) : false;
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