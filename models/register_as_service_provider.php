<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

require_once '../php_login/db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $data = json_decode(file_get_contents('php://input'), true);
        $contact = $data['phoneNo'];
        $location = $data["location"];
        $category_id = $data["category"];
        $user_id = $data['userId'];
        $stmt = $pdo->prepare("Insert into service_provider(category_id,user_id,location,contact) values (?,?,?,?)");
        $result = $stmt->execute([$category_id, $user_id, $location, $contact]);
        if ($result) {
            echo (json_encode(["success" => $result]));
        } else {
            echo json_encode(["success" => $result]);
        }
        break;
}
