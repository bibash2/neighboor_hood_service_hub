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
    case "GET":
        $user_id = $_GET['user_id'];
        $stmt = $pdo->prepare(
                            "SELECT w.work_id, 
                            w.work_buget, 
                            w.work_desc, 
                            w.user_id, 
                            w.service_provider_id, 
                            w.work_post_at, 
                            w.location, 
                            w.contact, 
                            w.deadline, 
                            w.work_status,
                            sp.fullname AS service_provider_fullname,
                            c.category_name
                    FROM work w
                    LEFT JOIN service_provider s ON w.service_provider_id = s.service_provider_id
                    LEFT JOIN users sp ON s.user_id = sp.user_id
                    LEFT JOIN category c ON s.category_id = c.category_id
                    WHERE w.user_id = ?;"
        );

        $stmt->execute([$user_id]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($row);
    
    
        
}
