<?php
session_start();
if (!isset($_SESSION['logged_user_id'])) {
    header("Location: ./php_login/logout.php");
    exit;
}
$user_id = $_SESSION['logged_user_id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .work_detail {
            border-radius: 9px;
            position: fixed;
            top: 0%;
            left: 20%;
            right: 20%;
            bottom: 20%;
            height: fit-content;
            width: max-content;
            z-index: 4;
            background-color: rgba(0, 0, 1, 0.1);
        }

        .overflow {
            overflow: hidden;

        }

        .blur-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(10px);
            z-index: 1;
        }
    </style>

</head>

<body>
    <?php require_once "../includes/nav.php"; ?>
    <div class="blur"></div>
    <div class="show_all_work">
        <!-- <div class="work_card">
            <p>Posted By:</p>
            <p>work_description</p>
            <p>posted at</p>
            <p>Location</p>
        </div>

        <div class="work_detail">
            <button class="remove">remove</button>
            <p>posted by:</p>
            <p>posted_at</p>
            <p>budget</p>
            <p>deadline:</p>
            <p>Contact:</p>
            <p>location</p>
            <p>work_description</p>
            <div>
                <button class="accet">Accept</button>
                <button class="reject">Reject</button>
            </div>
        </div> -->

    </div>





    <script>
        const all_work = document.querySelector(".show_all_work");
        const blur = document.querySelector(".blur")

        async function show_work_detail() {
            const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_added_work.php?user_id=<?php echo $user_id ?>`, {
                method: "GET"
            });
            const added_works = await response.json();

            if (added_works.length == 0) {
                all_work.innerHTML = `No work for you`;
            }
            var index = 1;
            await added_works.forEach(work => {
                console.log(work);


                all_work.innerHTML +=
                    `<div class="work_card" >
            <p>To:${work.service_provider_fullname}</p>
            <p>${work.work_desc}</p>
            <p>${work.work_buget}</p>
            <span class="status">${work.work_status}</span>
            <p>${work.location}</p>
        </div>
        
        <div class="work_detail" data-id="${index++}">
          
    
            <p>posted by:${work.service_provider_fullname}</p>
            <span class="status">${work.work_status}</span>

            <p>${work.work_posted_at}</p>
            <p>${work.work_buget}</p>
            <p>${work.deadline}</p>
            <p>${work.contact}</p>
            <p>${work.contact}</p>
            <p>${work.work_desc}</p>
        </div>`


            });



            const work_details = document.querySelectorAll(".work_detail");
            work_details.forEach(work_detail => {
                work_detail.style.display = "none";
            })


            const workCards = document.querySelectorAll('.work_card');

            workCards.forEach((workCard, index) => {
                workCard.addEventListener('click', () => {

                    const workDetail = document.querySelector(`.work_detail[data-id="${index + 1}"]`);
                    const removeBtn = document.querySelector(`.remove[data-rmv = "${ index + 1 }"]`);

                    blur.addEventListener("click", () => {
                        workDetail.style.display = "none";
                        document.body.classList.remove("overflow");
                        blur.classList.remove("blur-overlay");

                    })
                    if (workDetail) {
                        workDetail.style.display = "block";
                        document.body.classList.add("overflow");
                        blur.classList.add("blur-overlay");

                    }
                });
            });
        }
        show_work_detail();
    </script>


</body>

</html>