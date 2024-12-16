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
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=100&id=77118&format=png&color=000000">

    <title>Neighboor Service Hub</title>
        <style>
        /* Center the form in the middle of the page with some top margin */
        /* body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        } */

        #registerServiceProvider {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            margin-top: 50px;
            margin-left: 40%;
            /* Add top margin */
        }

        #registerServiceProvider legend {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        #registerServiceProvider label {
            align-self: flex-start;
            margin-top: 10px;
        }

        #registerServiceProvider input[type="tel"],
        #registerServiceProvider input[type="text"],
        #registerServiceProvider select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        #registerServiceProvider input[type="submit"] {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 1em;
            cursor: pointer;
        }

        #registerServiceProvider input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php require_once "../includes/nav.php" ?>

    <form action="" id="registerServiceProvider">
        <legend>Register As a Service Provider</legend>

        <label for="">Primary Phone no</label><br>
        <input type="tel" id="phone" required>

        <label for="">Working location</label><br>
        <input type="text" id="location" required><br>
        <label for="">Choose Category</label>
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

                if (!phoneNo || !category || !location) {
                    alert('Please fill out all fields.');
                    return;
                }

                // Contact validation
                if (phoneNo.length < 10 || !(phoneNo.startsWith('98') || phoneNo.startsWith('97'))) {
                    alert('Contact number must be at least 10 digits and start with 98 or 97.');
                    return;
                }

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
                if (responseData.success == true) {
                    window.location.href = '../all_post/servicecard.php'
                }
            })
        })
    </script>
</body>

</html>