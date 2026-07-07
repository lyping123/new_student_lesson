<?php 

namespace App\Controllers;

class ProductController {
    public function showProducts() {
        echo json_encode(["Product A", "Product B", "Product C"]);
    }
}
