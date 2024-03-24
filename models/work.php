<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        $service_provider_id = $_GET['user_id'];

        $stmt = $pdo->prepare('SELECT w.work_id, u.fullname, w.work_buget, w.work_desc
        FROM work w
        JOIN users u ON w.user_id = u.user_id
        WHERE w.service_provider_id = ?;');

        $stmt->exec([$service_provider_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);

    case "POST":
        $data = json_decode(file_get_contents('php://input'), true);
        $work_buget = $data['work_budget'];
        $work_desc = $data['work_desc'];
        $user_id = $data['user_id'];
        $service_provider_id = $data['service_provider_id'];

        $stmt = $pdo->prepare('INSERT INTO work (work_amount, work_desc, user_id, service_provider_id) values(?,?,?,?)');
        $result = $stmt->exec([$work_buget, $work_desc, $user_id, $service_provider_id]);

        if ($result) {
            echo (json_encode(["success" => $result]));
        } else {
            echo json_encode(["fail" => $result]);
        }
        break;

    case 'DELETE':
        $work_id = $_GET['work_id'];
        $stmt = $pdo->prepare('DELETE from work where work id =?');
        $result =  $stmt->exec([$work_id]);


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
