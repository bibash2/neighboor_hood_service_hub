<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

require_once '../php_login/db_connection.php';
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":

        $user_id = $_GET['user_id'];
        $stmt = $pdo->prepare("select u.fullname, sp.category_id
        from users u
        join service_provider sp on u.user_id = sp.user_id
        where u.user_id = ?;");
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

       echo json_encode($result);
}


