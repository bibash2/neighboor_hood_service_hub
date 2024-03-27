<?php
require_once "../php_login/db_connection.php";
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        $service_provider_id = 6;

        $stmt = $pdo->prepare('SELECT w.work_id, u.fullname, w.work_buget, w.work_desc, w.service_provider_id, w.location, w.contact, w.deadline, w.work_post_at
        FROM work w
        JOIN users u ON w.user_id = u.user_id
        WHERE service_provider_id = ?');
        $stmt->execute([$service_provider_id]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($row);
        break;

    case "POST":
        $data = json_decode(file_get_contents('php://input'), true);
        $work_buget = $data['work_budget'];
        $work_desc = $data['work_desc'];
        $user_id = $data['user_id'];
        $service_provider_id = $data['service_provider_id'];
        $location = $data['location'];
        $contact = $data['contact'];

        $stmt = $pdo->prepare('INSERT INTO work (work_buget,work_desc,user_id,service_provider_id,location,contact) values(?,?,?,?,?,?)');
        $result = $stmt->execute([$work_buget, $work_desc, $user_id, $service_provider_id, $location, $contact]);

        if ($result) {
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["success" => $result]);
        }
        break;

    case 'DELETE':
        $work_id = $_GET['work_id'];
        $stmt = $pdo->prepare('DELETE from work where work id =?');
        $result =  $stmt->execute([$work_id]);


        if ($result) {
            echo (json_encode(["success" => $result]));
        } else {
            echo json_encode(["fail" => $result]);
        }
        break;

    default:
        http_response_code(404);
        return (['message' => 'Method not found']);
}
