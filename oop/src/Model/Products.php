<?php 
namespace App\Model;

use App\Config\Database;

class Products {
    private $conn;
    private $table_name = "products";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProducts() {
        
        $query = "SELECT * FROM " . $this->table_name;
        $sttr = $this->conn->query($query);
        $result = [];
        $result=$sttr->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}

