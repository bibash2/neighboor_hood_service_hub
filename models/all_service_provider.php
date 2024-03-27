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
        $stmt = $pdo->query('SELECT u.fullname, c.category_name, sp.location, sp.contact, sp.user_id, sp.service_provider_id
        FROM service_provider sp
        JOIN users u ON sp.user_id = u.user_id
        JOIN category c ON sp.category_id = c.category_id;
        ');
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($row);
        break;


    case 'POST':
        $user_id=$_GET['user_id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $category_id = $data['category_id'];
        $location = $data['location'];
        $contact = $data['contact'];
        $stmt = $pdo->prepare('INSERT INTO service_provider(user_id,category_id, location, contact) VALUES (?,?,?,?)');
        $result = $stmt->execute([$user_id,$category_id, $location, $contact]);
        echo json_encode($result);
        break;




    case 'DELETE':
        $service_provider_id = $_GET['service_provider_id'];

        $stmt = $pdo->prepare('DELETE FROM service_provider WHERE service_provider_id=?');
        $stmt->execute([$service_provider_id]);

        echo json_encode(['message' => 'post deleted successfully']);
        break;




    default:
        // Invalid method
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
