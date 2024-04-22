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
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
    <style>

    </style>
</head>

<body>
    <?php
    require "../includes/nav.php"
    ?>
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
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const service_provider_id = urlParams.get('service_provider_id');


        const all_work = document.querySelector(".show_all_work");
        const blur = document.querySelector(".blur")

        const day_left = (date) => {
            const current_date = new Date();
            const date_of_complition = new Date(date);
            const difference_in_days = Math.ceil((date_of_complition - current_date) / (1000 * 24 * 60 * 60));
            if (difference_in_days < 0) {
                return `expired`;
            }
            return `${difference_in_days} day left`;

        }


        async function show_work_detail() {
            const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/work.php?service_provider_id=${service_provider_id }`, {
                method: "GET"
            });
            const works = await response.json();
            if (works.length == 0) {
                all_work.innerHTML = `No work for you`;
            }
            var index = 1;
            var work_id = 0;
            await works.forEach(work => {

                if (work.work_status === "pending") {
                    if (day_left(work.deadline) === "expired") {
                        return;
                    }

                    all_work.innerHTML +=
                        `<div class="work_card" >
            <p>Posted By:${work.fullname}</p>
            <b>	रु ${work.work_buget}</b>
            <p class="status">${work.work_status}</p>
            <p>⚲ ${work.location}</p>
            <time?>${day_left(work.deadline)}</time>

        </div>
        
        <div class="work_detail" data-id="${index++}">
            <p class="user">posted by:${work.fullname}</p>
            <div class="work_info">
                <time class="deadline">Deadline: ${work.deadline}</time>
                <span class="status">${work.work_status}</span>
                <span class="location">Location: ${work.location}</span>
                <span class="budget">	रु ${work.work_buget}</span>
                <span class="contact">Contact: ${work.contact}</span>
            </div>
           
            <p>${work.work_desc}</p>
          
            <div class="pending" data-status=${index}>
                <button class="accept" data-accept=${--index} data-work-id=${work.work_id}>Accept</button>
                <button class="reject" data-reject=${index++} data-work-id=${work.work_id}>Reject</button>
            </div>
        </div>`
                } else {
                    all_work.innerHTML +=
                        `<div class="work_card" >
            <p class=>Posted By:${work.fullname}</p>
            <b>रु ${work.work_buget}</b>
            <p class="status">${work.work_status}</p>
            <p>⚲ ${work.location}</p>
        </div>
        
        <div class="work_detail" data-id="${index++}">
    
            <p class="user">posted by: ${work.fullname}</p>
            <div class="work_info">
                <time class="deadline">Deadline: ${work.deadline}</time>
                <span class="status">${work.work_status}</span>
                <span class="location">Location: ${work.location}</span>
                <span class="budget">	रु ${work.work_buget}</span>
                <span class="contact">Contact: ${work.contact}</span>
            </div>
            <p>Work Detail</p>
            <i>${work.work_desc}</i>
           
           
        </div>`
                }

            });

            const status = document.querySelectorAll(".status");


            const work_details = document.querySelectorAll(".work_detail");
            status.forEach(stat => {
                if (stat.innerHTML === "accepted") {
                    stat.classList.add("accepted");
                    stat.parentElement.style.borderColor = "rgb(8, 242, 8)";
                }
                if (stat.innerHTML === "rejected") {
                    stat.classList.add("rejected");
                    stat.parentElement.style.borderColor = "rgb(247, 4, 4)";
                }
                if (stat.innerHTML === "pending") {
                    stat.classList.add("pending");
                    stat.parentElement.style.borderColor="rgb(39, 96, 182)"
                }
            })




            const dayLefts = document.querySelectorAll("time");
            dayLefts.forEach(dayLeft => {
                if (dayLeft.innerHTML === "expired") {

                }
            })



            work_details.forEach(work_detail => {
                work_detail.style.display = "none";
            })


            const workCards = document.querySelectorAll('.work_card');

            workCards.forEach((workCard, index) => {
                workCard.addEventListener('click', () => {

                    const workDetail = document.querySelector(`.work_detail[data-id="${index + 1}"]`);

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

                    const acceptBtn = document.querySelector(`.accept[data-accept="${index +1 }"]`);
                    const rejectBtn = document.querySelector(`.reject[data-reject="${index + 1}"]`);
                    const workStatus = document.querySelector(".status");

                    if (acceptBtn != null && rejectBtn != null) {

                        acceptBtn.addEventListener("click", async () => {

                            let work_id = acceptBtn.getAttribute("data-work-id");

                            let data = {
                                "status": "accepted",
                                "work_id": work_id
                            }
                            const acceptResponse = await fetch(`http://localhost/neighboor_hood_service_hub/models/work.php`, {
                                method: "PUT",
                                headers: {
                                    "content-type": "application/json"
                                },
                                body: JSON.stringify(data)
                            });
                            const accept = acceptResponse.json();
                            if (response) {
                                document.querySelector(`.pending[data-status="${index+1}"]`).style.display = "none"
                                workStatus.innerHTML = "Accepted"
                            }
                        })


                        rejectBtn.addEventListener("click", async () => {
                            let work_id = rejectBtn.getAttribute("data-work-id");
                            let date = {
                                "status": "rejected",
                                "work_id": work_id
                            }
                            const rejectResponse = await fetch(`http://localhost/neighboor_hood_service_hub/models/work.php`, {
                                method: "PUT",
                                header: {
                                    "content-type": "application/json"
                                },
                                body: JSON.stringify(date)
                            });
                            const reject = rejectResponse.json();
                            if (reject) {
                                document.querySelector(`.pending[data-status="${index+1}"]`).style.display = "none"
                                workStatus.innerHTML = "Rejected"
                            }
                        });
                    } else {
                        return;
                    }
                });
            });
        }
        show_work_detail();
    </script>


</body>

</html>