<?php

session_start();
if (!isset($_SESSION['logged_user_id'])) {
    header("Location: ./php_login/logout.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=100&id=77118&format=png&color=000000">

    <title>Neighboor Service Hub</title>
        <style>
        .card {
            display: flex;
            flex-direction: column;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            box-sizing: border-box;
            height: 40vh;
            width: 60%;
            background-color: #444;
            transition: box-shadow 0.3s;
            position: relative;
            font-family: sans-serif;
            color: #fff;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .header {
            margin-bottom: 0;
        }

        .header h4 {
            margin: 0;
            color: #fff;
        }

        .header p {
            font-size: 14px;
            color: #bbb;
        }

        .card-info {
            display: flex;
            flex-direction: row;
            gap: 6rem;
            margin-top: 2rem;
        }

        .card-info span {
            font-size: 14px;
            color: #fff;
            background-color: #333;
            padding: 5px;
            border-radius: 4px;
        }

        .add_bid:hover {
            background-color: #45a049;
        }

        .bid {
            display: flex;
            flex-direction: column;
            width: 30rem;
            padding: 15px;
            border: 1px solid #444;
            border-radius: 8px;
            background-color: #333;
            position: relative;
            left: 33%;
            font-family: sans-serif;
            bottom: 4rem;
            color: #fff;
        }

        .bid label {
            color: #eee;
        }

        form {
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            color: #eee;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #555;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #666;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #084b83;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #063b6d;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        .posted_bid {
            align-items: center;
            padding: 15px;
            border: 1px solid #444;
            border-radius: 8px;
            background-color: #555;
            width: calc(100% - 2rem);
            position: relative;
            left: 33%;
            bottom: 4rem;
            max-width: 470px;
            font-family: sans-serif;
            color: #fff;
        }

        .posted_bid>div {
            margin-right: 15px;
        }

        .user_name {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            margin: 0;
        }

        .bid_amount {
            font-size: 16px;
            color: #ddd;
            margin: 0;
        }

        .bid_desc {
            font-size: 16px;
            color: #ccc;
            margin-top: 10px;
        }

        .hidden {
            display: none;
        }

        #add_bb {
            padding: 1rem;
            border: 1px solid #444;
            font-weight: bold;
            font-size: 1rem;
            font-family: sans-serif;
            position: relative;
            left: 70%;
            bottom: 4.5rem;
            border-radius: 15px;
            background-color: #555;
            color: #fff;
            cursor: pointer;
        }

        .card i {
            margin-top: 2rem;
        }

        .header p {
            color: #add8e6;
        }

        .card>div {
            margin-bottom: 10px;
        }

        .bid button {
            margin-left: 40%;
            background: #45a049;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .bid button:hover {
            background: #397d3c;
        }
    </style>
</head>

<body>
    <?php
    require "../includes/nav.php";
    ?>
    <!-- bid detail section -->
    <div class="container">
    </div>

    <!-- bid post show section -->
    <div class="all_bid">

    </div>


    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const project_id = urlParams.get('project_id');


        document.addEventListener("DOMContentLoaded", () => {

            // get the single post detail from the database 
            const container = document.querySelector(".container");
            fetch(`http://localhost/neighboor_hood_service_hub/models/single_post_detail.php?project_id=${project_id}`, {
                method: "GET"
            }).then((response) => {
                return response.json();
            }).then((data) => {
                console.log(data);
                container.innerHTML = `
        <div class="card">
            <div>Posted By: ${data.fullname}</div>
            <div class="header">
                <h4>${data.title}</h4>
                <p><span>5</span> days left</p>
            </div>
            <p>${data.project_desc}</p>
            <div class="card-info">
                <span>Budget: ${data.budget}</span>
                <span>${data.category_name}</span>
                <span>Address: ${data.address}</span>
                <span>Deadline: ${data.date_of_completion}</span>
                <p>1 bid</p>
            </div>
        </div>`;
            }).catch((error) => {
                console.error('Error:', error);
            });
        });



        // Get the all the bid post form the database

        let all_bid = document.querySelector('.all_bid');
        fetch(`http://localhost/neighboor_hood_service_hub/models/bid.php?project_id=${project_id}`, {
                method: "GET"
            }).then(response => {
                return response.json();
            })
            .then((data) => {
                data.reverse();
                data.forEach(bid => {
                    console.log(bid.fullname)
                    all_bid.innerHTML += `
        <div class="posted_bid">
            <div>
                <p class="user_name"><span>${bid.fullname}</span></p>
                <p class="bid_amount"> Bid amount: ${bid.bid_amount}</p>
                <p class="posted date">Posted at: ${bid.bid_post_date}</p>
            </div>
            <p class="bid_desc">${bid.bid_desc}</p>
        </div> `

                });

            });
    </script>
</body>

</html>