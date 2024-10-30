<?php
require_once __DIR__ . "/../../config/database.php";
class PelanggaranMahasiswa{
    private $conn;
    private $table = "PelanggaranMahasiswa";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getPelanggaran($nim){
        $query = "SELECT * FROM " . $this->table . " WHERE nim = ? ORDER BY status, tanggal_pelanggaran, tingkat_pelanggaran, nama_jenis_pelanggaran";
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
}
?>