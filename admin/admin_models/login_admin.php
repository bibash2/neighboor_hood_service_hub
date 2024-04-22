<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Set other CORS headers if needed
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

require_once '../../php_login/db_connection.php';
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        $email = $_GET["email"];
        $password = $_GET["password"];
        $stmt = $pdo->query("SELECT * FROM users WHERE is_admin =true");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($email == $row["email"] && $password == $row["password"]){
            echo json_encode(["success"=>true]);
        }else{
            echo json_encode(["success"=>false]);
        }
       
}
