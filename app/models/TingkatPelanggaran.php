<?php
require_once __DIR__ . "/../../config/database.php";
class TingkatPelanggaran{
    private $conn;
    private $table = "TingkatPelanggaran";
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getSanksiByTingkat($tingkat){
        $query = "SELECT 
        sanksi
        FROM ". $this->table ."
        WHERE id_tingkat_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $tingkat);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result : false;
    }
}
?>