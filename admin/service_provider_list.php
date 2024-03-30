<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once "../admin/admin_includes/nav.php"
    ?>
    <div class="show_all_service_provider">
        <div class="serivce_provider_card">
            <b>name</b>
            <p>category</p>
            <p>rating</p>
            <p>location</p>
            <button>Delete</button>
        </div>
    </div>

    <script>
        const showAllServiceProvider = document.querySelector(".show_all_service_provider");
        async function all_service_provider() {
            const response = await fetch("utl", {
                method: "GET"
            })
            const service_providers = response.json();
            await service_providers.forEach(service_provider => {
                let index = 1;
                showAllServiceProvider.innerHTML += `
        <div class="serivce_provider_card" data-id="${index++}">
            <b>${service_provider.fullname}</b>
            <p>${service_provider.category_name}</p>
            <p>${service_provider.rating}</p>
            <p>${service_provider.location}</p>
            <button class="delete">Delete</button>
        </div>
                `;


                deleteBtn.addEventListener("click", async () => {
                    const deleteBtn = document.querySelector(`.delete[data-id=${index+1}]`);
                    const response = await fetch(`service_provider_id=${category.service_provider_id}`,{
                        method:"DELETE"
                    });
                })

            })


        }
    </script>
</body>

</html>