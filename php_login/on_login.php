<?php
function on_login($pdo){
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    
    // if there is any empty field
    if (empty($email) || empty($pass)) {
        $arr = [];
        if (empty($email)) $arr["email"] = "Must not be empty.";
        if (empty($pass)) $arr["password"] = "Must not be empty.";
        return [
            "ok" => 0,
            "field_error" => $arr
        ];
    }
    
    // checking the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            "ok" => 0,
            "field_error" => [
                "email" => "Invalid email address."
            ]
        ];
    }

    // Finding the user by email
    $stmt= $pdo->prepare('select * from users where email=?');
    $stmt->execute([$email]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo ($row);
    // if the user does not exist in the database
    if($row === NULL){
        return [
            "ok" => 0,
            "field_error" => [
                "email" => "This email is not registered."
            ]
        ];
    }

    // Verifying the user password
    $password_check = password_verify($pass, $row["password"]);
    if($password_check === false){
        return [
            "ok" => 0,
            "field_error" => [
                "password" => "Incorrect Password."
            ]
        ];
    }

    // Setting the user id to the session
    $_SESSION['logged_user_id'] = $row["user_id"];  
    header('Location: ../index.php');
    exit;
}