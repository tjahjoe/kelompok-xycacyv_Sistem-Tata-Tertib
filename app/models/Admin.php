<?php
require_once __DIR__ . "/../../config/database.php";
class Admin{
    private $conn;
    private $table = "Admin";
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function getDataAdmin($nip){
        $query = "SELECT * FROM " . $this->table . " WHERE nip = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nip);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}
?>