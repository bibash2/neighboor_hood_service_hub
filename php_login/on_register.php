<?php

function on_register($pdo)
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if (empty($name) || empty($email) || empty($pass)) {
        $arr = [];
        if (empty($name)) $arr['name'] = "Must not be empty";
        if (empty($email)) $arr['email'] = "Must not be empty";
        if (empty($pass)) $arr['password'] = "Must not be empty";

        return [
            "ok" => 0,
            "field_error" => $arr
        ];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            "ok" => 0,
            "field_error" => [
                "email" => "Invalid email address."
            ]
        ];
    }

    if (strlen($pass) < 4) {
        return [
            "ok" => 0,
            "field_error" => [
                "password" => "Must be at least 4 character."
            ]
        ];
    }
   
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $is_contain_email = $stmt->fetch(PDO::FETCH_ASSOC);

    if($is_contain_email){
        return [
            "ok" => 0,
            "field_error" =>[
                "email" => "This email is already registered."
            ]
            ];
    }



    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("Insert into users ( email, fullname, password) values (?,?,?)");
    $is_inserted=$stmt->execute([$email,$name,$pass]);

    if($is_inserted){
        return [
            "ok" =>1,
            "msg" => "You have registered succesfuly.",
            "form_reset" => true
        ];
    }

    return [
        "ok" => 0,
        "msg" => "something going wrong"
    ];


    
}
