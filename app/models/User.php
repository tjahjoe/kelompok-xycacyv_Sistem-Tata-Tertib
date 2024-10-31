<?php
require_once __DIR__ . "/../../config/database.php";
class User{
    // private $conn;
    // private $table = "User";

    // public function __construct(){
    //     $database = new Database();
    //     $this->conn = $database->getConneection();
    // }

    public function login($username, $password){
        
        if($username == '123' && $password == '12345'){
            return true;
        }
        return false;
        
        // $query = "SELECT * FROM " . $this->table . " WHERE id = ? AND password = ?";
        // $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(':username', $username);
        // $stmt->bindParam(':password', $password);
        // $stmt->execute();
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // if($result){
        //     return $result;
        // } else {
        //     return false;
        // }
    }
}
?>