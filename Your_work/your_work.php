<?php

session_start();
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
    <title>Document</title>
    <style>
        .work_detail {
            display: hidden;
        }

        .work_card {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    require "../includes/nav.php"
    ?>
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



        async function show_work_detail() {
            const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/work.php`, {
                method: "GET"
            });
            const works = await response.json();
            var index = 1
            await works.forEach(work => {

                all_work.innerHTML +=
                    `<div class="work_card" >
            <p>Posted By:${work.fullname}</p>
            <p>${work.work_desc}</p>
            <p>${work.work_buget}</p>
            <p>${work.location}</p>
        </div>
        
        <div class="work_detail" data-id="${index++}">
            <button class="remove">remove</button>
            <p>posted by:${work.fullname}</p>
            <p>${work.work_posted_at}</p>
            <p>${work.work_buget}</p>
            <p>${work.deadline}</p>
            <p>${work.contact}</p>
            <p>${work.contact}</p>
            <p>${work.work_desc}</p>
            <div>
                <button class="accet">Accept</button>
                <button class="reject">Reject</button>
            </div>
        </div>`
            });


            const work_details = document.querySelectorAll(".work_detail")
            work_details.forEach(work_detail => {
                work_detail.style.display="none";
            })

            const workCards = document.querySelectorAll('.work_card');

            workCards.forEach((workCard, index) => {
                workCard.addEventListener('click', () => {

                    const workDetail = document.querySelector(`.work_detail[data-id="${index + 1}"]`);
                    console.log(workDetail)
                   const removeBtn = document.querySelector(".remove");
                   removeBtn.addEventListener("click", ()=>{
                    workDetail.style.display = "none";
                   })
                    if (workDetail) {
                        workDetail.style.display="block"
                    }
                });
            });
        }


        show_work_detail()
        // fetch("http://localhost/neighboor_hood_service_hub/models/work.php", {
        //     method: "GET"
        // }).then((response) => {
        //     return response.json()
        // }).then(works => {
        //     works.forEach(work => {
        //         console.log(work)
        //         all_work.innerHTML +=
        //             `<div class="work_card">
        //     <p>Posted By:${work.fullname}</p>
        //     <p>${work.work_desc}</p>
        //     <p>${work.work_budget}</p>
        //     <p>${work.location}</p>
        // </div>`;


        //     })
        // }).then(() => {

        //     const work_card = document.querySelector(".work_card");

        //     work_card.addEventListener("click", () => {
        //         document.querySelector(".work_detail").style.display = "block"

        //     });

        //     document.querySelector(".remove").addEventListener("click", () => {
        //         document.querySelector(".work_detail").style.display = "none"

        //     });

        // })
    </script>
</body>

</html>