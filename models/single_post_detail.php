<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../php_login/db_connection.php';

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Check if the project_id is provided
        if (!isset($_GET['project_id'])) {
            http_response_code(400); // Bad request
            echo json_encode(array("message" => "Missing project_id parameter"));
            exit();
        }
        
        // Fetch the project_id from the request
        $project_id = $_GET['project_id'];

        // Fetch the info about the single post from the database
        $stmt = $pdo->prepare("SELECT u.fullname,
            sp.title,
            sp.project_desc,
            sp.date_of_post,
            sp.date_of_completion,
            sp.address,
            sp.contact,
            sp.budget,
            c.category_name
            FROM service_post sp
            JOIN users u ON sp.user_id = u.user_id
            JOIN category c ON sp.category_id = c.category_id
            WHERE sp.project_id = ?");
            
        $stmt->execute([$project_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Post found, return as JSON
            http_response_code(200); // OK
            echo json_encode($result);
        } else {
            // No post found with the provided project_id
            http_response_code(404); // Not Found
            echo json_encode(array("message" => "Post not found"));
        }
        break;
    default:
        // Method not allowed
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("message" => "Method not allowed"));
        break;
}
?>
