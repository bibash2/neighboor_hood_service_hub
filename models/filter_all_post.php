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
        $category_name = $_GET["category_id"];
        $stmt = $pdo->prepare('SELECT u.fullname,
        u.user_id,
        sp.project_id,
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
                    where c.category_id=?;
 ');
        $stmt->execute([$category_name]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);


        break;
}
