<?php
require_once __DIR__ . "/../../config/database.php";
class TingkatPelanggaran
{
    private $conn;
    private $table = "TingkatPelanggaran";
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConneection();
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

    // public function deleteTingkatPelanggaran($id)
    // {
    //     $query = "UPDATE 
    //     PelanggaranMahasiswa 
    //     SET id_tingkat_pelanggaran = ? 
    //     WHERE id_tingkat_pelanggaran = ?";
    //     $this->conn->beginTransaction();
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindValue(1, 0);
    //     $stmt->bindParam(2, $id);
    //     $stmt->execute();

    //     $query = "DELETE " . $this->table . " WHERE id_tingkat_pelanggaran = ?";
    //     $stmt->bindParam(1, $id);
    //     $stmt->execute();
    //     $this->conn->commit();
    // }

    // public function updateTingkatPelanggaran($idAwal, $idAkhir, $tingkat, $deskripsi, $sanksi)
    // {

    //     $this->conn->beginTransaction();
    //     if ($idAwal != $idAkhir) {
    //         $query = "SELECT * FROM " . $this->table . " WHERE id_tingkat_pelanggaran = ?";
    //         $stmt = $this->conn->prepare($query);
    //         $stmt->bindParam(1, $idAkhir);
    //         $stmt->execute();
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //         if ($result) {
    //             $this->conn->commit();
    //             return false;
    //         }
    //     }

    //     $query = "UPDATE 
    //     PelanggaranMahasiswa 
    //     SET id_tingkat_pelanggaran = ? 
    //     WHERE id_tingkat_pelanggaran = ?";
    //     $this->conn->beginTransaction();
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindValue(1, 0);
    //     $stmt->bindParam(2, $idAwal);
    //     $stmt->execute();

    //     $query = "UPDATE " . $this->table . "
    //     SET
    //     id_tingkat_pelanggaran = ?,
    //     tingkat = ?,
    //     deskripsi = ?,
    //     sanksi = ?
    //     WHERE id_tingkat_pelanggaran = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $idAkhir);
    //     $stmt->bindParam(2, $tingkat);
    //     $stmt->bindParam(3, $deskripsi);
    //     $stmt->bindParam(4, $sanksi);
    //     $stmt->bindParam(5, $idAwal);
    //     $stmt->execute();
    //     $this->conn->commit();
    //     return true;
    // }

    // public function createTingkatPelanggaran($id, $tingkat, $deskripsi, $sanksi)
    // {
    //     $this->conn->beginTransaction();
    //     $query = "SELECT * FROM " . $this->table . " WHERE id_tingkat_pelanggaran = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $id);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if ($result) {
    //         $this->conn->commit();
    //         return false;
    //     }

    //     $query = "INSERT INTO TingkatPelanggaran VALUES  (?,?,?,?)";
    //     $stmt->bindParam(1, $id);
    //     $stmt->bindParam(2, $tingkat);
    //     $stmt->bindParam(3, $deskripsi);
    //     $stmt->bindParam(4, $sanksi);
    //     $stmt->execute();
    //     $this->conn->commit();
    //     return true;
    // }
}
?>