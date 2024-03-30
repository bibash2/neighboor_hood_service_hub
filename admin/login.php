<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" class="loginForm">
        <label for="email">Email</label>
        <input type="email" id="email" require><br>

        <label for="password">Password</label>
        <input type="password" id="password" require><br>
        <input type="submit">
        <div class="error"></div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const loginForm = document.querySelector(".loginForm");
            loginForm.addEventListener("submit", async (event) => {
                event.preventDefault();

                const email = document.querySelector("#email").value
                const password = document.querySelector("#password").value


                const response = await fetch(`http://localhost/neighboor_hood_service_hub/admin/admin_models/login_admin.php?email=${email}&password=${password}`);
                const login = await response.json();
                console.log(login);
                if (login.success == true) {
                    window.location.href = "admin_panel.php";
                } else {
                    const error = document.querySelector(".error");
                    const message = document.createElement("p");
                    message.innerHTML = "incorrect credential please try again";
                    message.style.color="red";
                    error.appendChild(message);
                }

            })
        })
    </script>
</body>

</html>