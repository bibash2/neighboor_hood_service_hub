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
        $service_provider_id = $_GET["service_provider_id"];
        $stmt = $pdo->prepare('SELECT u.fullname, c.category_name, sp.location, sp.contact, sp.user_id, sp.service_provider_id
        FROM service_provider sp
        JOIN users u ON sp.user_id = u.user_id
        JOIN category c ON sp.category_id = c.category_id;
        WHERE service_provider_id= ?;
        ');
        $stmt->execute([$service_provider_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);
        break;

    default:
        // Method not allowed
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("message" => "Method not allowed"));
        break;
}
