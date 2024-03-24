<?php
// session_start();
// if (isset($_SESSION['logged_user_id'])) {
//     // Start the session if not already started
//     $user_id = $_SESSION['logged_user_id'];
// } else {
//     header("location: ../php_login/logout.php");
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        .container {
            background-color: whitesmoke;
            border-radius: 7px;
            box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175);
            margin: 0 auto;
            max-width: 450px;
            padding: 40px;
            margin-top: 3rem;
        }

        .container h1 {
            margin: 0 0 20px 0;
            text-align: center;
            font-family: sans-serif;
            color: #767474;
        }

        button {
            font-family: sans-serif;
            font-size: 1rem;
            outline: none;
        }

        .container .input {
            padding: 15px;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #bbbbbb;
            border-radius: 3px;
            padding-left: 5px;
        }

        .input:hover {
            border-color: #999999;
        }

        .input:focus {
            border-color: #0d6efd;
        }

        [type="text"],
        [type="number"] {
            /* border-collapse: collapse; */
            height: 5vh;
            width: 98.4%;
            border-radius: 3px;
            border: 1px solid #bbbbbb;
            margin-bottom: 15px;
            padding-left: 5px;
            font-size: 15px;
            font-family: sans-serif;
            /* background-color: #bbbbbb; */
        }

        [type="date"] {
            height: 5vh;
            width: 98.4%;
            border-radius: 3px;
            border: 1px solid #bbbbbb;
            margin-bottom: 15px;
            padding-left: 7px;
            font-size: 15px;
            font-family: sans-serif;
        }

        select {
            height: 5vh;
            width: 100%;
            border-radius: 3px;
            border: 1px solid #bbbbbb;
            margin-bottom: 15px;
            padding-left: 7px;
            font-size: 15px;
            font-family: sans-serif;
        }

        option {
            font-size: 16px;
            font-family: sans-serif;
            padding-right: 4px;
        }

        [type="submit"] {
            background: #084b83;
            color: white;
            border: 1px solid rgba(0, 0, 0, 0.175);
            border-radius: 3px;
            padding: 12px 0;
            cursor: pointer;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-top: 5px;
            font-weight: bold;
            width: 100%;
        }

        [type="submit"]:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        label {
            font-family: sans-serif;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 3px;
            color: #767474;
        }

        .hidden {
            display: none;
            color: red,
        }
    </style>
</head>

<body>
<?php require_once "./includes/nav.php" ?>
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
                <option value="3">	House maidr</option>
                <option value="5">Painter</option>
                <option value="6">Furnishing</option>
                <option value="7">Gardner</option>
            </select><br>
            <label for="budget">Budget</label><br>
            <input type="text" id="budget" name="budget"><br>
            <label for="completiondate">Deadline</label><br>
            <input type="date" id="deadline" name="deadline"><br> <!-- Added name attribute -->
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
                    const error = document.querySelector('#error').value;

                    const data = {
                        "title": title,
                        "description": description,
                        "category": category,
                        "deadline": deadline,
                        "address": address,
                        "contact": contact,
                        "budget": budget,
                        "user_id": 3 // Assuming session ID represents user ID
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
                        window.location.href = "index.php"
                        // window.location.href = "servicecard.php"
                    } else {
                        
                        window.location.href = "index.php"
                    }

                } catch (error) {
                    console.error(error);
                }
            });
        });
    </script>

</html>