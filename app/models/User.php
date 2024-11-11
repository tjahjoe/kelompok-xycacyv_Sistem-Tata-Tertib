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

        if($result){
            return $result;
        } else {
            return false;
        }
    }
}
?>