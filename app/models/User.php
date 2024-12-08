<?php
require_once __DIR__ . "/../../config/database.php";
class User
{
    private $conn;
    private $table = "Users";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function login($username, $password)
    {

        $query = "SELECT * FROM " . $this->table . " WHERE id_users = ? AND password = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        if ($result['role'] == 'mahasiswa') {
            $query = "SELECT * FROM Mahasiswa WHERE nim = ? AND status = 'aktif'";
        } else if (in_array($result['role'], ['dosen', 'dpa', 'kps', 'sekjur'])) {
            $query = "SELECT * FROM Dosen WHERE nip = ? AND status = 'aktif'";
        } else if ($result['role'] == 'admin') {
            $query = "SELECT * FROM Admin WHERE nip = ? AND status = 'aktif'";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $result['id_users']);
        $stmt->execute();

        $isValue = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->conn->commit();
        return $isValue ? $result : false;
    }

    public function getDataUsers()
    {
        $query = "SELECT 
        m.nim 'ID', 
        m.nama_mahasiswa 'NAMA', 
        m.email 'EMAIL', 
        u.role 'PEKERJAAN', 
        m.notelp 'TELEPON',
        m.status 'STATUS' 
        FROM Mahasiswa m
        JOIN Users u on u.id_users = m.nim
        UNION
        SELECT 
        d.nip,
        d.nama_dosen,
        d.email,
        u.role,
        d.notelp,
        d.status
        FROM Dosen d
        JOIN Users u on u.id_users = d.nip
        UNION
        SELECT 
        a.nip,
        a.nama_admin,
        a.email,
        u.role,
        a.notelp,
        a.status
        FROM Admin a
        JOIN Users u on u.id_users = a.nip";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results ? $results : false;
    }

    public function getDataUsersByFilter($id){
        $conditionMhs = '';
        $conditionDsn = '';
        $conditionAdm = '';
        $param = '';
        if ($id) {
            $conditionMhs = 'WHERE m.nim LIKE ?';
            $conditionDsn = 'WHERE d.nip LIKE ?';
            $conditionAdm = 'WHERE a.nip LIKE ?';
            $param = '%' . $id . '%';
        }
        $query = "SELECT 
        m.nim 'ID', 
        m.nama_mahasiswa 'NAMA', 
        m.email 'EMAIL', 
        u.role 'PEKERJAAN', 
        m.notelp 'TELEPON',
        m.status 'STATUS' 
        FROM Mahasiswa m
        JOIN Users u on u.id_users = m.nim
        $conditionMhs
        UNION
        SELECT 
        d.nip,
        d.nama_dosen,
        d.email,
        u.role,
        d.notelp,
        d.status
        FROM Dosen d
        JOIN Users u on u.id_users = d.nip
        $conditionDsn
        UNION
        SELECT 
        a.nip,
        a.nama_admin,
        a.email,
        u.role,
        a.notelp,
        a.status
        FROM Admin a
        JOIN Users u on u.id_users = a.nip
        $conditionAdm";
        $stmt = $this->conn->prepare($query);
        if ($id) {
            $stmt->bindParam(1, $param);
            $stmt->bindParam(2, $param);
            $stmt->bindParam(3, $param);
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results ? $results : false;
    }

    public function uploadUser(){
        
    }

    public function checkPhotoName($id)
    {
        $query = "SELECT foto_diri FROM " . $this->table . " WHERE id_users = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : false;
    }

    public function changePhoto($id, $foto)
    {
        $query = "UPDATE " . $this->table . "
        SET foto_diri = ? 
        WHERE id_users = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $foto);
        $stmt->bindParam(2, $id);
        $stmt->execute();
        $this->conn->commit();
        return true;
    }
}
?>