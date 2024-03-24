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
        <div class="work_card">
            <p>Posted By:</p>
            <p>work_description</p>
            <p>posted at</p>
            <p>Location</p>
        </div>
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
    </div>

    <script>
        const all_work = document.querySelector(".show_all_work");
        const work_card = document.querySelector(".work_card");

        work_card.addEventListener("click", () => {
            document.querySelector(".work_detail").style.display = "block"
            console.log("dispaly block")
        });

        document.querySelector(".remove").addEventListener("click", () => {
            document.querySelector(".work_detail").style.display = "none"
            console.log("display none")
        });

        // fetch("url", {
        //     method: "GET"
        // }).then((response) => response.json()).
        // then((works) => {
        //     works.foreach(data => {
        //         all_work.innerHTML += `
        // <div class="work_card">
        //     <p>Posted By:${work.fullname}</p>
        //     <p>Deadline:${work.deadline}</p>
        //     <p>${work.desc}</p>
        //     <p>posted:</p>
        //     <p>${work.location}</p>
        // </div>`;
        //     })
        // }).catch(error => console.error(error));

        // work_card.addEventListener("click", () => {


        // }).catch(error=>{
        //     console.log(error);
        // });
    </script>
</body>

</html>