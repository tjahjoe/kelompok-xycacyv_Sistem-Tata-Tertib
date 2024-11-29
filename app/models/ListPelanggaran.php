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
        // $query = "SELECT * FROM " . $this->table ." ORDER BY tingkat_pelanggaran desc, nama_jenis_pelanggaran";
        $query = "SELECT * FROM " . $this->table ." WHERE tingkat_pelanggaran <> '-' ORDER BY tingkat_pelanggaran desc, nama_jenis_pelanggaran";
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

    public function uploadListPelanggaran($nama, $tingkat){
        $query = "SELECT * FROM ListPelanggaran WHERE nama_jenis_pelanggaran = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nama);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->conn->commit();
            return false;
        }

        $query = "INSERT INTO ". $this->table ." VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nama);
        $stmt->bindParam(2, $tingkat);
        $stmt->execute();
        $this->conn->commit();
        return true;
    }

    public function updateListPelanggaran($id, $nama, $tingkat){

        $query = "SELECT * FROM ListPelanggaran WHERE nama_jenis_pelanggaran = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nama);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if ($result['id_list_pelanggaran'] != $id) {
                $this->conn->commit();
                return false;   
            }
        }
        
        $query = "UPDATE 
        PelanggaranMahasiswa 
        SET id_list_pelanggaran = ? 
        WHERE id_list_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, 0);
        $stmt->bindParam(2, $id);
        $stmt->execute();

        $query = "UPDATE ListPelanggaran 
        SET nama_jenis_pelanggaran = ?,
        tingkat_pelanggaran = ?
        WHERE id_list_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nama);
        $stmt->bindParam(2, $tingkat);
        $stmt->bindParam(3, $id);
        $stmt->execute();
        $this->conn->commit();
        return true;
    }

    public function deleteListPelanggaran($id){
        $query = "UPDATE 
        PelanggaranMahasiswa 
        SET id_list_pelanggaran = ? 
        WHERE id_list_pelanggaran = ?";
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, 0);
        $stmt->bindParam(2, $id);
        $stmt->execute();

        $query = "DELETE ListPelanggaran WHERE id_list_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $this->conn->commit();
        return true;


    }
}
?>