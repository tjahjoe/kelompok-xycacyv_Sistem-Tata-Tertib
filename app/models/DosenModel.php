<?php
require_once __DIR__ . "/../../config/database.php";
class DosenModel extends Database {
    public function __construct(){
        $this->conn = $this->getConneection();
        $this->table = "Dosen";
    }

    public function getDataDosen($nip){
        $query = "SELECT 
        d.nip, 
        d.notelp, 
        d.nama_dosen as nama, 
        d.email, 
        u.role, 
        u.foto_diri,
        d.status
        FROM " . $this->table . " d
        JOIN Users u
        ON u.id_users = d.nip 
        WHERE d.nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nip);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : false;
    }

    public function getAllDpa(){
        $query = "SELECT d.nip, nama_dosen FROM ". $this->table ." d
        JOIN Users u ON u.id_users = d.nip
        WHERE u.role = 'dpa' AND status = 'aktif'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results ? $results : false;
    }

    public function changeData($nama, $nip, $notlp)
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
            if ($result['id'] != $nip) {
                $this->conn->rollBack();
                return false;
            }
        }

        $query = "UPDATE " . $this->table . " 
        SET nama_dosen = ?,
        notelp = ?
        WHERE nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nama);
        $stmt->bindParam(2, $notlp);
        $stmt->bindParam(3, $nip);
        $stmt->execute();
        $this->conn->commit();
        return true;
    }
}
?>