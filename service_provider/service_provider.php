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
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="./your_work.css">
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=100&id=77118&format=png&color=000000">

    <title>Neighboor Service Hub</title>
    <style>
        .service_provider_card {
            margin-bottom: 15px;
            border: 1px solid #444;
            padding: 15px;
            border-radius: 8px;
            background-color: #333;
            color: #fff;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .service_provider_card:hover {
            background-color: #555;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .service_provider_card a {
            text-decoration: none;
            color: #4CAF50;
            transition: color 0.3s;
        }

        .service_provider_card a:hover {
            color: #66BB6A;
        }

        .service_provider_row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .service_provider_row b,
        .service_provider_row p {
            margin: 5px;
            color: #ddd;
        }

        /* Additional improvements for better readability */
        .service_provider_row b {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .service_provider_row p {
            font-size: 1rem;
        }

        /* Make text more readable on hover */
        .service_provider_card:hover b,
        .service_provider_card:hover p {
            color: #fff;
        }

        .myAccount {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .myAccount:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <?php
    require "../includes/nav.php"
    ?>
    <div>
        <!-- <php
        require_once "../includes/category_list.php";
        require_once "../includes/rating.php";
        ?> -->
        <!-- <button class="filter">Filter</button> -->
        <button class="myAccount">My service provider account</button>
    </div>
    <!-- <input type="search" id="search" placeholder="name of the service provider"> -->
    <div class="display_service-provider">
        <!-- <div class="service_provider_card">
            <a href="service_provider_detail.php">
                <b>Service Provider Name</b>
                <p>Category</p>
                <p>Rating</p>
                <p>Primary Location</p>
            </a>
        </div> -->
    </div>


    <script>
        // document.addEventListener("DOMContentLoaded", async () => {
        //     const display_serivce_providers = document.querySelector(".display_service-provider");
        //     const response = await fetch("http://localhost/neighboor_hood_service_hub/models/all_service_provider.php", {
        //         method: "GET"
        //     })

        //     const service_providers = await response.json();

        //     service_providers.forEach((service_provider) => {
        //         console.log(service_provider)

        //         fetch(`http://localhost/neighboor_hood_service_hub/models/get_rating.php?service_provider_id=${service_provider.service_provider_id}`)

        //             .then(response => response.json())
        //             .then((data) => {
        //                     const lengthOfRating = data.length;
        //                     var totalRating = 0;
        //                     var rating = 0;
        //                     if (lengthOfRating == 0) {
        //                         rating = 0;
        //                     } else {
        //                         for (let x in data) {
        //                             totalRating += data[x].rating;
        //                         }
        //                         rating = totalRating / lengthOfRating;

        //                     }


        //                     display_serivce_providers.innerHTML += `
        // <div class="service_provider_card">
        //     <a href="service_provider_detail.php?service_provider_id=${service_provider.service_provider_id}&rating=${rating.toFixed(1)}">
        //         <b>${service_provider.fullname}</b>
        //         <p>${service_provider.category_name}</p>
        //         <p>${rating.toFixed(1)}⭐</p>
        //         <p>${service_provider.location}</p>
        //         <p>${service_provider.contact}</p>
        //     </a>
        // </div>
        //                 `
        //                 }

        //             )

        //     })

        //     const myServiceProviderAccount = document.querySelector(".myAccount");
        //     myServiceProviderAccount.addEventListener("click", () => {
        //         display_serivce_providers.innerHTML = ``;
        //         service_providers.forEach(service_provider => {
        //             if (service_provider.user_id == <?php echo $user_id; ?>) {
        //                 display_serivce_providers.innerHTML +=
        //                     `
        //     <div class="service_provider_card">
        //         <a href="service_provider_detail.php?service_provider_id=${service_provider.service_provider_id}&rating=${rating}">
        //             <b>${service_provider.fullname}</b>
        //             <p>${service_provider.category_name}</p>
        //             <p>${service_provider.rating}⭐</p>
        //             <p>${service_provider.location}</p>
        //             <p>${service_provider.contact}</p>
        //         </a>
        //     </div>
        //                     `
        //             } 
        //             // else {
        //             //     display_serivce_providers.innerHTML = `You are not register as a service Provider`
        //             // }
        //         })
        //     })


        // })


        // const filterBtn = document.querySelector('.filter');


        // filterBtn.addEventListener("click", async (e) => {
        //     e.preventDefault();
        //     const display_serivce_providers = document.querySelector(".display_service-provider");
        //     display_serivce_providers.innerHTML = ``;
        //     const rating = document.querySelector("#rating").value;
        //     const category_id = document.querySelector("#category").value;


        //     const filter_data = await fetch(`http://localhost/neighboor_hood_service_hub/models/filter_service_provider.php?rating=${rating} & category_id=${category_id}`);
        //     const filter_service_providers = await filter_data.json();

        //     if (filter_service_providers.length === 0) {
        //         display_serivce_providers.innerHTML = `Result not found`
        //     }
        //     filter_service_providers.forEach(service_provider => {
        //         console.log(service_provider)
        //         display_serivce_providers.innerHTML += `
        // <div class="service_provider_card">
        //     <a href="service_provider_detail.php?service_provider_id=${service_provider.service_provider_id}&rating=${rating}">
        //         <b>${service_provider.fullname}</b>
        //         <p>${service_provider.category_name}</p>
        //         <p>${service_provider.rating.toFixed(1)}⭐</p>
        //         <p>${service_provider.location}</p>
        //         <p>${service_provider.contact}</p>
        //     </a>
        // </div>
        //                 `
        //     })




        // })
        document.addEventListener("DOMContentLoaded", async () => {
            const display_service_providers = document.querySelector(".display_service-provider");
            const response = await fetch("http://localhost/neighboor_hood_service_hub/models/all_service_provider.php", {
                method: "GET"
            });

            const service_providers = await response.json();
            service_providers.reverse();
            const ratings = {};

            const ratingPromises = service_providers.map(async (service_provider) => {
                const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_rating.php?service_provider_id=${service_provider.service_provider_id}`);
                const data = await response.json();
                data.reverse();
                const lengthOfRating = data.length;
                let totalRating = 0;
                let rating = 0;
                if (lengthOfRating > 0) {
                    for (let x in data) {
                        totalRating += data[x].rating;
                    }
                    rating = totalRating / lengthOfRating;
                }
                ratings[service_provider.service_provider_id] = rating;
                return {
                    service_provider,
                    rating
                };
            });

            const ratedServiceProviders = await Promise.all(ratingPromises);

            ratedServiceProviders.forEach(({
                service_provider,
                rating
            }) => {
                display_service_providers.innerHTML += `
            <div class="service_provider_card">
                <a href="service_provider_detail.php?service_provider_id=${service_provider.service_provider_id}&rating=${rating.toFixed(1)}">
                    <b>${service_provider.fullname}</b>
                    <p>${service_provider.category_name}</p>
                    <p>${rating.toFixed(1)}⭐</p>
                    <p>${service_provider.location}</p>
                    <p>${service_provider.contact}</p>
                </a>
            </div>
        `;
            });

            const myServiceProviderAccount = document.querySelector(".myAccount");
            var flag = true;
            myServiceProviderAccount.addEventListener("click", () => {
                display_service_providers.innerHTML = ``;
                service_providers.forEach(service_provider => {
                    if (service_provider.user_id == <?php echo $user_id; ?>) {
                        flag = false;
                        const rating = ratings[service_provider.service_provider_id] || 0;
                        display_service_providers.innerHTML += `
                    <div class="service_provider_card">
                        <a href="service_provider_detail.php?service_provider_id=${service_provider.service_provider_id}&rating=${rating.toFixed(1)}">
                            <b>${service_provider.fullname}</b>
                            <p>${service_provider.category_name}</p>
                            <p>${rating.toFixed(1)}⭐</p>
                            <p>${service_provider.location}</p>
                            <p>${service_provider.contact}</p>
                        </a>
                    </div>
                `;
                        return
                    }
                    // if (service_provider.user_id !== <?php echo $user_id; ?>) {
                    //     display_service_providers.innerHTML = "You are not register as a service provider";
                    // }
                });
                if (flag) {
                    display_service_providers.innerHTML = "You are not register as a service provider";
                }
            });

            const filterBtn = document.querySelector('.filter');
            filterBtn.addEventListener("click", async (e) => {
                e.preventDefault();
                display_service_providers.innerHTML = ``;
                const rating = document.querySelector("#rating").value;
                const category_id = document.querySelector("#category").value;

                const filter_data = await fetch(`http://localhost/neighboor_hood_service_hub/models/filter_service_provider.php?rating=${rating}&category_id=${category_id}`);
                const filter_service_providers = await filter_data.json();

                if (filter_service_providers.length === 0) {
                    display_service_providers.innerHTML = `Result not found`;
                } else {
                    filter_service_providers.forEach(service_provider => {
                        const service_provider_rating = ratings[service_provider.service_provider_id] || 0;
                        display_service_providers.innerHTML += `
                    <div class="service_provider_card">
                        <a href="service_provider_detail.php?service_provider_id=${service_provider.service_provider_id}&rating=${service_provider_rating.toFixed(1)}">
                            <b>${service_provider.fullname}</b>
                            <p>${service_provider.category_name}</p>
                            <p>${service_provider_rating.toFixed(1)}⭐</p>
                            <p>${service_provider.location}</p>
                            <p>${service_provider.contact}</p>
                        </a>
                    </div>
                `;
                    });
                }
            });
        });
    </script>
</body>

</html>