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
    <link rel="stylesheet" href="./your_work.css">
    <title>Document</title>

</head>

<body>
    <div class="blur" data-blur></div>

    <?php
    require "../includes/nav.php"
    ?>
    <div class="serivce_provider_detail">
        <!-- <div class="service_provder">
            <b>Service Provider Name</b>
            <p>Category</p>
            <p>Rating</p>
            <p>Primary Location</p>
            <button class="add_work">Add work</button>
            <button class="add_review">Add review</button>
        </div> -->
    </div>


    <!-- add work form -->
    <div class="work_form hidden">
        <label for="work_desc">Work Description</label>
        <textarea id="work_desc" rows="5" cols="50" placeholder="write the detail about the work ......" require>

         </textarea><br>
        <label for="deadline">Deadline of the work</label>
        <input type="date" id="deadline" require><br>

        <label for="budget">Budget</label>
        <input type="number" id="budget" require><br>

        <label for="location">Location</label>
        <input type="text" id="location" require><br>

        <label for="contact">Contact</label>
        <input type="text" id="contact" require><br>


        <button type="submit" class="work_submit" data-blur>Done</button>

    </div>

    <!-- add review section -->
    <div class="review_form hidden">
        <label for="review_desc">Review</label>

        <textarea for="review_desc" id="review_desc" row="5" cols="30"></textarea><br>
        <label for="rating" require>Rating</label>
        <select name="rating" id="rating" require>
            <option value="1">⭐</option>
            <option value="2">⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
        </select><br>
        <button type="submit" class="review_submit blur" data-blur>Done</button>
    </div>




    <!-- display all the review of the user -->
    <div class="display_review">
        <!-- <div class="review_card">
            <p>posted by:</p>
            <p>Posted at:</p>
            <p> review_desc</p>
        </div> -->
    </div>


    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const service_provider_id = urlParams.get('service_provider_id');
        const rating = urlParams.get("rating");


        async function service_provider_detail() {
            const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/single_service_provider_detail.php?service_provider_id=${service_provider_id}`, {
                method: "GET"
            });
            const data = await response.json();
            if (data.user_id == <?php echo $user_id ?>) {
                document.querySelector(".serivce_provider_detail").innerHTML += `
        <div class="service_provider">
            <b>${data.fullname}</b>
            <p>${data.category_name}</p>
            <p>${rating}⭐</p>
            <p>${data.location}</p>
            <p>${data.contact}</p>
        </div>`
            } else {
                document.querySelector(".serivce_provider_detail").innerHTML += `
        <div class="service_provider">
            <b>${data.fullname}</b>
            <p>${data.category_name}</p>
            <p>${rating}⭐</p>
            <p>${data.location}</p>
            <p>${data.contact}</p>
           
        </div>
        <div class="add">
            <button class="add_work">Add work</button>
            <button class="add_review">Add review</button>
        </div>`
            }
        }

        (async () => {
            await service_provider_detail();
        })().then(() => {

            const blurOverlay = document.querySelector(".blur")
            const blurs = document.querySelectorAll("[data-blur]");
            const add_work_btn = document.querySelector(".add_work");
            const add_review_btn = document.querySelector(".add_review");
            const workForm = document.querySelector(".work_form");
            const reviewForm = document.querySelector(".review_form")





            add_work_btn.addEventListener("click", () => {
                document.body.classList.add("overflow");
                blurOverlay.classList.add("blur-overlay");
                workForm.classList.remove("hidden");
                workForm.classList.add("popup_form")
            })

            add_review_btn.addEventListener("click", () => {
                document.body.classList.add("overflow");
                blurOverlay.classList.add("blur-overlay");
                reviewForm.classList.add("popup_form")
                reviewForm.classList.remove("hidden")
            })

            blurs.forEach(blur => {
                blur.addEventListener("click", () => {
                    document.body.classList.remove("overflow");
                    blurOverlay.classList.remove("blur-overlay");
                    workForm.classList.remove("popup_form")
                    reviewForm.classList.remove("popup_form");
                    workForm.classList.add("hidden")
                    reviewForm.classList.add("hidden")
                })
            })

        })


        document.querySelector(".work_submit").addEventListener("click", async function() {
            let data = {
                "work_budget": document.querySelector("#budget").value.trim(),
                "work_desc": document.querySelector("#work_desc").value.trim(),
                "user_id": <?php
                            echo $user_id
                            ?>,
                "service_provider_id": service_provider_id,
                "location": document.querySelector("#location").value.trim(),
                "contact": document.querySelector("#contact").value.trim(),
                "deadline": document.querySelector("#deadline").value.trim()
            }
            const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/work.php`, {
                method: "POST",
                header: {
                    "content-type": "application/json",
                },
                body: JSON.stringify(data)
            });

            const responseData = await response.text();
            console.log(responseData)

        });



        document.querySelector(".review_submit").addEventListener("click", async function(event) {
            let data = {
                "review_desc": document.querySelector("#review_desc").value,
                "rating": document.querySelector("#rating").value,
                "service_provider_id": service_provider_id,
                "user_id": <?php echo $user_id; ?>
            }
            const response = await fetch("http://localhost/neighboor_hood_service_hub/models/review.php", {
                method: "POST",
                header: {
                    "content-type": "application/json"
                },
                body: JSON.stringify(data)
            });
            const responseData = await response.text();
            console.log(responseData);
        })



        fetch(`http://localhost/neighboor_hood_service_hub/models/review.php?service_provider_id=${service_provider_id}`, {
            method: "GET"
        }).then(response => {
            return response.json();
        }).then(reviews => {
            const display_review = document.querySelector(".display_review");
            reviews.forEach(review => {
                console.log(review)
                display_review.innerHTML += `
                <div class="review_card">
<div class="review_info">
            <p>${review.fullname}</p>
            <p>${review.rating}⭐</p>
            </div>
            <p class="review_text">${review.review_text}</p>
        </div>`;
            })
        })
    </script>
</body>

</html>