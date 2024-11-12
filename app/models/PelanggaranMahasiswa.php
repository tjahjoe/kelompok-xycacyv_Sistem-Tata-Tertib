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
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        WHERE nim = ? 
        ORDER BY 
        tanggal_pelanggaran";
        return $this->getPelanggaran($query, $nim);
    }

    public function getDataPelanggaranByDpa($nip)
    {
        $query = "SELECT
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        JOIN Mahasiswa m
        ON p.nim = m.nim
        WHERE m.nip = ?
        ORDER BY 
        tanggal_pelanggaran";
        return $this->getPelanggaran($query, $nip);
    }

    public function getAllDataPelanggaran()
    {
        $query = "SELECT
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        ORDER BY 
        tanggal_pelanggaran";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results ? $results : false;
    }

    public function getDataPelanggaranByPelapor($nip)
    {
        $query = "SELECT
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        WHERE pelapor = ? 
        ORDER BY
        tanggal_pelanggaran";
        return $this->getPelanggaran($query, $nip);
    }

    public function getDetailDataPelanggaran($id)
    {
        $query = "SELECT 
        p.id_pelanggaran_mhs,
        l.tingkat_pelanggaran,
        p.tanggal_pelanggaran,
        p.nim,
        l.nama_jenis_pelanggaran,
        p.catatan,
        t.sanksi,
        p.status
        FROM " . $this->conn . " p
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

    public function getDaftarPelaporan($nim, $tanggalAwal, $tanggalAkhir, $tingkat, $status)
    {
        $conditions = [];
        $params = [];

        if ($nim) {
            $conditions[] = "p.nim = ?";
            $params[] = $nim;
        }
        if ($tanggalAwal && $tanggalAkhir) {
            $conditions[] = "p.tanggal_pelanggaran BETWEEN ? AND ?";
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
        p.tanggal_pelanggaran,
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

    // public function uploadPelanggaran(){
    //     $query = ""
    // }
}
?>