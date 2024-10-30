<?php
require_once __DIR__ . "/../../config/database.php";
class User{
    private $conn;
    private $table = "";

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConneection();
    }
}
?>