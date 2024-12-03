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
        p.tgl_pelanggaran 'TANGGAL', 
        l.nama_jenis_pelanggaran 'JUDUL MASALAH', 
        l.tingkat_pelanggaran 'TINGKAT', 
        p.status 'STATUS'
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
		JOIN Mahasiswa m
		ON m.nim = p.nim
        WHERE m.nim = ?
        AND p.status IN ('aktif', 'nonaktif', 'reject')
        ORDER BY 
        tgl_pelanggaran DESC, id_pelanggaran_mhs DESC"; //tambah id mahasiswa desc id_pelanggaran_mhs DESC
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
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
		JOIN Mahasiswa m
		ON m.nim = p.nim
        WHERE m.nip = ? 
        ORDER BY 
        tgl_pelanggaran DESC, id_pelanggaran_mhs DESC"; //tambah id mahasiswa desc id_pelanggaran_mhs DESC
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
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
		JOIN Mahasiswa m
        ON m.nim = p.nim
        ORDER BY 
        tgl_pelanggaran DESC, id_pelanggaran_mhs DESC"; //tambah id mahasiswa desc id_pelanggaran_mhs DESC
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
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        WHERE pelapor = ? 
        ORDER BY
        tgl_pelanggaran DESC, id_pelanggaran_mhs DESC"; //tambah id mahasiswa desc id_pelanggaran_mhs DESC
        return $this->getPelanggaran($query, $nip);
    }

    public function getDetailDataPelanggaran($id, $nim)
    {
        $query = $this->queryDetailDataPelanggaran(
            "p.id_tingkat_pelanggaran 'Tingkat Sanksi',t.sanksi 'Sanksi',",
            "JOIN TingkatPelanggaran t ON t.id_tingkat_pelanggaran = p.id_tingkat_pelanggaran"
        );
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->conn->commit();
            return $result;
        }

        $query = $this->queryDetailDataPelanggaran(
            "",
            ""
        );
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->conn->commit();
        return $result ? $result : false;
    }

    private function queryDetailDataPelanggaran($sanksi, $joinTable)
    {
        return "SELECT 
        p.id_pelanggaran_mhs 'id',
        l.tingkat_pelanggaran 'Tingkat Pelanggaran',
        p.tgl_pelanggaran 'Tanggal Pelanggaran',
        p.nim 'NIM Pelanggar',
        l.nama_jenis_pelanggaran 'Nama Pelanggaran',
        p.catatan 'Catatan',
        $sanksi
        p.status 'Status',
        p.bukti_laporan 'Bukti'
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON l.id_list_pelanggaran = p.id_list_pelanggaran
        $joinTable
        WHERE p.id_pelanggaran_mhs = ? 
        AND p.nim=?
        AND p.status IN ('aktif', 'nonaktif', 'reject')";
    }

    public function getDetailDaftarPelanggaran($id, $condition, $idUser, $isDpa = false)
    {
        $query = "SELECT 
        role
        FROM " . $this->table . " p
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

        $selectedColumns = "";
        $addPelapor = "";

        if ($condition) {
            $selectedColumns = "$nama 'Nama Pelapor',
            p.pelapor 'NIP Pelapor',";
        } else {
            $addPelapor = "AND p.pelapor = ?";
        }
        $tableJoinTingkatPelanggaran = "JOIN TingkatPelanggaran t
        ON t.id_tingkat_pelanggaran = p.id_tingkat_pelanggaran";
        $sanksi = "p.id_tingkat_pelanggaran 'Tingkat Sanksi',
        t.sanksi 'sanksi',";

        $tableJoinMahasiswa = "";
        $addNip = "";
        if ($isDpa && $condition) {
            $tableJoinMahasiswa = "JOIN Mahasiswa m ON m.nim = p.nim";
            $addNip = "AND m.nip = ?";
        }

        $query = $this->queryDetailDaftarPelanggaran(
            $selectedColumns,
            $sanksi,
            $tableJoin,
            $tableJoinMahasiswa,
            $tableJoinTingkatPelanggaran,
            $addNip,
            $addPelapor
        );
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $isDpa ? $stmt->bindParam(2, $idUser) : "";
        $condition ? "" : $stmt->bindParam(2, $idUser);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $this->conn->commit();
            return $result;
        }

        $query = $this->queryDetailDaftarPelanggaran(
            $selectedColumns,
            "",
            $tableJoin,
            $tableJoinMahasiswa,
            "",
            $addNip,
            $addPelapor
        );

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $isDpa ? $stmt->bindParam(2, $idUser) : "";
        $condition ? "" : $stmt->bindParam(2, $idUser);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->conn->commit();
        return $result ? $result : false;
    }

    private function queryDetailDaftarPelanggaran($selectedColumns, $sanksi, $tableJoin, $tableJoinMahasiswa, $tableJoinTingkatPelanggaran, $addNip, $addPelapor)
    {
        return "SELECT 
        p.id_pelanggaran_mhs 'id',
        $selectedColumns
        l.tingkat_pelanggaran 'Tingkat Pelanggaran',
        p.tgl_pelanggaran 'Tanggal Pelanggaran',
        p.nim 'NIM Pelanggar',
        l.nama_jenis_pelanggaran 'Nama Pelanggaran',
        p.catatan 'Catatan',
        $sanksi
        p.status 'Status',
        p.bukti_laporan 'Bukti'
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON l.id_list_pelanggaran = p.id_list_pelanggaran
        $tableJoin 
        $tableJoinMahasiswa
        $tableJoinTingkatPelanggaran
        WHERE p.id_pelanggaran_mhs = ?
        $addNip
        $addPelapor";
    }

    public function getTingkatPelanggaranForDetailDaftarPelanggaran($id)
    {
        $query = "SELECT 
        l.tingkat_pelanggaran 
        FROM PelanggaranMahasiswa p
        JOIN ListPelanggaran l
        ON l.id_list_pelanggaran = p.id_list_pelanggaran
        WHERE p.id_pelanggaran_mhs = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $results = array_map(function ($tingkat) {
                return ['tingkat_pelanggaran' => $tingkat];
            }, explode("/", $result['tingkat_pelanggaran']));
            return $results;
        }
        return false;
    }

    public function getDaftarPelaporanByFilter($nim, $tanggalAwal, $tanggalAkhir, $tingkat, $status, $num, $id = '', $isDpa = false)
    {
        $conditions = [];
        $params = [];

        if ($nim) {
            $conditions[] = "p.nim LIKE ?";
            $params[] = "%" . $nim . "%";
        }
        if ($tanggalAwal) {
            $conditions[] = "p.tgl_pelanggaran >= ?";
            $params[] = $tanggalAwal;
        }
        if ($tanggalAkhir) {
            $conditions[] = "p.tgl_pelanggaran <= ?";
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
        if ($isDpa) {
            $conditions[] = "m.nip = ?";
            $params[] = $id;
        }
        
        $limit = "";
        if (is_numeric($num)) {
            $limit = "OFFSET ? ROWS FETCH NEXT 10 ROWS ONLY";
        }

        $whereClause = $conditions ? implode(" AND ", $conditions) : "1 = 1";

        $query = "SELECT
        p.id_pelanggaran_mhs 'id',
		p.nim 'nim',
		m.nama_mahasiswa 'nama',
        p.tgl_pelanggaran 'tanggal', 
        l.nama_jenis_pelanggaran 'judulmasalah', 
        l.tingkat_pelanggaran 'tingkat', 
        p.status 'status'
        FROM " . $this->table . " p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
		JOIN Mahasiswa m
		ON m.nim = p.nim
        WHERE 
        $whereClause
        ORDER BY 
        tgl_pelanggaran DESC, id_pelanggaran_mhs DESC
        $limit"; //tambah id mahasiswa desc id_pelanggaran_mhs DESC

        $stmt = $this->conn->prepare($query);

        foreach ($params as $index => $param) {
            $stmt->bindValue($index + 1, $param);
        }
        if (is_numeric($num)) {
            $stmt->bindValue(count($params) + 1, $num, PDO::PARAM_INT);   
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
        $stmt->bindValue(2, 'baru');
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

    public function uploadStatusAndTingkat($idPelanggaran, $catatan, $status, $idTingkat, $nip, $tanggal)
    {
        $idTingkat = $status == 'reject' ? null : $idTingkat;

        if ($status != 'reject' and $idTingkat == '') {
            return "Gagal: Pilih tingkat sanksi";
        }

        $query = "SELECT status FROM " . $this->table . " WHERE id_pelanggaran_mhs = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idPelanggaran);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {

            if ($result['status'] == $status) {
                return "Gagal: Ubah status";
            }

            // jika status sebelumya baru tidak bisa langsung mengubah ke nonaktif atau reject
            if (in_array($status, ['nonaktif', 'reject']) && $result['status'] == 'baru') {
                return "Gagal: Pemrosesan harus bertahap";
            }

            // mengubah status akan tetapi tidak bisa mengembalikan ke proses sebelumnya
            if (!in_array($result['status'], ['nonaktif', 'reject']) and $status != 'baru') {
                $query = "UPDATE " . $this->table . " SET 
                status = ?,
                catatan = ?,
                id_tingkat_pelanggaran = ?
                WHERE id_pelanggaran_mhs = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1, $status);
                $stmt->bindParam(2, $catatan);
                $stmt->bindParam(3, $idTingkat);
                $stmt->bindParam(4, $idPelanggaran);
                $stmt->execute();

                $result = $this->checkAmount($idPelanggaran);

                if ($result && !is_null($idTingkat) && $status == 'aktif') {
                    $akumulasi = $result['jumlah'] / 3;
                    $akumulasi = $idTingkat - $akumulasi;
                    if ($result['jumlah'] % 3 == 0 && $akumulasi > 0) {
                        $this->updateStatusMultipleOfThree($idPelanggaran);
                        $this->uploadPelanggaranMultipleOfThree($idPelanggaran, $akumulasi, $nip, $result, $tanggal);
                    }
                }
            }
        }

        $this->conn->commit();
        return "berhasil";
    }

    private function checkAmount($idPelanggaran)
    {
        $query = "SELECT
        COUNT(id_pelanggaran_mhs) 'jumlah'
        FROM " . $this->table . "
        WHERE id_list_pelanggaran =
        (SELECT id_list_pelanggaran
        FROM " . $this->table . " 
        WHERE id_pelanggaran_mhs = ?)
        AND nim = 
        (SELECT nim 
        FROM " . $this->table . " 
        WHERE id_pelanggaran_mhs = ?)
        AND id_tingkat_pelanggaran = 
        (SELECT id_tingkat_pelanggaran 
        FROM " . $this->table . " 
        WHERE id_pelanggaran_mhs = ?)
        AND status IN ('aktif', 'nonaktif')";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idPelanggaran);
        $stmt->bindParam(2, $idPelanggaran);
        $stmt->bindParam(3, $idPelanggaran);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    private function updateStatusMultipleOfThree($idPelanggaran)
    {
        $query = "UPDATE " . $this->table . " 
                SET status = 'nonaktif'
                WHERE id_list_pelanggaran = 
                (SELECT id_list_pelanggaran 
                FROM " . $this->table . " 
                WHERE id_pelanggaran_mhs = ?) 
                AND nim = 
                (SELECT nim 
                FROM " . $this->table . " 
                WHERE id_pelanggaran_mhs = ?)
                AND id_tingkat_pelanggaran = 
                (SELECT id_tingkat_pelanggaran 
                FROM " . $this->table . " 
                WHERE id_pelanggaran_mhs = ?)
                AND status = 'aktif'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idPelanggaran);
        $stmt->bindParam(2, $idPelanggaran);
        $stmt->bindParam(3, $idPelanggaran);
        $stmt->execute();
    }

    private function uploadPelanggaranMultipleOfThree($idPelanggaran, $akumulasi, $nip, $result, $tanggal)
    {
        // $akumulasi = $result['jumlah'] / 3;
        // $akumulasi = $idTingkat - $akumulasi;
        // if ($akumulasi > 0) { //handle di atas
            $query = "INSERT INTO " . $this->table . " 
            (id_list_pelanggaran, 
            id_tingkat_pelanggaran, 
            nim, 
            status, 
            catatan, 
            pelapor,
            tgl_pelanggaran)
            select 
            id_list_pelanggaran, 
            ?, 
            nim, 
            'aktif', 
            'melangggar pelanggaran yang sama " . $result['jumlah'] . "x',
            ?,
            ? 
            FROM PelanggaranMahasiswa
            WHERE id_pelanggaran_mhs = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $akumulasi);
            $stmt->bindParam(2, $nip);
            $stmt->bindParam(3, $tanggal);
            $stmt->bindParam(4, $idPelanggaran);
            $stmt->execute();
        // }
    }
}
