<style>
    nav {
        background-color: #333;
        /* Background color */
        padding: 10px;
        height: 1rem;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        position: sticky;
    }

    nav>div:nth-child(1) {
        float: left;
        /* Float the first group of links to the left */
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
</style>
<div class="logo">
    <h4>Neighborhood Service Hub</h4>
</div>

<nav>
    <div>
        <li><a href="../../neighboor_hood_service_hub/servicecard.php">All Post</a></li>
        <li><a href="../../neighboor_hood_service_hub/service_provider/service_provider.php">Service Provider</a></li>
        <li><a href="../../neighboor_hood_service_hub/your_activity/your_service_post.php">Your Activity</a></li>
        <li><a href="../../neighboor_hood_service_hub/Your_work/your_work.php">Your work</a></li>
    </div>

    <div>
        <li><a href="../../neighboor_hood_service_hub/servicePostForm.php">Post</a></li>
        <li><a href="">Profile</a></li>
    </div>

</nav>

<script>
    async function get_service_provider() {
        const user = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_user.php?user_id=${<?php echo $_SESSION['logged_user_id'];  ?>}`);
        const user_data = await user.json();
       
        const service_provider = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_service_provider.php?user_id=${<?php echo $_SESSION['logged_user_id'];  ?>}`);
        const service_provider_data = await service_provider.json();
      
        if (<?php echo $_SESSION['logged_user_id'];  ?> === service_provider_data.user_id) {

            document.querySelector("nav").innerHTML = ` 
    <div>
        <li><a href="../../neighboor_hood_service_hub/all_post/servicecard.php">All Post</a></li>
        <li><a href="../../neighboor_hood_service_hub/service_provider/service_provider.php">Service Provider</a></li>
        <li><a href="../../neighboor_hood_service_hub/your_activity/your_service_post.php">Your Activity</a></li>
        <li><a href="../../neighboor_hood_service_hub/Your_work/your_work.php?service_provider_id=${service_provider_data.service_provider_id}">Your work</a></li>
    </div>

    <div>
        <li><a href="../../neighboor_hood_service_hub/service_post/servicePostForm.php">Post</a></li>
        <li><a href="">${user_data[0].fullname}</a></li>
    </div>`;
        } else {
            document.querySelector("nav").innerHTML = ` 
    <div>
        <li><a href="../../neighboor_hood_service_hub/all_post/servicecard.php">All Post</a></li>
        <li><a href="../../neighboor_hood_service_hub/service_provider/service_provider.php">Service Provider</a></li>
        <li><a href="../../neighboor_hood_service_hub/your_activity/your_service_post.php">Your Activity</a></li>
    </div>

    <div>
        <li><a href="../../neighboor_hood_service_hub/service_post/servicePostForm.php">Post</a></li>
        <li><a href="">${user_data[0].fullname}</a></li>
    </div>`;
        }



    }

    get_service_provider();
</script>