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
    <title>Document</title>
</head>

<body>
    <?php
    require "../includes/nav.php"
    ?>
    <input type="search" id="search">
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
        document.addEventListener("DOMContentLoaded", async () => {
            const display_serivce_providers = document.querySelector(".display_service-provider");
            const response = await fetch("http://localhost/neighboor_hood_service_hub/models/all_service_provider.php", {
                method: "GET"
            })

            const service_providers = await response.json();
            console.log(service_providers);
            service_providers.forEach((service_provider) => {
                fetch(`http://localhost/neighboor_hood_service_hub/models/get_rating.php?service_provider_id=${service_provider.service_provider_id}`)

                    .then(response => response.json())
                    .then((data) => {
                            const lengthOfRating = data.length;
                            var totalRating = 0;
                            var rating = 0;
                            if (lengthOfRating == 0) {
                                rating = 0;
                            } else {
                                for (let x in data) {
                                    totalRating += data[x].rating;
                                }
                                rating = totalRating/lengthOfRating;

                            }


                            display_serivce_providers.innerHTML += `
        <div class="service_provider_card">
            <a href="service_provider_detail.php?service_provider_id=${service_provider.service_provider_id}&rating=${rating}">
                <b>${service_provider.fullname}</b>
                <p>${service_provider.category_name}</p>
                <p>${rating}⭐</p>
                <p>${service_provider.location}</p>
            </a>
        </div>
                        `
                        }

                    )

            })
        })
    </script>
</body>

</html>