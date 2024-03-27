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
        const work_detail = document.querySelector(".work_detail");


        async function show_work_detail() {
            const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/work.php`, {
                method: "GET"
            });
            const works = await response.json();
            console.log(works)
            works.forEach(work => {
                all_work.innerHTML +=
                    `<div class="work_card">
            <p>Posted By:${work.fullname}</p>
            <p>${work.work_desc}</p>
            <p>${work.work_buget}</p>
            <p>${work.location}</p>
        </div>
        
        <div class="work_detail">
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

            const work_card = document.querySelector(".work_card");
            // work_card.addEventListener("click", () => {
            //     document.querySelector(".work_detail").style.display = "block"
            // });

            // document.querySelector(".remove").addEventListener("click", (event) => {
            //     event.stopPropagation();
            //     document.querySelector(".work_detail").style.display = "none"
            // });

            work_card.addEventListener("click", function(event) {
                const target = event.target;

                // Check if the clicked element is a work card
                if (target.closest('.work_card')) {
                    const workDetail = target.closest('.work_container').querySelector('.work_detail');

                    // Toggle display of work detail
                    if (workDetail.style.display === "block") {
                        workDetail.style.display = "none";
                    } else {
                        // Hide all other work details
                        const allDetails = document.querySelectorAll('.work_detail');
                        allDetails.forEach(detail => {
                            if (detail !== workDetail) {
                                detail.style.display = "none";
                            }
                        });
                        workDetail.style.display = "block";
                    }
                }

                // Check if the clicked element is a remove button
                if (target.classList.contains('remove')) {
                    const workDetail = target.closest('.work_detail');
                    workDetail.style.display = "none";
                }
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