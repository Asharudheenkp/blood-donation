<?Php
session_start();
require('db.php');

$error = [];
$input = [];

if (isset($_POST['submit'])) {



    // phone number validation

    $phone = htmlspecialchars($_POST['phone']);
    $input['phone'] = $phone;

    if (empty($phone)) {

        $error['phone'] = " enter a phone number";
    } else {

        if (!preg_match('/^[0-9]{10}+$/', $phone)) {

            $error['phone'] = " Invalid Phone Number";
        }


        // checking phone number is exist in database

        $sql2 = "SELECT * FROM `users` WHERE phone ='$phone'";
        $result2 = mysqli_query($db, $sql2);
        if (mysqli_num_rows($result2) <= 0) {
            $error['phone'] = "Phone Number not registered";
        }
    }




    // password  validation

    $password = htmlspecialchars($_POST['password']);
    $input['$password'] = $password;


    if (empty($password)) {

        $error['password'] = " enter a password";
    } else {


        // checking  password and phone number is matching or not

        $sql = "SELECT * FROM `users` WHERE  phone='$phone' AND password='" . md5($password) . "'";


        $result = mysqli_query($db, $sql);
        $row = mysqli_num_rows($result);


        if ($row == 1) {

            $row1 = mysqli_fetch_assoc($result);
            $username =  $row1['name'];
            $id=$row1['id'];
            $row = mysqli_num_rows($result);
            $_SESSION['name'] = $username;
            $_SESSION['phone']=$phone;
            $_SESSION['id']=$id;
            


            header("Location:dashboard.php");
        } else {
            $error['password'] = "enter a valid password";
        }


    }
}





?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>blood-donation</title>
</head>

<body>
    <?php require("navbar.php") ?>

    <div class="container2">
        <div class="box">
            <h1>login</h1>
            <form action="" method="POST">
                <label>phone number</label>
                <input type="text" name="phone" value="<?php echo $input['phone'] ?? '' ?>">
                <p style="color:white; padding-bottom:.5em;"><?php echo $error['phone'] ?? '' ?></p>

                <label>password</label>
                <input type="password" name="password"  autocomplete="off">
                <p style="color:white; padding-bottom:.5em;"><?php echo $error['password'] ?? '' ?></p>


                <input type="submit" name="submit" value="login now">
            </form>
            <a href="sign.php">i don't have an account/sign-up</a>
        </div>
    </div>



</body>

</html>