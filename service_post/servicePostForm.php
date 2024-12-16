<?php

session_start();
if (!isset($_SESSION['logged_user_id'])) {
    header("Location: ./php_login/logout.php");
    exit;
}
$user_id = $_SESSION['logged_user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=100&id=77118&format=png&color=000000">
    <title>Neighboor Service Hub</title>
    <style>
        .container {
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            max-width: 450px;
            padding: 40px;
            margin-top: 3rem;
        }

        .container h1 {
            margin: 0 0 20px 0;
            text-align: center;
            font-family: 'Arial', sans-serif;
            color: #fff;
            font-size: 24px;
        }

        button {
            font-family: 'Arial', sans-serif;
            font-size: 1rem;
            outline: none;
            cursor: pointer;
            background-color: #084b83;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background-color: #063b6d;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.3);
        }

        .container .input {
            padding: 15px;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #888;
            border-radius: 5px;
            font-size: 15px;
            font-family: 'Arial', sans-serif;
            background-color: #555;
            color: #fff;
            transition: border-color 0.3s;
        }

        .input:hover {
            border-color: #aaa;
        }

        .input:focus {
            border-color: #0d6efd;
            outline: none;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
        }

        [type="text"],
        [type="number"],
        [type="date"],
        select {
            height: 5vh;
            width: 98%;
            border-radius: 5px;
            border: 1px solid #888;
            margin-bottom: 15px;
            padding-left: 10px;
            font-size: 15px;
            font-family: 'Arial', sans-serif;
            background-color: #555;
            color: #fff;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        [type="text"]:focus,
        [type="number"]:focus,
        [type="date"]:focus,
        select:focus {
            border-color: #0d6efd;
            outline: none;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
        }

        option {
            font-size: 16px;
            font-family: 'Arial', sans-serif;
            background-color: #444;
            color: #fff;
        }

        [type="submit"] {
            background: #084b83;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 0;
            cursor: pointer;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.2);
            margin-top: 5px;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        [type="submit"]:hover {
            background-color: #063b6d;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.3);
        }

        label {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
            color: #fff;
        }

        .hidden {
            display: none;
            color: red;
        }
    </style>
</head>

<body>
    <?php require_once "../includes/nav.php" ?>
    <form id="Form">
        <div class="container">
            <h1>Post Project</h1>
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="description">Description:</label><br>
            <textarea type="text" id="description" name="description"></textarea><br> <!-- Added name attribute -->
            <label for="">Service Category:</label><br>
            <select id="category" name="category"> <!-- Removed for attribute -->
                <option value="1">Electrician</option>
                <option value="2">Plumber</option>
                <option value="3">cleaner</option>
                <option value="3"> House maidr</option>
                <option value="5">Painter</option>
                <option value="6">Furnishing</option>
                <option value="7">Gardner</option>
            </select><br>
            <label for="budget">Budget</label><br>
            <input type="text" id="budget" name="budget"><br>
            <label for="completiondate">Deadline</label><br>
            <input type="date" id="deadline" name="deadline" min="2024-06-19"><br> <!-- Added name attribute -->
            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address"><br> <!-- Added name attribute -->
            <label for="number">Contact:</label><br>
            <input type="text" id="contact" name="contact"><br> <!-- Added name attribute -->
            <input type="submit">
            <input type="text" class="hidden" id="error">
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#Form');

            form.addEventListener('submit', async function(event) {
                event.preventDefault(); // Prevent default form submission

                try {
                    const title = document.querySelector('#title').value;
                    const description = document.querySelector('#description').value;
                    const category = document.querySelector('#category').value;
                    const deadline = document.querySelector('#deadline').value;
                    const address = document.querySelector('#address').value;
                    const contact = document.querySelector('#contact').value;
                    const budget = document.querySelector('#budget').value;
                    const error = document.querySelector('#error');

                    if (!title || !description || !category || !deadline || !address || !contact || !budget) {
                        alert('Please fill out all fields.');
                        return;
                    }

                    // Contact validation
                    if (contact.length < 10 || !(contact.startsWith('98') || contact.startsWith('97'))) {
                        alert('Contact number must be at least 10 digits and start with 98 or 97.');
                        return;
                    }

                    const data = {
                        "title": title,
                        "description": description,
                        "category": category,
                        "deadline": deadline,
                        "address": address,
                        "contact": contact,
                        "budget": budget,
                        "user_id": <?php echo $user_id; ?> // Assuming session ID represents user ID
                    };

                    const response = await fetch("http://localhost/neighboor_hood_service_hub/models/all_post.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(data)
                    });
                    if (!response.ok) {
                        throw new Error('Failed to submit form');
                    }

                    const responseData = await response.json();
                    if (responseData.success === true) {
                        window.location.href = "../index.php";
                    } else {
                        window.location.href = "index.php";
                    }



                } catch (error) {
                    console.error(error);
                }
            });
        });
    </script>

</html>