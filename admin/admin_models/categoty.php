<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

require_once '../../php_login/db_connection.php';
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        $stmt = $pdo->query("SELECT * from category_name");
        $row = $stmt->fetch();
        echo json_encode($row);

    case "POST":
        $data = json_decode(file_get_contents('php://input'), true);
        $category_name = $data["category"];
        $stmt = $pdo->prepare("INSERT INTO category (category_name) values (?)");
        $result = $stmt->execute([$category_name]);
        if ($result) {
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["success" => $result]);
        }

    default:
      
       echo json_encode(http_response_code(400));
       echo json_encode(["message"=>"method not found"]);
}
