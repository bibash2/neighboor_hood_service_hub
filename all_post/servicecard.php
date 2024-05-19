<?php

session_start();
if (!isset($_SESSION['logged_user_id'])) {
    header("Location: ./php_login/logout.php");
    exit;
}
$user_id = $_SESSION["logged_user_id"];

?>

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
            border: 1px solid whitesmoke;
            border-radius: 8px;
            padding: 15px;
            margin: 15px;
            background-color: #f0eeee;
            transition: box-shadow 0.3s;
            position: relative;
            top: 1rem;
            left: 15rem;
            height: 8rem;
            
        }

        .card:hover {
            box-shadow: 3px 1rem 1rem rgba(16, 16, 130, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            justify-content: space-between;
            margin-top: 15px;
        }

        .card-info span {
            font-size: 12px;
            color: #555;
        }

        .bid {
            background-color: #4CAF50;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <?php
    require "../includes/nav.php";
    ?>
    <div>

        <label>Filter by category</label>
        <?php
        require "../includes/category_list.php";
        ?>

        <button class="bidded">Bidded</button>

    </div>
    <div class="container">

    </div>

    <script>
        const container = document.querySelector('.container');

        fetch("http://localhost/neighboor_hood_service_hub/models/all_post.php", {
            method: "GET"
        }).then((response) => {
            return response.json();

        }).then(data => {
            data.reverse();

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

                // Create HTML for each card and append it to the card container
                if (element.user_id == <?php echo $user_id; ?>) {
                    return;
                }

                container.innerHTML += `
                    <a href="./service_detail.php?project_id=${element.project_id}" class="card-link">

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

            })

        })

        const select = document.querySelector("#category");
        select.addEventListener('change', async () => {
            category_id = document.querySelector("#category").value


            //    function to calculate the total day left in the post
            const day_left = (date) => {
                const current_date = new Date();
                const date_of_complition = new Date(date);
                const difference_in_days = Math.ceil((date_of_complition - current_date) / (1000 * 24 * 60 * 60));
                if (difference_in_days < 0) {
                    return `closed`;
                }
                return `${difference_in_days} day left`;

            }

            // function to calculate the total bid in the individual post
            const total_bid = async (project_id) => {
                const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_bid.php?project_id=${project_id}`, {
                    method: "GET"
                })

                const bids = await response.json();
                return bids.total_bid;

            }


            // filter out the post in teh select 
            if (category_id !== 0) {
                const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/filter_all_post.php?category_id=${category_id}`);
                let filter_posts;
                filter_posts = [];
                filter_posts = await response.json();

                container.innerHTML = '';
                if (filter_posts.length === 0) {
                    container.innerHTML = `No post yet`;
                }
                filter_posts.forEach(async element => {
                    const bid = await total_bid(element.project_id);

                    // Create HTML for each card and append it to the card container
                    if (element.user_id == <?php echo $user_id; ?>) {
                        return;
                    }
                    container.innerHTML += `
                    <a href="./service_detail.php?project_id=${element.project_id}" class="card-link">

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
                })
            } else {
                const response = await fetch("http://localhost/neighboor_hood_service_hub/models/all_post.php", {
                    method: "GET"
                });
                const all_post = await response.json();
                all_post.forEach(async post => {
                    const bid = await total_bid(post.project_id);

                    // Create HTML for each card and append it to the card container
                    if (post.user_id == <?php echo $user_id; ?>) {
                        return;
                    }

                    container.innerHTML += `
                    <a href="./service_detail.php?project_id=${post.project_id}" class="card-link">

                        <div class="card">
                         <div>Posted By:${post.fullname}</div>
                            <div class="header">
                                <h4>${post.title}</h4>
                                <p>${day_left(post.date_of_completion)}</p>
                            </div>
                            <p>${post.project_desc}</p>
                            <div class="card-info">
                                <span>Budget: ${post.budget}</span>
                                <span>Category: ${post.category_name}</span>
                                <span>Address: ${post.address}</span>
                                <span>Deadline: ${post.date_of_completion}</span>
                                <span class="bid">${bid} bid</span>
                            </div>
                        </div>
                    </a>
                `;
                })

            }


        })

        const biddedBtn = document.querySelector(".bidded");
      
        biddedBtn.addEventListener("click", async () => {
            let count = 0;
            const response = await fetch("http://localhost/neighboor_hood_service_hub/models/all_post.php", {
                method: "GET"
            });

            const all_post = await response.json();
            all_post.forEach(async post => {
                const bid_response = await fetch(`http://localhost/neighboor_hood_service_hub/models/bid.php?project_id=${post.project_id}`, {
                    method: "GET"
                })

                const bids = await bid_response.json();
                if(bids.lenght == 0){
                    container.innerHTML = ``;
                    container.innerHTML = `NO Post Found !`;
                }
                bids.forEach(bid => {

                    if (bid.user_id === <?php echo $user_id; ?>) {
                        count++;
                        container.innerHTML = ``;
                        container.innerHTML += `
                    <a href="./service_detail.php?project_id=${post.project_id}" class="card-link">

                        <div class="card">
                         <div>Posted By:${post.fullname}</div>
                            <div class="header">
                                <h4>${post.title}</h4>
                                <p>${day_left(post.date_of_completion)}</p>
                            </div>
                            <p>${post.project_desc}</p>
                            <div class="card-info">
                                <span>Budget: ${post.budget}</span>
                                <span>Category: ${post.category_name}</span>
                                <span>Address: ${post.address}</span>
                                <span>Deadline: ${post.date_of_completion}</span>
                                <span class="bid">${count} bid</span>
                            </div>
                        </div>
                    </a>
                `;
                    }else{
                        container.innerHTML = ``;
                    container.innerHTML = `NO Post Found !`;
                    }
                })
            })



        })

             //    function to calculate the total day left in the post
             const day_left = (date) => {
                const current_date = new Date();
                const date_of_complition = new Date(date);
                const difference_in_days = Math.ceil((date_of_complition - current_date) / (1000 * 24 * 60 * 60));
                if (difference_in_days < 0) {
                    return `closed`;
                }
                return `${difference_in_days} day left`;

            }

            // function to calculate the total bid in the individual post
            const total_bid = async (project_id) => {
                const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_bid.php?project_id=${project_id}`, {
                    method: "GET"
                })

                const bids = await response.json();
                return bids.total_bid;

            }
    </script>
</body>

</html>