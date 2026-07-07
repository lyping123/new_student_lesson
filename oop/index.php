<?php
// 1. Wake up the Composer Librarian!
require_once __DIR__ . '/vendor/autoload.php';

// 2. Get the requested URL path (e.g., '/users' or '/products')
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 3. Simple Routing Logic
switch ($request_uri) {
    case '/':
        echo "Welcome to the Homepage!";
        break;

    case '/users':
        // Thanks to PSR-4, we don't need require_once here!
        $controller = new App\Controllers\UserController();
        $controller->showUsers();
        break;

    case '/products':
        // In a real app, you'd have a ProductController here
        $controller = new App\Controllers\ProductController();
        $controller->showProducts();
        break;
    default:
        // Handle 404
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}