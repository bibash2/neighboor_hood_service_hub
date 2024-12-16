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
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .card-link {
                text-decoration: none;
                color: inherit;
            }

            .card {
                width: 50rem;
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 20px;
                margin: 20px auto;
                background-color: #bbb;
                transition: box-shadow 0.3s, border 0.3s;
                position: relative;
                top: 1rem;
                height: 8rem;
                color: #333;
            }

            .card-link:hover .card {
                border: 2px solid blue;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            .header h4 {
                margin: 0;
                font-size: 1.2rem;
                color: #333;
            }

            .header p {
                font-size: 0.9rem;
                color: #555;
            }

            .card-info {
                display: flex;
                justify-content: space-between;
                margin-top: 15px;
                color: #333;
            }

            .card-info span {
                font-size: 1rem;
                color: blue;
            }

            .bid {
                background-color: #4CAF50;
                color: #fff;
                padding: 8px 15px;
                border-radius: 4px;
                font-size: 1rem;
                transition: background-color 0.3s;
            }

            .bid:hover {
                background-color: #45a049;
            }

            .card-link:hover {
                border-radius: 4px;
            }

            .container {
                width: fit-content;
                margin: 0 auto;
            }

            .card .card-info span {
                font-size: 1rem;
                color: #333;
            }

            .card>div {
                font-size: 1rem;
                color: #333;
            }

            .header>h4 {
                font-size: 1.2rem;
                color: #333;
            }
        </style>
    </head>

    <body>
        <?php
        require "../includes/nav.php";
        ?>
        <div class="container">

        </div>
        <p id="null"></p>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let container = document.querySelector('.container');
                let noPost = document.querySelector('#null')
                console.log(container)

                fetch("http://localhost/neighboor_hood_service_hub/models/all_post.php", {
                    method: "GET"
                }).then((response) => {
                    return response.json();



                }).then(data => {
                    data.reverse();

                    if (data.length == 0) {
                        noPost.innerHTML = "You don't have any post"
                    }

                    const day_left = (date) => {
                        const current_date = new Date();
                        const date_of_complition = new Date(date);
                        const difference_in_days = Math.ceil((date_of_complition - current_date) / (1000 * 24 * 60 * 60));
                        if (difference_in_days < 0) {
                            return `closed`;
                        }
                        return `${difference_in_days} day left`;

                    }

                    const total_bid = async (project_id) => {
                        const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_bid.php?project_id=${project_id}`, {
                            method: "GET"
                        })

                        const bids = await response.json();
                        return bids.total_bid;

                    }

                    data.forEach(async element => {

                        const bid = await total_bid(element.project_id);
                        // replace 3 with current user id
                        if (element.user_id === <?php echo $user_id ?>) {
                            container.innerHTML += `
                    <a href="./your_service_detail.php?project_id=${element.project_id}" class="card-link">

                        <div class="card">
                         <div>Posted By:${element.fullname}</div>
                            <div class="header">
                                <h4>${element.title}</h4>
                                <p>${day_left(element.date_of_completion)}</p>
                            </div>
                            <p>${element.project_desc}</p>
                            <div class="card-info">
                                <span>Budget: ${element.budget}</span>
                                <span>Category: ${element.category_name}</span>
                                <span>Address: ${element.address}</span>
                                <span>Deadline: ${element.date_of_completion}</span>
                                <span class="bid">${bid} bid</span>
                            </div>
                        </div>
                    </a>
                `;

                        }
                        return;

                    })
                })
            })
        </script>

    </body>

    </html>
</body>

</html>