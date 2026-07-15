<?php 
namespace App\Model;
use App\Config\Database;

class Users{
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table_name;
        $sttr = $this->conn->query($query);
        $result = [];
        $result=$sttr->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function addUser($requestData) {
        $name = $requestData['name'];
        $email = $requestData['email'];
        $password = $requestData['password'];

        $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sds", $name, $email, $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($id, $requestData) {
        $name = $requestData['name'];
        $email = $requestData['email'];
        $password = $requestData['password'];

        $query = "UPDATE " . $this->table_name . " SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsi", $name, $email, $password, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


?>