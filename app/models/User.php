<?php
require_once __DIR__ . "/../../config/database.php";
class User{
    private $conn;
    private $table = "User";

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }

    public function login($username, $password){
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(1, $username);
        $stmt->bind_param(2, $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        } else {
            return false;
        }
    }
}
?>