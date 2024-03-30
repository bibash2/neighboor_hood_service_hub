<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require "../admin/admin_includes/nav.php"
    ?>
    <div>
        <input type="text" id="category">
        <button>Add category</button>
    </div>

    <br>
    <div class="show_category">

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addCategory = document.querySelector("button");
            addCategory.addEventListener("click", async () => {
                const data = {
                    "category": document.querySelector("#category").value
                }

                const response = await fetch("", {
                    method: "POST",
                    header: {
                        "content-type": "application/json",
                    },
                    body: JSON.stringify(data)
                })

                const response_data = await response.json();
                if (response.success == true) {
                    document.querySelector("#category").value = "";
                }
            })

            async function showAllCategory() {
                const response = await fetch("url");
                const categorys = response.json();
                categorys.forEach(category => {
                    document.querySelector(".show_category").innerHTML += `<p>category.category_name`;
                })
            }
        })
    </script>
</body>

</html>