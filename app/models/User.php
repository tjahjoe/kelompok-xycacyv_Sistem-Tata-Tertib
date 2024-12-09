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

    public function getDataUsersByFilter($id)
    {
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

    private function checkConditionUniqKey($columns, $param)
    {
        $query = "SELECT nim as id FROM Mahasiswa WHERE $columns[0] = ? 
                  UNION 
                  SELECT nip as id FROM Dosen WHERE $columns[1] = ? 
                  UNION 
                  SELECT nip as id FROM Admin WHERE $columns[2] = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $param);
        $stmt->bindParam(2, $param);
        $stmt->bindParam(3, $param);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function isValidForUpdate($nim, $notelp, $email)
    {
        // $this->conn->beginTransaction();

        $conditions = [
            ['notelp', 'notelp', 'notelp', $notelp, "Gagal: Nomor telepon tidak valid!"],
            ['email', 'email', 'email', $email, "Gagal: Email tidak valid!"]
        ];

        foreach ($conditions as [$column1, $column2, $column3, $param, $errorMessage]) {
            $result = $this->checkConditionUniqKey([$column1, $column2, $column3], $param);
            if ($result) {
                if ($result['id'] != $nim) {
                    $this->conn->rollBack();
                    return $errorMessage;
                }
            }
        }
        return "berhasil";
    }

    private function isValidForUpload($id, $notelp, $email)
    {
        $conditions = [
            ['nim', 'nip', 'nip', $id, "Gagal: NIM tidak valid!"],
            ['notelp', 'notelp', 'notelp', $notelp, "Gagal: Nomor telepon tidak valid!"],
            ['email', 'email', 'email', $email, "Gagal: Email tidak valid!"]
        ];

        foreach ($conditions as [$column1, $column2, $column3, $param, $errorMessage]) {
            $result = $this->checkConditionUniqKey([$column1, $column2, $column3], $param);
            if ($result) {
                $this->conn->rollBack();
                return $errorMessage;
            }
        }
        return "berhasil";
    }

    private function uploadUser($id, $role)
    {
        $query = "INSERT INTO " . $this->table . " VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $id);
        $stmt->bindParam(3, $role);
        $stmt->bindValue(4, null);
        $stmt->execute();
    }

    public function uploadMahasiswa($nim, $notelp, $nama, $email, $namaOrtu, $notelpOrtu, $nip, $role)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpload($nim, $notelp, $email);
        if ($result != "berhasil") {
            return $result;
        }
        $this->uploadUser($nim, $role);
        $query = "INSERT INTO Mahasiswa VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->bindParam(2, $notelp);
        $stmt->bindParam(3, $nama);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $namaOrtu);
        $stmt->bindParam(6, $notelpOrtu);
        $stmt->bindValue(7, 'aktif');
        $stmt->bindParam(8, $nip);
        $stmt->execute();
        $this->conn->commit();
        return "berhasil";
    }

    public function uploadDosen($nip, $notelp, $nama, $email, $role)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpload($nip, $notelp, $email);
        if ($result != "berhasil") {
            return $result;
        }
        $this->uploadUser($nip, $role);
        $query = "INSERT INTO Dosen VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nip);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $notelp);
        $stmt->bindValue(4, 'aktif');
        $stmt->bindParam(5, $nama);
        $stmt->execute();
        $this->conn->commit();
        return "berhasil";
    }

    public function uploadAdmin($nip, $notelp, $nama, $email, $role)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpload($nip, $notelp, $email);
        if ($result != "berhasil") {
            return $result;
        }
        $this->uploadUser($nip, $role);
        $query = "INSERT INTO Admin VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nip);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $notelp);
        $stmt->bindValue(4, 'aktif');
        $stmt->bindParam(5, $nama);
        $stmt->execute();
        $this->conn->commit();
        return "berhasil";
    }

    public function updateMahasiswa($nim, $notelp, $nama, $email, $namaOrtu, $notelpOrtu, $status, $nip)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpdate($nim, $notelp, $email);
        if ($result != 'berhasil') {
            return $result;
        }
        $query = "UPDATE Mahasiswa SET 
        notelp = ?,
        nama_mahasiswa = ?,
        email = ?,
        nama_ortu = ?,
        notelp_ortu = ?,
        status = ?,
        nip = ?
        WHERE nim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $notelp);
        $stmt->bindParam(2, $nama);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $namaOrtu);
        $stmt->bindParam(5, $notelpOrtu);
        $stmt->bindParam(6, $status);
        $stmt->bindParam(7, $nip);
        $stmt->bindParam(8, $nim);
        $this->conn->commit();
        return "berhasil";
    }

    public function updateDosen($nip, $email, $notelp, $status, $nama, $role)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpdate($nip, $notelp, $email);
        if ($result != 'berhasil') {
            return $result;
        }

        $query = "UPDATE Users SET 
        role = ?,
        WHERE id_users = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $role);
        $stmt->bindParam(2, $nip);
        $stmt->execute();

        $query = "UPDATE Dosen SET 
        email =?, 
        notelp = ?, 
        status = ?, 
        nama_dosen = ?
        WHERE nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $notelp);
        $stmt->bindParam(3, $status);
        $stmt->bindParam(4, $nama);
        $stmt->bindParam(5, $nip);
        $stmt->execute();
        $this->conn->commit();
        return "berhasil";
    }

    public function updateAdmin($nip, $email, $notelp, $status, $nama, $role)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpdate($nip, $notelp, $email);
        if ($result != 'berhasil') {
            return $result;
        }

        $query = "UPDATE Users SET 
        role = ?,
        WHERE id_users = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $role);
        $stmt->bindParam(2, $nip);
        $stmt->execute();

        $query = "UPDATE Admin SET 
        email =?, 
        notelp = ?, 
        status = ?, 
        nama_admin = ?
        WHERE nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $notelp);
        $stmt->bindParam(3, $status);
        $stmt->bindParam(4, $nama);
        $stmt->bindParam(5, $nip);
        $stmt->execute();
        $this->conn->commit();
        return "berhasil";
    }


    public function updateAdminToDosen($nip, $email, $notelp, $status, $nama, $role)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpdate($nip, $notelp, $email);
        if ($result != 'berhasil') {
            return $result;
        }

        $query = "UPDATE Users SET 
        role = ?,
        WHERE id_users = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $role);
        $stmt->bindParam(2, $_SESSION);
        $stmt->execute();

        $query = "UPDATE Admin SET 
        email =?, 
        notelp = ?, 
        status = ?, 
        nama_admin = ?
        WHERE nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $notelp);
        $stmt->bindParam(3, $status);
        $stmt->bindParam(4, $nama);
        $stmt->bindParam(5, $nip);
        $stmt->execute();

        $query = "INSERT INTO Dosen SELECT * FROM Admin WHERE nip = ?
        GO
        DELETE Admin WHERE nip = ?";
        $stmt->bindParam(1, $nip);
        $stmt->bindParam(2, $nip);
        $stmt->execute();
        $this->conn->commit();
        return "berhasil";
    }

    public function updateDosenToAdmin($nip, $email, $notelp, $status, $nama, $role)
    {
        $this->conn->beginTransaction();
        $result = $this->isValidForUpdate($nip, $notelp, $email);
        if ($result != 'berhasil') {
            return $result;
        }

        $query = "UPDATE Users SET 
        role = ?,
        WHERE id_users = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $role);
        $stmt->bindParam(2, $_SESSION);
        $stmt->execute();

        $query = "UPDATE Dosen SET 
        email =?, 
        notelp = ?, 
        status = ?, 
        nama_dosen = ?
        WHERE nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $notelp);
        $stmt->bindParam(3, $status);
        $stmt->bindParam(4, $nama);
        $stmt->bindParam(5, $nip);
        $stmt->execute();

        $query = "INSERT INTO Admin SELECT * FROM Dosen WHERE nip = ?
        GO
        DELETE Dosen WHERE nip = ?";
        $stmt->bindParam(1, $nip);
        $stmt->bindParam(2, $nip);
        $stmt->execute();
        $this->conn->commit();
        return "berhasil";
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