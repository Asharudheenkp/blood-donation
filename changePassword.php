<?php
session_start();
require("db.php");

// this page work only after login 

if (!isset($_SESSION['id'])) {
    header("Location:login.php");
}


// data fetch from data base

$phone = $_SESSION['phone'];
$sql = "SELECT * FROM `users` WHERE phone='$phone'";
$result = mysqli_query($db, $sql);
$passwordchange = mysqli_fetch_assoc($result);



//password change

$errors = [];

if (isset($_POST['submit'])) {
    // password  validation




    $password = $_POST['password'];

    if (empty($password)) {
        $errors['password'] = "please enter your new password";
    } else {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/";

        if (!preg_match($pattern, $password)) {
            $errors['password'] = "please inculed 1-uppercase, 1-lowercase, 1-symbol, 1-number, atleast 8 characters";
        }
    }

    // confirm password  validation



    $cpassword = htmlspecialchars($_POST['cpassword']);

    if ($cpassword === '') {
        $errors['cpassword'] = "please confirm the password";
    } else {
        if (!($cpassword === $password)) {
            $errors['cpassword'] = "please enter same password";
        }
    }


    if (empty($errors)) {



        $id = $passwordchange['id'];

        $changepass = "UPDATE users SET password='" . md5($password) . "' WHERE id=$id";

        $cnt = mysqli_query($db, $changepass);

        header("Location:profile.php");
    }
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Change password.css">
    <title>Document</title>
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
            <a href="profile.php?id=<?php echo $passwordchange['id'] ?>">Go to your profile</a>
        </div>

    </div>



    <div class="logcontainer">


        <div class="title">
            <h1>change password</h1>
        </div>
        <form action="" method="POST">
            <div class="input">
                <input type="password" placeholder="Enter new password " name="password" value="<?php echo $input['username'] ?? '' ?>">
            </div>
            <div class="msg"><?php echo $errors['password'] ?? '' ?></div>



            <div class="input">
                <input type="password" placeholder="confirm password" autocomplete="off" name="cpassword">
            </div>
            <div class="msg"><?php echo $errors['cpassword'] ?? '' ?></div>



            <div class="btn">
                <input type="submit" value="submit" name="submit">

            </div>
            <div class="btn">

                <a href="profile.php">Change later</a>
            </div>



        </form>






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

        });

    </script>

</body>

</html>