<?php
require_once __DIR__ . "/../../config/database.php";
class ListPelanggaran{
    private $conn;
    private $table = "ListPelanggaran";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getAllListPelanggaran(){
        $query = "SELECT * FROM " . $this->table ." ORDER BY tingkat_pelanggaran desc, nama_jenis_pelanggaran";
        // $query = "SELECT * FROM " . $this->table ." WHERE tingkat_pelanggaran <> '-' ORDER BY tingkat_pelanggaran desc, nama_jenis_pelanggaran";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results ? $results : false;

    }

    public function getListPelanggaranByTingkat($tingkat){
        $query = "SELECT * FROM " . $this->table . " WHERE tingkat_pelanggaran = ? ORDER BY tingkat_pelanggaran, nama_jenis_pelanggaran";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $tingkat);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results ? $results : false;
    }

    public function getListPelanggaranByNamaAndTingkat($nama, $tingkat){
        $conditions = [];
        $params = [];

        if ($nama) {
            $conditions[] = "nama_jenis_pelanggaran LIKE ?";
            $params[] = "%" . $nama . "%";
        }

        if ($tingkat) {
            $conditions[] = "tingkat_pelanggaran = ?";
            $params[] = $tingkat;
        }

        $whereClause = $conditions ? implode(" AND ", $conditions) : "1 = 1";

        $query = "SELECT * 
        FROM ". $this->table ."
        WHERE 
        $whereClause";
        var_dump($query);
        $stmt = $this->conn->prepare($query);
        foreach ($params as $index => $param) {
            $stmt->bindValue($index + 1, $param);
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results ? $results : false;
    }
}
?>