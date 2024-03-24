<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

require_once '../php_login/db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        $project_id = $_GET['project_id'];
        $stmt = $pdo->prepare('SELECT b.bid_id, b.bid_amount, b.bid_desc, u.fullname
            FROM bid b
            JOIN users u ON b.user_id = u.user_id
            WHERE b.project_id = ?;');
        $stmt->execute([$project_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
        break;


    case "POST":
        $data = json_decode(file_get_contents('php://input'), true);
        $bid_desc = $data['bid_desc'];
        $bid_amount = $data['bid_amount'];
        $user_id = $data['user_id'];
        $project_id = $data['project_id'];

        $stmt = $pdo->prepare('INSERT INTO bid (bid_desc,bid_amount , user_id, project_id) VALUES(?,?,?,?)');

        $result = $stmt->execute([$bid_desc,$bid_amount,$user_id,$project_id]);
        if ($result) {
            // Post found, return as JSON
            http_response_code(200); // OK
            echo json_encode($result);
        } else {
            // No post found with the provided project_id
            http_response_code(404); // Not Found
            echo json_encode(array("message" => "unable to post"));
        }
  
        break;

    case "DELETE":
        $bid_id = $_GET['bid_id'];
        $stmt = $pdo->prepare('DELETE FROM bid WHERE bid_id=?');
        $stmt->execute([$bid_id]);
        break;

    default:
        // Invalid method
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
