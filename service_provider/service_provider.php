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
    <div class="display_service-provider">
        <div class="service_provider_card">
            <a href="service_provider_detail.php">
                <b>Service Provider Name</b>
                <p>Category</p>
                <p>Rating</p>
                <p>Primary Location</p>
            </a>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const display_serivce_providers = document.querySelector(".display_service-provider");
            fetch("url", {
                    method: "POST"
                }).then((response) => response.json())
                .then((service_providers) => {
                    service_providers.foreach(service_provider => {
                        display_serivce_providers.innerHTML += `
                        <div class="service_provider_card">
            <a href="service_provider_detail.php">
                <b>Service Provider Name</b>
                <p>Category</p>
                <p>Rating</p>
                <p>Primary Location</p>
            </a>
        </div>
                        `
                    })
                })
        })
    </script>
</body>

</html>