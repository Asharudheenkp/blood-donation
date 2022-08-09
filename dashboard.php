<?php
session_start();
require("db.php");


// this page work only after login 

// if (!isset($_SESSION['id'])) {
//     header("Location:login.php");
// }


// data fetch from data base

$sql = "SELECT * FROM `users` ORDER BY id DESC";
$result = mysqli_query($db, $sql);

$profile=mysqli_fetch_assoc($result)


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>blood-donation</title>
</head>

<body>




    <nav>
        <div class="container">
            <h1> <a href="index.php"> blood donation</a></h1>

            <div class="handburger">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
            </div>

            <ul id="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>

            </ul>
        </div>
    </nav>

    <div class="fpara">
        <h1>WELCOME TO BLOOD DONATION: <?php echo  $_SESSION['name']  ?></h1>

        <div class="btns">
            <a href="profile.php?id=<?php echo  $profile['id'] ?>">Go to your profile</a>
        </div>


        <h2>Doners list</h2>


    </div>



    <div class="box">



        <table>
            <thead>
                <tr>
                    <!-- <th>id</th> -->
                    <th>name</th>
                    <th>address</th>
                    <th>phone number</th>
                    <th>Blood type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>

                <?Php foreach ($result as $result) {
                ?>
                    <tr>
                        <!-- <td><?php echo $result['id'] ?></td> -->
                        <td><?php echo $result['name'] ?></td>
                        <td><?php echo $result['address'] ?></td>
                        <td><?php echo $result['phone'] ?></td>
                        <td><?php echo $result['type'] ?></td>
                        <td><?php echo $result['date'] ?></td>



                    </tr>

                <?php


                } ?>

            </tbody>
        </table>

    </div>




    <footer>
        <p>all copyrights to blood-donation website</p>
    </footer>

    <script>
        const bars = document.querySelector(".handburger");
        const menu = document.querySelector(".container");
        const list = document.querySelector("#nav");

        bars.addEventListener("click", () => {
            menu.classList.toggle("change");
            list.classList.toggle("active");

            if (menu.classList.value == "container change") {
                document.documentElement.style.overflow = "hidden";
            } else {
                document.documentElement.style.overflow = "auto";
            }
            

        })
    </script>
</body>

</html>