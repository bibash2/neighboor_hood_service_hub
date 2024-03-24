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
            background-color: black;
            z-index: 10;
        }
    </style>
</head>

<body>
    <?php
    require "../includes/nav.php"
    ?>
    <div class="all_serivce_provider">
        <div class="service_provder_card">
            <b>Service Provider Name</b>
            <p>Category</p>
            <p>Rating</p>
            <p>Primary Location</p>
            <button class="add_work">Add work</button>
            <button class="add_review">Add review</button>
        </div>
    </div>


    <!-- add work form -->
    <div class="work_form">
        <button class="remove">Remove</button>
        <label for="work_desc">Work Description</label><br>
        <textarea id="work_desc" rows="5" cols="50">
             Enter work description here...
         </textarea><br>
        <label for="deadline">Deadline of the work</label>
        <label for="budget">Budget</label>
        <input type="number" id="budget">
        <input type="date" id="deadline">
        <button type="submit" class="work_submit">Done</button>

    </div>

    <!-- add review section -->
    <div class="review_form">
        <label for="review_desc">Review</label><br>
        <button class="remove_review">Remove</button>
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
        document.addEventListener("DOMContentLoaded",()=>{
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

        document.querySelector(".work_submit").addEventListener("click", async function() {
            let data = {
                "work_budget": document.querySelector("#budget").value,
                "work_desc": document.querySelector("#work_desc").value,
                "user_id": 3,
                "service_provider_id": service_provider_id
            }
            const response = await fetch(`url`, {
                method: "POST",
                header: {
                    "content-type": "application/json",
                },
                body: JSON.stringify(data)
            });

            const responseData = await response.json();
            console.log(responseData)

        });

        document.querySelector(".review_submit").addEventListener("click", async function() {
            let data = {
                "review_desc": document.querySelector(".review_desc").value,
                "rating": document.querySelector(".rating").value,
                "service_provider_id": 3,
                "user_id": 5
            }
            const response = await fetch("url", {
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
        fetch("url", {
            method: "GET"
        }).then(response => {
            return response.json();
        }).then(reviews => {
            reviews.foreach(review => {
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