<?php
require_once __DIR__ . "/../../config/database.php";

class MahasiswaModel extends Database
{
    public function __construct()
    {
        $this->conn = $this->getConneection();
        $this->table = "Mahasiswa";
    }

    public function getDataMahasiswa($nim)
    {
        // nama orang tua dan nomor telepon
        $query = "SELECT 
        m.nim, 
        m.notelp, 
        m.nama_mahasiswa as nama,
        m.email,
        m.nama_ortu, 
        m.notelp_ortu,
        u.role,
        u.foto_diri,
        m.status,
        m.nip
        FROM " . $this->table . " m
        JOIN Users u ON 
        m.nim = u.id_users WHERE nim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : false;
    }
    
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
}
?>