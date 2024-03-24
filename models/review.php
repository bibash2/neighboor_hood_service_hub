<?php
require_once 'config.php';
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
        $service_provider_id = $_GET['service_provider_id'];
        $stmt = $pdo->prepare('select r.review_id, r.review_text, r.rating, u.fullname,r.review_post_at
        from users u
        join review r on u.user_id = r.user_id
        where service_provider_id = ?');
        $result = $stmt->exec([$service_provider_id]);
        return json_encode($result);

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $review_text = $data['review_desc'];
        $rating = $data['rating'];
        $service_provider_id = $data['service_provider_id'];
        $user_id = $data['user_id'];

        $stmt = $pdo->prepare('INSERT INTO review (review_text, rating, service_provider_id, user_id)
        VALUES(?,?,?,?)');
        $result = $stmt->execute([$review_text, $rating, $service_provider_id, $user_id]);

        if ($result) {
            echo (json_encode(["success" => $result]));
        } else {
            echo json_encode(["success" => $result]);
        }
        break;

    case 'DELETE':
        $review_id = $_GET['review_id'];
        $stmt = $pdo->prepare('DELETE from reviews where review_id = ?');
        $result = $stmt->exec([$review_id]);

        if ($result) {
            echo (json_encode(["success" => $result]));
        } else {
            echo json_encode(["success" => $result]);
        }
        break;

    default:
        http_response_code(404);
        return (['message' => 'Method not found']);
}
