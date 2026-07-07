<?php 

namespace App\Controllers;

class UserController {
    public function showUsers() {
        echo json_encode(["User 1", "User 2", "User 3"]);
    }
}