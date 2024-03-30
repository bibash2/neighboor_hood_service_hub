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
    <title>Document</title>
    <style>
        .card {
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 15px;
            box-sizing: border-box;
            height: 40vh;
            width: 60%;
            background-color: #f0eeee;
            transition: box-shadow 0.3s;
            position: relative;
            left: 20%;
            font-family: sans-serif;
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            margin-bottom: 10px;
        }

        .header h4 {
            margin: 0;
        }

        .header p {
            font-size: 14px;
            color: #777;
        }

        .card-info {
            display: flex;
            flex-direction: column;
            margin-top: 15px;
        }

        .card-info span {
            font-size: 12px;
            color: #555;
        }

        .add_bid button:hover {
            background-color: #084b83;
            transition: 0.5s all ease;
            color: white;
        }

        .bid {
            margin: 20px;
            width: 30rem;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f0eeee;
            position: relative;
            left: 33%;
            font-family: sans-serif;
            bottom: 4.5rem;
        }

        .bid input {
            width: 92%;
            position: relative;
            left: 1.3rem;
        }

        .bid label {
            position: relative;
            left: 1.3rem;
        }

        form {
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        label {
            font-size: 16px;
            margin-bottom: 2px;
            color: #333;

        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
            background-color: #084b83;
        }

        /* Optional: Add styles for better visual clarity on focus */
        input:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        .posted_bid {
            align-items: center;
            margin: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f0eeee;
            width: calc(100% - 2rem);
            position: relative;
            left: 33%;
            bottom: 4rem;
            max-width: 470px;
        }

        /* .posted_bid div {
            display: flex;
            justify-content: space-between;
        } */

        .posted_bid>div {
            margin-right: 15px;
        }

        .user_name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .bid_amount {
            font-size: 14px;
            color: #777;
            margin: 0;
        }

        .bid_desc {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        .hidden {
            display: none;
        }

        button {
            padding: 1rem;
            border: 1px solid #ddd;
            font-weight: bold;
            font-size: 1rem;
            font-family: sans-serif;
            position: relative;
            left: 70%;
            bottom: 4.5rem;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <?php
    require_once "../includes/nav.php";
    ?>
    <!-- bid detail section -->
    <div class="container">
    </div>

    <!-- add bid button -->
    <div class="add_bid">
        <button>
            Post Bid
        </button>
    </div>

    <!-- bid form section -->
    <div class="bid hidden">

        <label for="bid_amount">Bid:</label>
        <input type="number" id="bid_amount" name="bid_amount"><br>
        <label for="bid_desc">Description</label>
        <input type="text" id="bid_desc" name="bid_desc"><br>
        <button class="submit">Submit</button>


    </div>


    <!-- message section -->
    <div class="message hidden"></div>

    <!-- bid post show section -->
    <div class="all_bid">

    </div>


    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const project_id = urlParams.get('project_id');


        document.addEventListener("DOMContentLoaded", () => {
            const card = document.querySelector(".card");
            const add_bid = document.querySelector('.add_bid');
            const bid_post = document.querySelector('.bid');
            add_bid.addEventListener('click', () => {
                if (bid_post.style.display === "none" || bid_post.style.display === "") {
                    bid_post.style.display = "block";
                } else {
                    bid_post.style.display = "none"
                }
            });


            // check wheter the service_provider category and project category is equal or not
            const able_to_bid = async (user_id, project_category_id) => {
                // first check whether the user is register as a service provider or not
                const response1 = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_user.php?user_id=${user_id}`);
                const user = await response1.json();
                if (user.length == 0) {
                    return false;
                }
                else if(user.category_id == project_category_id){
                    return true
                }
                return false;
            }








            const total_bid = async (project_id) => {
                const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_bid.php?project_id=${project_id}`, {
                    method: "GET"
                })

                const bids = await response.json();
                return bids.total_bid;

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
            // get the single post detail from the database 
            const container = document.querySelector(".container");
            fetch(`http://localhost/neighboor_hood_service_hub/models/single_post_detail.php?project_id=${project_id}`, {
                method: "GET"
            }).then((response) => {
                return response.json();
            }).then(async (data) => {
                console.log(data)
                const bid = await total_bid(project_id);
                const able_to_bid_in_post = await able_to_bid(<?php echo $user_id; ?>, data.category_id);
                if(able_to_bid_in_post){
                    add_bid.style.display = "block";
                }else{
                    add_bid.style.display = "none";
                }

                const service_post_status = day_left(data.date_of_completion);
                if (service_post_status === "closed") {
                    add_bid.style.display = "none";
                }
                container.innerHTML = `
        <div class="card">
            <div>Posted By: ${data.fullname}</div>
            <div class="header">
                <h4>${data.title}</h4>
                <p>${day_left(data.date_of_completion)}</p>
            </div>
            <p>${data.project_desc}</p>
            <div class="card-info">
                <span>Budget: ${data.budget}</span>
                <span>${data.category_name}</span>
                <span>Address: ${data.address}</span>
                <span>Deadline: ${data.date_of_completion}</span>
                <p>${bid} bid</p>
            </div>
        </div>`;
            }).catch((error) => {
                console.error('Error:', error);
            });
        });



        document.addEventListener("DOMContentLoaded", () => {

            const bid = document.querySelector('.submit');
            bid.addEventListener("click", async function(event) {
                event.preventDefault();
                try {
                    const bid_amount = document.querySelector("#bid_amount").value;
                    const bid_desc = document.querySelector('#bid_desc').value;

                    data = {
                        "bid_amount": bid_amount,
                        "bid_desc": bid_desc,
                        "project_id": project_id,
                        "user_id": <?php
                                    echo $user_id;
                                    ?>
                    }

                    const response = await fetch("http://localhost/neighboor_hood_service_hub/models/bid.php", {
                        method: "POST",
                        header: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(data)
                    });

                    const responseData = await response.json();

                    // if (responseData.success == true) {
                    //     bid_post.style.display = "none";
                    // }



                    // if (responseData == true) {
                    //     message.classList.remove("hidden");
                    //     message.style.backgroundColor = "green";
                    //     message.innerHTML = "Your bid added succesfully"
                    // } else {
                    //     message.classList.remove("hidden");
                    //     message.style.backgroundColor = "red";
                    //     message.innerHTML = "Unable to add the bid! Please try again";
                    // }
                } catch (error) {
                    console.log(error)
                }


            })
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
                        all_bid.innerHTML += `
        <div class="posted_bid">
            <div>
                <p class="user_name"><span>${bid.fullname}</span></p>
                <p class="bid_amount"> Bid amount: ${bid.bid_amount}</p>
                <p class="posted date">Posted: ${day_ago(bid.bid_post_date)}</p>
            </div>
            <p class="bid_desc">${bid.bid_desc}</p>
        </div> `

                    });

                })
            const day_ago = (date) => {
                const current_data = new Date();
                const posted_date = new Date(date);
                const difference_in_days = Math.floor((current_data - posted_date) / (1000 * 24 * 60 * 60));
                if (difference_in_days == 0) {
                    return `recently`;
                }
                return `${difference_in_days} day ago`;
            }

        });
    </script>
</body>

</html>