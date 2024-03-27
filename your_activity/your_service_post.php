<?php

session_start();
if (!isset($_SESSION['logged_user_id'])) {
    header("Location: ./php_login/logout.php");
    exit;
}
$user_id=$_SESSION['logged_user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;

        }

        .card {
            width: 50rem;
            border: 1px solid whitesmoke;
            border-radius: 8px;
            padding: 15px;
            margin: 15px;
            background-color: #f0eeee;
            transition: box-shadow 0.3s;
            position: relative;
            top: 1rem;
            left: 15rem;
            height: 8rem;
            /* box-shadow: 3px 1rem 1rem rgba(16, 16, 130, 0.1); */
        }

        .card:hover {
            box-shadow: 3px 1rem 1rem rgba(16, 16, 130, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header h4 {
            margin: 0;
        }

        .header p {
            font-size: 14px;
            color: #777;
        }

        .card-info {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .card-info span {
            font-size: 12px;
            color: #555;
        }

        .bid {
            background-color: #4CAF50;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>

<body >
    <?php
        require "../includes/nav.php";
    ?>
   <div class="container">
  
   </div>

    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            let container = document.querySelector('.container');
        console.log(container)
       
        fetch("http://localhost/neighboor_hood_service_hub/models/all_post.php", {
            method: "GET"
        }).then((response) => {
            return response.json();



        }).then(data => {
            data.reverse();
            data.forEach(element => {
                console.log(element)
                // replace 3 with current user id
                if(element.user_id ===<?php echo $user_id ?>){
                    container.innerHTML += `
                    <a href="./your_service_detail.php?project_id=${element.project_id}" class="card-link">

                        <div class="card">
                         <div>Posted By:${element.fullname}</div>
                            <div class="header">
                                <h4>${element.title}</h4>
                                <p><span>5</span> days ago</p>
                            </div>
                            <p>${element.project_desc}</p>
                            <div class="card-info">
                                <span>Budget: ${element.budget}</span>
                                <span>Category: ${element.category_name}</span>
                                <span>Address: ${element.address}</span>
                                <span>Deadline: ${element.date_of_completion}</span>
                                <span class="bid">4 bid</span>
                            </div>
                        </div>
                    </a>
                `;
                }
                return;
                
            })
        })
        })
    </script>

</body>

</html>
</body>
</html>