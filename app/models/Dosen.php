<?php
require_once __DIR__ . "/../../config/database.php";
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
        return $result ? $result : false;
    }

    // public function changeData($nama, $nim){
    //     $query = "UPDATE ". $this->table ." 
    //     SET nama_dosen = ? 
    //     WHERE nip = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1,$nama);
    //     $stmt->bindParam(2, $nim);
    //     $stmt->execute();
    // }

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
    }
}
?>