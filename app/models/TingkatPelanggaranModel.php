<?php
require_once __DIR__ . "/../../config/database.php";
class TingkatPelanggaranModel extends Database
{
    public function __construct()
    {
        $this->conn = $this->getConneection();
        $this->table = "TingkatPelanggaran";
    }

    public function getSanksiByTingkat($tingkat)
    {
        $query = "SELECT 
        sanksi
        FROM " . $this->table . "
        WHERE id_tingkat_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $tingkat);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : false;
    }
}
?>