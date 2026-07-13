<?php 

namespace App\Config;
use mysqli;

class Database {
    private $host = "localhost";         
    private $db_name = "ecommerce"; 
    private $username = "root";
    private $password = "1234";
    private $port=3307;
    public $conn;

    public function getConnection() {       
        $this->conn = null;
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name, $this->port);
        if ($this->conn->connect_error) {
            die("Database Connection Failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

}
