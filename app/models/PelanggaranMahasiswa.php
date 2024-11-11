<?php
require_once __DIR__ . "/../../config/database.php";
class PelanggaranMahasiswa{
    private $conn;
    private $table = "PelanggaranMahasiswa";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    private function getPelanggaran($query, $nim){
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nim);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        } else {
            return false;
        }
    }

    // public function getPelanggaran($nim){
    //     $query = "SELECT * FROM " . $this->table . " WHERE nim = ? ORDER BY status, tanggal_pelanggaran, tingkat_pelanggaran, nama_jenis_pelanggaran";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $nim);
    //     $stmt->execute();
    //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     if ($results) {
    //         return $results;
    //     } else {
    //         return false;
    //     }
    // }

    // public function getDataPelanggranByPelapor($nim){
    //     $query = "SELECT 
    //     tingkat_pelanggaran, 
    //     tanggal_pelanggaran, 
    //     nim, 
    //     akumulasi_pelanggaran, 
    //     nama_jenis_pelanggaran, 
    //     catatan, 
    //     sanksi, 
    //     status
    //     FROM " . $this->table . 
    //     " WHERE nim = ? 
    //     ORDER BY status, 
    //     tanggal_pelanggaran,    
    //     tingkat_pelanggaran, 
    //     nama_jenis_pelanggaran";
    //     return $this->getPelanggaran($query, $nim);
    // } 

    public function getDataPelanggaranByPelanggar($nim){
        $query = "SELECT
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From ". $this->table ." p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        WHERE nim = ? 
        ORDER BY 
        tanggal_pelanggaran";
        return $this->getPelanggaran($query, $nim);
    } 

    public function getDataPelanggaranByDpa($nip){
        $query = "SELECT
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From ". $this->table ." p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        JOIN Mahasiswa m
        ON p.nim = m.nim
        WHERE m.nip = ?
        ORDER BY 
        tanggal_pelanggaran";
        return $this->getPelanggaran($query, $nip);
    }

    public function getAllDataPelanggaran(){
        $query = "SELECT
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From ". $this->table ." p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        ORDER BY 
        tanggal_pelanggaran";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        } else {
            return false;
        }
    }

    public function getDataPelanggaranByPelapor($nip){
        $query = "SELECT
        p.id_pelanggaran_mhs,
        p.tanggal_pelanggaran, 
        l.nama_jenis_pelanggaran, 
        p.catatan, 
        l.tingkat_pelanggaran, 
        p.status
        From ". $this->table ." p
        JOIN ListPelanggaran l
        ON p.id_list_pelanggaran = l.id_list_pelanggaran
        WHERE pelapor = ? 
        ORDER BY
        tanggal_pelanggaran";
        return $this->getPelanggaran($query, $nip);
    }

    public function getDetailDataPelanggaran(){
        
    }

    // public function uploadPelanggaran(){
    //     $query = ""
    // }
}
?>