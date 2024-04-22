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
            $rating = $_GET['rating'];
            $category = $_GET['category_id'];

            $stmt = $pdo->prepare("SELECT u.fullname, sp.location, sp.contact, c.category_name, AVG(r.rating) AS rating
            FROM users u
            JOIN service_provider sp ON sp.user_id = u.user_id
            JOIN category c ON c.category_id = sp.category_id
            JOIN review r ON r.service_provider_id = sp.service_provider_id
            WHERE sp.service_provider_id IN (
                select service_provider_id 
                from review 
                where rating = ?
                )
                AND c.category_id =?
            GROUP BY u.fullname, sp.location, sp.contact, c.category_name");

            $stmt->execute([$rating,$category]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($row);

        }
?>
