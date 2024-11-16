<?php
require_once __DIR__ . "/../../config/database.php";
class PelanggaranMahasiswa
{
    private $conn;
    private $table = "PelanggaranMahasiswa";
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    private function getPelanggaran($query, $nim)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results ? $results : false;
    }

    public function getDataPelanggaranByPelanggar($nim)
    {
        $query = "SELECT
        p.id_pelanggaran_mhs 'id',
		p.nim 'NIM',
		m.nama_mahasiswa 'NAMA',
        p.tgl_pelanggaran 'TANGGAL', 
        l.nama_jenis_pelanggaran 'JUDUL MASALAH', 
        l.tingkat_pelanggaran 'TINGKAT', 
        p.status 'STATUS'
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
		JOIN Mahasiswa m
		ON m.nim = p.nim
        WHERE m.nim = ? 
        ORDER BY 
        tgl_pelanggaran";
        return $this->getPelanggaran($query, $nim);
    }

    public function getDataPelanggaranByDpa($nip)
    {
        $query = "SELECT
        p.id_pelanggaran_mhs 'id',
		p.nim 'NIM',
		m.nama_mahasiswa 'NAMA',
        p.tgl_pelanggaran 'TANGGAL', 
        l.nama_jenis_pelanggaran 'JUDUL MASALAH', 
        l.tingkat_pelanggaran 'TINGKAT', 
        p.status 'STATUS'
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
		JOIN Mahasiswa m
		ON m.nim = p.nim
        WHERE m.nip = ? 
        ORDER BY 
        tgl_pelanggaran";
        return $this->getPelanggaran($query, $nip);
    }

    public function getAllDataPelanggaran()
    {
        $query = "SELECT 
        p.id_pelanggaran_mhs 'id',
		p.nim 'NIM',
		m.nama_mahasiswa 'NAMA',
        p.tgl_pelanggaran 'TANGGAL', 
        l.nama_jenis_pelanggaran 'JUDUL MASALAH', 
        l.tingkat_pelanggaran 'TINGKAT', 
        p.status 'STATUS'
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
		JOIN Mahasiswa m
        ON m.nim = p.nim
        ORDER BY 
        tgl_pelanggaran";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results ? $results : false;

    }

    public function getDataPelanggaranByPelapor($nip)
    {
        $query = "SELECT
        p.id_pelanggaran_mhs 'id',
        p.nim 'NIM',
        p.tgl_pelanggaran 'TANGGAL', 
        l.nama_jenis_pelanggaran 'JUDUL MASALAH', 
        l.tingkat_pelanggaran 'TINGKAT', 
        p.status 'STATUS'
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        WHERE pelapor = ? 
        ORDER BY
        tgl_pelanggaran";
        return $this->getPelanggaran($query, $nip);
    }

    public function getDetailDataPelanggaran($id)
    {
        $query = "SELECT 
        p.id_pelanggaran_mhs,
        l.tingkat_pelanggaran,
        p.tgl_pelanggaran,
        p.nim,
        l.nama_jenis_pelanggaran,
        p.catatan,
        t.sanksi,
        p.status
        FROM " . $this->table
         . " p
        JOIN ListPelanggaran l
        ON l.id_list_pelanggaran = p.id_list_pelanggaran
        JOIN TingkatPelanggaran t 
        ON t.id_tingkat_pelanggaran = p.id_tingkat_pelanggaran
        WHERE id_pelanggaran_mhs = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : false;
    }

    public function getDetailDaftarPelanggaran($id)
    {
        $query = "SELECT 
        role
        from " . $this->table . " p
        JOIN Users u
        ON u.id_users = p.pelapor
        WHERE p.id_pelanggaran_mhs = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($role)) {
            $this->conn->commit();
            return false;
        }
        $nama = "";
        $tableJoin = "";

        if (in_array($role['role'], ['dosen', 'dpa', 'kps', 'sekjur'])) {
            $nama = "d.nama_dosen";
            $tableJoin = "JOIN Dosen d ON d.nip = p.pelapor";
        } else if ($role['role'] == 'admin') {
            $nama = "a.nama_admin";
            $tableJoin = "JOIN Admin a ON a.nip = p.pelapor";
        }

        $query = "SELECT 
        p.id_pelanggaran_mhs,
		$nama,
		p.pelapor,
        l.tingkat_pelanggaran,
        p.tgl_pelanggaran,
        p.nim,
        l.nama_jenis_pelanggaran,
        p.catatan,
        t.sanksi,
        p.status
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON l.id_list_pelanggaran = p.id_list_pelanggaran
        JOIN TingkatPelanggaran t 
        ON t.id_tingkat_pelanggaran = p.id_tingkat_pelanggaran  $tableJoin WHERE id_pelanggaran_mhs = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->conn->commit();
        return $result ? $result : false;
    }

    public function getDaftarPelaporan($nim, $tanggalAwal, $tanggalAkhir, $tingkat, $status)
    {
        $conditions = [];
        $params = [];

        if ($nim) {
            $conditions[] = "p.nim = ?";
            $params[] = $nim;
        }
        if ($tanggalAwal && $tanggalAkhir) {
            $conditions[] = "p.tgl_pelanggaran BETWEEN ? AND ?";
            $params[] = $tanggalAwal;
            $params[] = $tanggalAkhir;
        }
        if ($tingkat) {
            $conditions[] = "l.tingkat_pelanggaran = ?";
            $params[] = $tingkat;
        }
        if ($status) {
            $conditions[] = "p.status = ?";
            $params[] = $status;
        }

        $whereClause = $conditions ? implode(" AND ", $conditions) : "1 = 1";

        $query = "SELECT 
        p.tgl_pelanggaran,
        l.nama_jenis_pelanggaran,
        p.catatan,
        l.tingkat_pelanggaran,
        p.status
        FROM " . $this->table . " p
        JOIN ListPelanggaran l 
        ON l.id_list_pelanggaran = p.id_list_pelanggaran
        WHERE $whereClause";

        $stmt = $this->conn->prepare($query);

        foreach ($params as $index => $param) {
            $stmt->bindValue($index + 1, $param);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results ? $results : false;
    }

    public function uploadPelanggaran($nim, $tanggal, $catatan, $pelapor, $jenis, $isEmptyImg)
    {
        $query = "INSERT INTO " . $this->table . " 
        (id_list_pelanggaran,  
        nim,
        status,
        tgl_pelanggaran,
        catatan,
        pelapor)
        SELECT 
        id_list_pelanggaran, ?, ?, ?, ?, ?
        FROM ListPelanggaran 
        WHERE 
        nama_jenis_pelanggaran = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->bindValue(2, 'Baru');
        $stmt->bindParam(3, $tanggal);
        $stmt->bindParam(4, $catatan);
        $stmt->bindParam(5, $pelapor);
        $stmt->bindParam(6, $jenis);
        $stmt->execute();

        if ($isEmptyImg) {
            $this->conn->commit();
            return false;
        } else {
            $query = "SELECT 
            TOP 1 
            id_pelanggaran_mhs
            FROM PelanggaranMahasiswa 
            WHERE pelapor = ? 
            ORDER BY id_pelanggaran_mhs DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $pelapor);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function uploadImages($files, $id)
    {
        $query = "UPDATE " . $this->table . " 
        SET bukti_laporan = ? 
        WHERE id_pelanggaran_mhs = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $files);
        $stmt->bindParam(2, $id);
        $stmt->execute();

        $query = "SELECT 
        * 
        FROM " . $this->table . " 
        WHERE id_pelanggaran_mhs = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->conn->commit();

        return $result ? $result : false;
    }
}
?>