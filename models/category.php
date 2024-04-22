<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

require_once '../php_login/db_connection.php';
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * from category");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
        break;
    }
    