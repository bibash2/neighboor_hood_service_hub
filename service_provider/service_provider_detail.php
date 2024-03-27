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
        .work_form,
        .review_form {
            display: none;
            opacity: 10;

            z-index: 10;
        }
    </style>
</head>

<body>
    <?php
    require "../includes/nav.php"
    ?>
    <div class="serivce_provider_detail">
        <!-- <div class="service_provder_card">
            <b>Service Provider Name</b>
            <p>Category</p>
            <p>Rating</p>
            <p>Primary Location</p>
            <button class="add_work">Add work</button>
            <button class="add_review">Add review</button>
        </div> -->
    </div>


    <!-- add work form -->
    <div class="work_form">
        <button class="remove">Remove</button>
        <label for="work_desc">Work Description</label><br>
        <textarea id="work_desc" rows="5" cols="50" placeholder="write the detail about the work ......">

         </textarea><br>
        <label for="deadline">Deadline of the work</label>
        <input type="date" id="deadline">

        <label for="budget">Budget</label>
        <input type="number" id="budget">

        <label for="location">Location</label>
        <input type="text" id="location">

        <label for="contact">Contact</label>
        <input type="text" id="contact">


        <button type="submit" class="work_submit">Done</button>

    </div>

    <!-- add review section -->
    <div class="review_form">
        <button class="remove_review">Remove</button>
        <label for="review_desc">Review</label><br>

        <textarea for="review_desc" id="review_desc" row="5" cols="30"></textarea><br>
        <label for="rating" require>Rating</label>
        <select name="rating" id="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit" class="review_submit">Done</button>
    </div>




    <!-- display all the review of the user -->
    <div class="display_review">
        <div class="review_card">
            <p>posted by:</p>
            <p>Posted at:</p>
            <p> review_desc</p>
        </div>
    </div>


    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const service_provider_id = urlParams.get('service_provider_id');


        fetch(`http://localhost/neighboor_hood_service_hub/models/single_service_provider_detail.php?service_provider_id=${service_provider_id}`, {
            method: "GET"
        }).then(response => response.json()).then(data => {
            document.querySelector(".serivce_provider_detail").innerHTML += `    <div class="service_provder_card">
            <b>${data.fullname}</b>
            <p>${data.category_name}</p>
            <p>${data.rating}</p>
            <p>${data.location}</p>
            <button class="add_work">Add work</button>
            <button class="add_review">Add review</button>
        </div>`
        }).then(() => {
            const add_work_btn = document.querySelector(".add_work");
            const add_review_btn = document.querySelector(".add_review");
            const remove_btn = document.querySelector(".remove");


            remove_btn.addEventListener("click", () => {
                document.querySelector(".work_form").style.display = "none";
            })

            document.querySelector(".remove_review").addEventListener("click", () => {
                document.querySelector(".review_form").style.display = "none";
            })

            add_review_btn.addEventListener("click", () => {

                document.querySelector(".review_form").style.display = "block";

            })

            add_work_btn.addEventListener("click", () => {

                document.querySelector(".work_form").style.display = "block";
            })


        }).then(() => {

            document.querySelector(".work_submit").addEventListener("click", async function() {
                let data = {
                    "work_budget": document.querySelector("#budget").value,
                    "work_desc": document.querySelector("#work_desc").value.trim(),
                    "user_id": <?php
                                echo $user_id
                                ?>,
                    "service_provider_id": service_provider_id,
                    "location": document.querySelector("#location").value,
                    "contact": document.querySelector("#contact").value,
                    "deadline": document.querySelector("#deadline").value
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
                const responseData = await response.json();
                console.log(responseData);
            })






            const display_review = document.querySelector(".display_review");
            fetch("http://localhost/neighboor_hood_service_hub/models/single_service_provider_detail.php", {
                method: "GET"
            }).then(response => {
                return response.json();
            }).then(reviews => {
                reviews.forEach(review => {
                    display_review.innerHTML += `
        <div class="review_card">
            <p>Posted by: ${review.fullname}</p>
            <p>${review_post_at}</p>
            <p>${review.review_text}</p>
            <p>${review.rating}</p>
        </div>
        `
                })
            }).catch(error => {
                console.log(error)
            });
        })
    </script>
</body>

</html>