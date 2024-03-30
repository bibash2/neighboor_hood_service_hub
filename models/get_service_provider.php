<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

require_once '../php_login/db_connection.php';
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {

    case 'GET':
        $user_id=$_GET["user_id"];
        $stmt = $pdo->prepare("SELECT sp.service_provider_id , sp.user_id, sp.category_id
        from service_provider sp
        join users u on u.user_id = sp.user_id 
        where sp.user_id =?");
        $stmt->execute([$user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);
        break;
}
