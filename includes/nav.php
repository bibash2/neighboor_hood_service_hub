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