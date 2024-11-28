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

    // public function getDataMahasiswaForTransaction($nim){
    //     $this->conn->beginTransaction();
    //     $result = $this->getDataMahasiswa($nim);
        
    //     if ($result) {
    //         return $result;
    //     } else {
    //         $this->conn->commit();
    //         return false;
    //     }
    // }

    // public function changeData($nama, $nim){
    //     $query = "UPDATE ". $this->table ." 
    //     SET nama_mahasiswa = ? 
    //     WHERE nim = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1,$nama);
    //     $stmt->bindParam(2, $nim);
    //     $stmt->execute();
    // }
    
    public function changeData($nama, $nim, $notlp)
    {
        $query = "SELECT nim as id FROM Mahasiswa WHERE notelp = ?
        UNION 
        SELECT nip as id FROM Dosen WHERE notelp = ?
        UNION 
        SELECT nip as id FROM Admin WHERE notelp = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $notlp);
        $stmt->bindParam(2, $notlp);
        $stmt->bindParam(3, $notlp);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($result['id'] != $nim) {
                $this->conn->rollBack();
                return false;
            }
        }

        $query = "UPDATE " . $this->table . " 
        SET nama_mahasiswa = ?,
        notelp = ?
        WHERE nim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nama);
        $stmt->bindParam(2, $notlp);
        $stmt->bindParam(3, $nim);
        $stmt->execute();
        $this->conn->commit();
        return true;
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