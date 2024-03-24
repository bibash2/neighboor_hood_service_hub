<?php

session_start();
require_once "./php_login/on_login.php";
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
    <link rel="stylesheet" href="landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>

<?php require_once "./includes/nav.php" ?>
    <!-- <body>
        <div class="area"></div>
        <nav class="main-menu">
            <ul>
                <p style="font-size:1.2rem; position:relative; left:0.1rem; font-weight:bolder; font-family:sans-serif; color:white;">Neighborhood Service Hub</p>
                <li>
                    <a href="https://jbfarrow.com">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Home
                        </span>
                    </a>

                </li>
                <li class="has-subnav">
                    <a href="./service/servicecard.html">
                        <i class="fa fa-comment-dots fa-2x"></i>
                        <span class="nav-text">
                            All Posts
                        </span>
                    </a>

                </li>
                <li class="has-subnav">
                    <a href="#">
                        <i class="fa fa-comments fa-2x"></i>
                        <span class="nav-text">
                            Service Provider
                        </span>
                    </a>

                </li>
                <li class="has-subnav">
                    <a href="#">
                        <i class="fa fa-solid fa-chart-line fa-2x"></i>
                        <span class="nav-text">
                            Your Activity
                        </span>
                    </a>

                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-solid fa-gear fa-2x"></i>
                        <span class="nav-text">
                            Settings
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-solid fa-users fa-2x"></i>
                        <span class="nav-text">
                            About us
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
                <li>
                    <a href="./php_login/logout.php">
                        <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text ">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
            
        </nav>
        <div class="post">
            <ul>
                <li><a href="./servicePostForm.php"><button>Post</button></a></li>
                <li><a><button onclick="menuToggle();">Profile</button></a></li>
            </ul>
            <div class="menu">
                <h3>Name</h3>
                <h3>Email</h3>
                <h3><a href="./service/becomeserviceprovider.html">Become a service provider</a></h3>

                <script>
                    function menuToggle() {
                        const togglemenu = document.querySelector('.menu');
                        togglemenu.classList.toggle('active');
                    }
                </script>
            </div>
        </div>

        <div class="all-service-post">
            <?php
            require "./servicecard.php";
            ?>
           
        </div>
      

    </body> -->
</body>
<script>
   
</script>

</html>