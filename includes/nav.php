<?php

?>

<style>
    nav {
        background-color: #333;
        padding: 10px;
        padding-left: 20%;
        padding-right: 20%;
        position: sticky;
        top: 0;
        z-index: 1000;
        height: 40px;
    }

    .navBar {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    nav>div:nth-child(1) {
        float: left;
    }

    nav>div {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    nav>div:nth-child(2) {
        float: right;
    }

    nav li {
        display: inline-block;
        margin-right: 10px;
    }

    nav a {
        color: #fff;
        text-decoration: none;
        padding: 8px 12px;
        transition: background-color 0.3s, color 0.3s;
    }

    nav a:hover {
        background-color: #575757;
        color: #fff;
        border-radius: 4px;
    }

    .logo {
        text-align: center;
        color: #fff;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .profile,
    .your_activity {
        color: #fff;
        cursor: pointer;
        padding: 8px 12px;
        border: 2px solid gray;
        border-radius: 4px;
        transition: background-color 0.3s, color 0.3s;
    }

    .profile:hover,
    .your_activity:hover {
        background-color: #575757;
        color: #fff;
    }

    .profile_detail,
    .activity {
        visibility: hidden;
        position: absolute;
        background-color: #444;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 5;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 4px;
        padding: 10px;
        transition: visibility 0.3s, opacity 0.3s;
        opacity: 0;
    }

    .show {
        visibility: visible;
        opacity: 1;
    }

    .navBar>div>li {
        border: 2px solid gray;
        border-radius: 4px;
        padding: 8px 8px;
        transition: background-color 0.3s, color 0.3s;
    }

    .navBar>div>li:hover {
        background-color: gainsboro;
        color: #333;
    }

    .activity {
        margin-left: 13rem;
        padding: 5px;
    }

    .activity li {
        border: 2px solid gray;
        border-radius: 4px;
        margin: 5px;
        padding: 8px 12px;
        transition: background-color 0.3s, color 0.3s;
    }

    .activity li:hover {
        background-color: gainsboro;
        color: #333;
    }

    #logout {
        background-color: red;
        color: #fff;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s, color 0.3s;
    }

    #logout:hover {
        background-color: darkred;
    }

    #register {
        background-color: #333;
        color: #fff;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s, color 0.3s;
    }

    #register:hover {
        background-color: #444;
    }

    .activity {
        z-index: 1000;
    }

    .profile_detail {
        z-index: 1000;
    }
</style>
<div class="wrapper">

    <nav>
        <!-- <div>
        <li><a href="../../neighboor_hood_service_hub/servicecard.php">All Post</a></li>
        <li><a href="../../neighboor_hood_service_hub/service_provider/service_provider.php">Service Provider</a></li>
        <li><a href="../../neighboor_hood_service_hub/your_activity/your_service_post.php">Your Activity</a></li>
        <li><a href="../../neighboor_hood_service_hub/Your_work/your_work.php">Your work</a></li>
    </div>

    <div>
        <li><a href="../../neighboor_hood_service_hub/servicePostForm.php">Post</a></li>
        <li><a href="">Profile</a></li>
    </div> -->

    </nav>
    <div>
        <script>
            const loggedUserId = <?php echo json_encode($_SESSION['logged_user_id']); ?>;
            console.log(loggedUserId);
            async function get_service_provider() {
                const userResponse = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_user.php?user_id=${loggedUserId}`);
                const user_data = await userResponse.json();
                console.log(user_data);

                const service_provider_response = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_service_provider.php?user_id=${loggedUserId}`);
                const service_provider_data = await service_provider_response.json();

                if (loggedUserId === service_provider_data.user_id) {
                    document.querySelector("nav").innerHTML = ` 
 <div class="navBar">
    <div>
        <li><a href="../../neighboor_hood_service_hub/all_post/servicecard.php">All Post</a></li>
        <li><a href="../../neighboor_hood_service_hub/service_provider/service_provider.php">Service Provider</a></li>
        <li class="your_activity">Your Activity</li>
        <div class="activity">
            <li><a href="../your_activity/your_service_post.php">Service Post</a></li>
            <li><a href="../your_activity/added_work.php">Work</a></li>
        </div>
        <li><a href="../../neighboor_hood_service_hub/Your_work/your_work.php?service_provider_id=${service_provider_data.service_provider_id}">Your work</a></li>
    </div>

    <div>
        <li><a href="../../neighboor_hood_service_hub/service_post/servicePostForm.php">Post</a></li>
        <li class="profile">${user_data[0].fullname}</li>
        <div class= "profile_detail">
            <button>${service_provider_data.category_name}</button>
            <button id="logout"><a href="../php_login/logout.php">Logout</a></button>
        </div>
    </div>
 </div>`;

                } else {
                    document.querySelector("nav").innerHTML = ` 
<div class="navBar">
    <div>
        <li><a href="../../neighboor_hood_service_hub/all_post/servicecard.php">All Post</a></li>
        <li><a href="../../neighboor_hood_service_hub/service_provider/service_provider.php">Service Provider</a></li>
        <li class="your_activity">Your Activity</li>
        <div class="activity">
            <li><a href="../your_activity/your_service_post.php">Service Post</a></li>
            <li><a href="../your_activity/added_work.php">Work</a></li>
        </div>
    </div>

    <div>
        <li><a href="../../neighboor_hood_service_hub/service_post/servicePostForm.php">Post</a></li>
        <li class="profile">${user_data[0].fullname}</li>
        <div class="profile_detail">
            <button id="register"><a href="../../neighboor_hood_service_hub/includes/registerAsServiceProvider.php">Register as service Provider</button>
            <button id="logout"><a href="../php_login/logout.php">Logout</a></button>
        </div>
    </div>
</div>`;
                }
            }

            get_service_provider().then(() => {
                document.querySelector(".your_activity").addEventListener("click", () => {
                    const activity = document.querySelector(".activity");
                    activity.classList.toggle("show");
                })
            }).then(() => {
                document.querySelector(".profile").addEventListener("click", () => {
                    const profieDetail = document.querySelector(".profile_detail");
                    profieDetail.classList.toggle("show")
                })
            })
            //     .then(()=>{
            //         const registerAsServiceProvicer = document.querySelector(".registerServiceProvider");
            //         if(registerAsServiceProvicer){
            //          registerAsServiceProvicer.addEventListener("click",()=>{
            //         <?php
                        //              require_once "./registerAsServiceProvider.php";
                        //               
                        ?>

            //     })
            //   }
            //     })
        </script>