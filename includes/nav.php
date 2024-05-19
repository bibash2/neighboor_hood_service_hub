<?php

?>

<style>
    nav {
        background-color: #333;
        /* Background color */
        padding: 10px;
        height: 1rem;
        padding-left:20%;
        padding-right: 20%;
    }

    .navBar{
        display: flex;
        flex-direction: row;
        width: parent;
        justify-content: space-between;
        background-color: red;
        width: 100%;
       
    }

    nav>div:nth-child(1) {
        float: left;
        /* Float the first group of links to the left */
    }

    nav>div {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    nav>div:nth-child(2) {
        float: right;
        /* Float the second group of links to the right */
    }

    nav li {
        display: inline-block;
        /* Display list items horizontally */
        margin-right: 10px;
        /* Add some margin between list items */
    }

    nav a {
        color: #fff;
        /* Text color */
        text-decoration: none;
        /* Remove underline */
        padding: 5px 10px;
        /* Add padding */
    }

    nav a:hover {
        background-color: #555;
        /* Change background color on hover */
    }

    .logo {
        text-align: center;
    }

    .profile,
    .your_activity {
        color: #fff;
        cursor: pointer;
    }

    .profile_detail,
    .activity {
        visibility: hidden;
        position: absolute;
        background-color: #333;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 5;
        display: flex;
        flex-direction: column;
        align-items: center;

    }

    .show {
        visibility: visible;
    }
</style>
<div class="logo">
    <h4>Neighborhood Service Hub</h4>
</div>

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
            <button><a href="../php_login/logout.php">Logout</a></button>
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
            <button><a href="../../neighboor_hood_service_hub/includes/registerAsServiceProvider.php">Register as service Provider</button>
            <button><a href="../php_login/logout.php">Logout</a></button>
        </div>
    </div>
</div>`;
        }
    }

    get_service_provider().then(() => {
        document.querySelector(".your_activity").addEventListener("mouseover", () => {
            const activity = document.querySelector(".activity");
            activity.classList.toggle("show");
        })
    }).then(() => {
        document.querySelector(".profile").addEventListener("mouseover", () => {
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
//               ?>
       
//     })
//   }
//     })
    

</script>