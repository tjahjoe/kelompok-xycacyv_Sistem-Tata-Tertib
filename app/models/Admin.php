<?php
require_once __DIR__ . "/../../config/database.php";
class Admin
{
    private $conn;
    private $table = "Admin";
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getDataAdmin($nip)
    {
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
        return $result ? $result : false;
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
        SET nama_admin = ?,
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