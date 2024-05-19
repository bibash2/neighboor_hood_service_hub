<?php

session_start();
if (!isset($_SESSION['logged_user_id'])) {
    header("Location: ./php_login/logout.php");
    exit;
}
$user_id = $_SESSION['logged_user_id'];

?>
<!-- C:\xampp\htdocs\neighboor_hood_service_hub\includes\registerAsServiceProvider.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once "../includes/nav.php" ?>
    <form action="" id="registerServiceProvider">

        <legend>Register As a Service Provider</legend>

        <label for="">Primary Phone no</label><br>
        <input type="tel" id="phone" required>

        <label for="">Working location</label><br>
        <input type="text" id="location" required>

        <?php
        require "./category_list.php" ?><br>

        <input type="submit"><br>

    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#registerServiceProvider");
            form.addEventListener("submit", async function(event) {
                event.preventDefault();
                const phoneNo = document.querySelector("#phone").value;
                const location = document.querySelector("#location").value;
                const category = document.querySelector("#category").value;

                const data = {
                    "phoneNo": phoneNo,
                    "location": location,
                    "category": category,
                    "userId": <?php echo $user_id ?>
                }

                console.log(JSON.stringify(data));
    
                const response = await fetch('http://localhost/neighboor_hood_service_hub/models/register_as_service_provider.php', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data)
                })
                if (!response.ok) {
                    throw new Error("Failed to submit form");
                }

                const responseData = await response.json();
                if(responseData.success == true){
                    window.location.href = '../index.php'
                }
            })
        })
    </script>
</body>

</html>