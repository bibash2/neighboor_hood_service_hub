<?php
session_start();
if (isset($_SESSION['logged_user_id'])) {
    header("Location : ../index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . "/db_connection.php";
    require_once __DIR__ . "/on_register.php";
    if (
        isset($pdo) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])
    ) {
        $result = on_register($pdo);
    }
}


?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
<div class="container">
        <h1>Sign Up</h1>
        <form action="" method="POST" id="theForm">
            <label for="user_name">Name: <span></span></label>
            <input type="text" class="input" name="name" id="user_name" placeholder="Your name">

            <label for="user_email">Email: <span></span></label>
            <input type="email" class="input" name="email" id="user_email" placeholder="Your email">



            <label for="user_pass">Password: <span></span></label>
            <input type="password" class="input" name="password"  id="user_pass" placeholder="New password">
            <?php if (isset($result["msg"])) { ?>
                <p class="msg<?php if ($result["ok"] === 0) {
                                    echo " error";
                                } ?>"><?php echo $result["msg"]; ?></p>
            <?php } ?>
            <input type="submit" value="Sign Up">
            <div class="link"><a href="./login.php">Login</a></div>
        </form>
    </div>

    <?php
    if (isset($result["field_error"])) { ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let field_error = <?php echo json_encode($result["field_error"]); ?>;

                for (let fieldName in field_error) {
                    let inputElement = document.querySelector(`input[name="${fieldName}"]`);
                    inputElement.classList.add("error");

                    let labelElement = document.querySelector(`label[for="${inputElement.getAttribute("id")}"] span`);
                    labelElement.innerText = field_error[fieldName];
                }
            });
        </script>
    <?php
    }
    ?>

</body>

</html>