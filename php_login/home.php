<?php
session_start();
if (isset($_SESSION['logged_user_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css" class="stylesheet">
    <title>Neighborhood Service Hub</title>
    <style>
        .midbody h1 {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
            color: #084b83;
            margin-top: 2rem;
        }

        .midbody .mini ul {
            display: flex;
            justify-content: space-around;
            margin-top: 2rem;
        }

        .midbody .mini ul li {
            list-style-type: none;
        }

        .mini li {
            box-sizing: border-box;
            height: 19vh;
            width: 17%;
            /* border: 1px solid black; */
            padding: 1rem;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            margin-top: 0;
            color: white;
            background-color: #084b83;
            border-radius: 20px;
            font-family: sans-serif;
            font-size: 19px;
        }
    </style>
</head>

<body>
    <div class="textsearch">
        <!-- <div class="servicepr">
            <a href="" style=" font-family: sans-serif;">Become a service provider</a>
        </div> -->
        <div class="box">
            <div class="searchbar">
                <input type="search" placeholder="Browse Services">
                <label for="" class="icon"><i class="fa-solid fa-magnifying-glass"></i></label>
            </div>
        </div>
    </div>
    <div class="back">
        <div class="header">
            <div class="logo">
                <p style="color: white; font-family: sans-serif;
                font-size: 1.1rem; font-weight: bold;">
                    Neighborhood Service hub
                </p>
            </div>
            <div class="header2">
                <ul>
                    <li><a href="login.php"><i class="fa-solid fa-user"></i>Login</a></li>
                    <li><a href="./register.php">Signup</a></li>
                </ul>
            </div>
        </div>
        <div class="mainbody">
            <div class="left-c">
                <p>
                    Get your desired services<br> at your door!!!
                </p>
                <img src="helpdesk.png" height="400px" width="700px">

            </div>
            <div class="right-c">
                <p style="font-family: sans-serif; text-align: center; color: rgb(229, 223, 223);">
                    <span style="font-size: 30px;">Neighborhood Service Hub</span><br><br>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab iure alias natus nesciunt reiciendis cum, facilis similique, distinctio dolorem mollitia suscipit dolorum vero,
                    corrupti explicabo doloribus ratione sint sit! Labore.<br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit dolores esse ullam quisquam, hic magni adipisci consequuntur iste! Iusto in tenetur repudiandae nobis nulla eos beatae eum expedita quod explicabo.
                </p>
            </div>
        </div>
    </div>
    <div class="midbody">
        <h1>What we offer</h1>
        <!-- <div class="imgoffer">
            <ul>
                <li><img src="/images/communication.png"></li>
                <li></li>
                <li></li>
            </ul>
        </div> -->
        <div class="mini">
            <ul>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    Easy communication between users and service provider<br>
                </li>
                <li>
                    <i class="fa-regular fa-pen-to-square"></i>
                    Post and request service
                </li>
                <li>
                    <i class="fa-solid fa-check-to-slot"></i>
                    Choose service provider you like
                </li>
            </ul>
        </div>
    </div>
    <div class="spbox">
        <p style="color:#084b83; font-family: sans-serif;
                font-size: 2rem; font-weight: bold; display:flex; justify-content:center; align-items:center; margin-bottom:0;">Our highly rated service provider</p>
        <ul>
            <div class="left-s">
                <li>hi Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae sint ea enim, error veritatis necessitatibus officia, asperiores quam reprehenderit mollitia, delectus iusto voluptate corrupti iste et hic sunt praesentium similique.</li>
                <li>hehe Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque amet magni reprehenderit modi nemo doloribus illum corrupti incidunt inventore. Fugiat neque temporibus molestias assumenda architecto consequatur totam quas ea quod?</li>
            </div>
            <div class="right-s">
                <li>hoho Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus, distinctio fugiat omnis corporis, culpa nam earum ullam explicabo dicta eligendi incidunt iure. Aut omnis rerum inventore excepturi illo voluptatem ratione.</li>
                <li>hiehie Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor nisi quae quod iure inventore perferendis esse sequi delectus tenetur, necessitatibus deserunt velit eos beatae eius sint obcaecati! Veniam, id consectetur!</li>
            </div>
    </div>
    </ul>
    <div class="details">
        <p>For more details</p>
    </div>
    <div class="footer">
        <div class="contact">
            <ul>
                <li><i class="fa-solid fa-phone"></i>+977-9812345678</li>
                <li><i class="fa-solid fa-envelope"></i> nsh@gmail.com</li>
            </ul>
        </div>
    </div>
</body>

</html>