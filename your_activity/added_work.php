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
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=100&id=77118&format=png&color=000000">

    <title>Neighboor Service Hub</title>

    <style>
        .work_detail {
            border-radius: 9px;
            position: fixed;
            top: 15%;
            left: 25%;
            right: 20%;
            bottom: 20%;
            width: 50%;
            z-index: 4;
            background-color: rgba(34, 34, 34, 0.9);
            color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2em;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
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
            backdrop-filter: blur(4px);
            z-index: 1;
        }

        .work_card {
            border: 1px solid rgba(50, 50, 50, 0.8);
            border-radius: 1rem;
            height: auto;
            margin-top: 1rem;
            margin-bottom: 1rem;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            padding: 1rem;
            text-align: center;
            align-items: center;
            background-color: #354545;
            color: #f5f5f5;
            transition: background 0.3s, color 0.3s;
        }

        .work_card:hover {
            cursor: pointer;
            background: #08e3f7;
            color: #fff;
        }

        .accepted {
            border-color: rgb(8, 242, 8);
            color: rgb(8, 242, 8);
        }

        .rejected {
            border-color: rgb(247, 4, 4);
            color: rgb(247, 4, 4);
        }

        .expired {
            border-color: rgb(168, 159, 159);
            color: rgb(168, 159, 159);
        }

        .pending {
            border-color: rgb(39, 96, 182);
            color: rgb(39, 96, 182);
        }

        .show_all_work {
            margin-top: 1rem;
            margin-left: 20%;
            margin-right: 20%;
        }

        .work_info {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            padding: 1rem;
            border-top: 1px solid #555;
            margin-top: 1rem;
            color: #ddd;
        }

        body {
            background-color: whitesmoke;
            color: #f5f5f5;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .user {
            color: #80b3d1;
        }

        .work_info .deadline {
            color: #d186a5;
        }

        .work_info .location {
            color: #91c78f;
        }

        .work_info .budget {
            color: #08e3f7;
        }

        .work_info .contact {
            color: #a5d8a6;
        }

        .work_detail i {
            color: rgb(210, 210, 197);
            margin-top: 10px;
            font-size: 1.2rem;
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
                all_work.innerHTML = `You did not post any work`;
            }

            var index = 1;
            await added_works.forEach(work => {
                console.log(work);


                all_work.innerHTML +=
                    `<div class="work_card" >
           <p>To:${work.service_provider_fullname}</p>
            <b>रु ${work.work_buget}</b>
            <p class="status">${work.work_status}</p>
            <p>⚲ ${work.location}</p>
        </div>
        
        <div class="work_detail" data-id="${index++}">
    
           <p>To:${work.service_provider_fullname}</p>
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
                //                 `<div class="work_card" >
                //         <p>To:${work.service_provider_fullname}</p>
                //         <p>Rs: ${work.work_buget}</p>
                //         <p class="status">${work.work_status}</p>
                //         <p>${work.location}</p>
                //     </div>

                //     <div class="work_detail" data-id="${index++}">

                // <div class="detail_info"> <p>posted by:${work.service_provider_fullname}</p>
                //         <b class="status">${work.work_status}</b>
                //         <p>Budget: ${work.work_buget}</p>
                //         <p>Deadline: ${work.deadline}</p>
                //         <p>Contact: ${work.contact}</p>
                //         <p>Location: ${work.location}</p></div>

                //         <div class="work_desc">
                //         <h5>Work Description: </h5>
                //         <p>${work.work_desc}</p>
                //         </div>

                //     </div>`


            });



            const work_details = document.querySelectorAll(".work_detail");
            work_details.forEach(work_detail => {
                work_detail.style.display = "none";
            })

            const status = document.querySelectorAll(".status");

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
                    stat.parentElement.style.borderColor = "rgb(39, 96, 182)"
                }
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