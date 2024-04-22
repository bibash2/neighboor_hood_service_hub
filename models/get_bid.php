<?php
require_once '../php_login/db_connection.php';
// Set the content type to JSON
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {


    case 'GET':
        $project_id = $_GET["project_id"];
        $stmt = $pdo->prepare('SELECT COUNT(b.bid_id) AS total_bid
                              FROM bid b
                              JOIN service_post s ON s.project_id = b.project_id
                              WHERE b.project_id = ?');
        $stmt->execute([$project_id]);
        $row = $stmt->fetch();
        echo json_encode($row);
        break;

    default:
        // Method not allowed
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("message" => "Method not allowed"));
        break;
}
