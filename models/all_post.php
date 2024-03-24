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
        // Read operation (fetch books)
        $stmt = $pdo->query('SELECT u.fullname,
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
 JOIN category c ON sp.category_id = c.category_id;
 ');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);


        break;
    case 'POST':
        // Create operation (add a new book)
        try {
            $data = json_decode(file_get_contents('php://input'), true);


            // Extract data from the JSON array
            $header = $data['title'];
            $desc = $data['description'];
            $deadline = $data['deadline'];
            $address = $data['address'];
            $contact = $data['contact'];
            $user_id = $data['user_id'];
            $category = $data['category'];
            $budget = $data['budget'];

            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare('INSERT INTO service_post (title, project_desc, date_of_completion, address, contact, user_id, category_id,budget) VALUES (?, ?, ?, ?, ?, ?, ?,?)');
            $result = $stmt->execute([$header, $desc, $deadline, $address, $contact, $user_id, $category, $budget]);

            if ($result) {
                echo (json_encode(["success" => $result]));
            } else {
                echo json_encode(["success" => $result]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }


        // case 'PUT':
        //     // Update operation (edit a book)
        //     $data = json_decode(file_get_contents('php://input'), true);
        //     $header = $data['title'];
        //     $desc = $data['desc'];
        //     $deadline = $data['deadline'];
        //     $address = $data['address'];
        //     $content = $data['contact'];
        //     $category=$data['category'];

        //     $stmt = $pdo->prepare('UPDATE service_post SET header=?, desc=?, posted_at=?, deadline=?, address=?, content=?  WHERE id=?');
        //     $stmt->execute([$header, $desc, $posted_at, $deadline, $address, $content]);

        //     echo json_encode(['message' => 'post updated successfully']);
        //     break;
        // case 'DELETE':
        //     // Delete operation (remove a book)
        //     $id = $_GET['id'];

        //     $stmt = $pdo->prepare('DELETE FROM books WHERE id=?');
        //     $stmt->execute([$id]);

        //     echo json_encode(['message' => 'post deleted successfully']);
        //     break;
        // default:
        //     // Invalid method
        //     http_response_code(405);
        //     echo json_encode(['statusText' => 'Method not allowed']);
        //     break;
}
