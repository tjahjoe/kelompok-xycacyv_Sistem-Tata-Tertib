<?php
require_once __DIR__ . "/../../config/database.php";
class ListPelanggaran{
    private $conn;
    private $table = "ListPelanggaran";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getListPelanggaran(){
        $query = "SELECT * FROM " . $this->table ." ORDER BY tingkat_pelanggaran, nama_jenis_pelanggaran";
        $stmt = $this->conn->query($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        } else {
            false;
        }

    }
}
?>