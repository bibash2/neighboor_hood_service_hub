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
        $id = 5;
        $stmt = $pdo->prepare("SELECT fullname from users where user_id=?");
        $result = $stmt->execute([$id]);
       echo $result;
}


