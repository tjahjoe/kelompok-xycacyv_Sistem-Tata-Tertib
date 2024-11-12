<?php
require_once __DIR__ . "/../../config/database.php";
class User{
    private $conn;
    private $table = "Users";

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function login($username, $password){
        
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        if ($result['role'] == 'mahasiswa') {
            $query = "SELECT * FROM Mahasiswa WHERE nim = ?";
        } else if (in_array($result['role'], ['dosen', 'dpa', 'kps', 'sekjur'])) {
            $query = "SELECT * FROM Dosen WHERE nip = ?";
        } else if ($result['role'] == 'admin') {
            $query = "SELECT * FROM Admin WHERE nip = ?";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $result['id_users']);
        $stmt->execute();

        $isValue = $stmt->fetch(PDO::FETCH_ASSOC);

        return $isValue ? $result : false;
    }
}
?>