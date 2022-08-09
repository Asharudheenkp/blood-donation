<?php
session_start();
require("db.php");

// this page work only after login 

if (!isset($_SESSION['phone'])) {
    header("Location:login.php");
}


// selecting the table row for editing

$id = $_GET['id'];

$fetch = "SELECT* FROM `users` WHERE id='$id'";

$result = mysqli_query($db, $fetch);

$show = mysqli_fetch_assoc($result);



// form validation

$errors = [];

if (isset($_POST['submit'])) {



    // name validation

    $name = htmlspecialchars($_POST['name']);
    $input['name'] = $name;
    if ($name === '') {
        $errors['name'] = "please enter your name";
    } else {
        if (!preg_match("/^[a-z A-Z]*$/", $name)) {
            $errors['name'] = "Only alphabets and whitespace are allowed";
        }
    }


    // address validation


    $address = htmlspecialchars($_POST['address']);
    $input['address'] = $address;

    if ($address === '') {
        $errors['address'] = "please enter your address";
    }


    // blood type validation

    $blood = htmlspecialchars($_POST['blood']);
    $input['blood'] = $blood;

    if ($blood === "") {
        $errors['blood'] = "please select a blood group";
    }



    // phone number validation

    $phone = htmlspecialchars($_POST['phone']);
    $input['phone'] = $phone;  //why use this

    if ($phone === '') {
        $errors['phone'] = "please enter your phone number";
    } else {
        if (!preg_match('/^[0-9]{10}+$/', $phone)) {

            $errors['phone'] = " Invalid Phone Number";
        }
        $query_Phone = "SELECT * FROM `users` WHERE phone='$phone'";
        $query_Phone_Result= mysqli_query($db,$query_Phone);
        $query_Phone_row=mysqli_num_rows($query_Phone_Result);

       

        if($show['phone']!= $phone){
            if($query_Phone_row>=1){
                $errors['phone']="This phone number alredy registered";
            }
        }
    }




    // date  validation

    $date = $_POST['date'];
    $input['date'] = $input;

    if ($date === '') {
        $errors['date'] = "plase enter date";
    }


    // updateing datas

    if (empty($errors)) {

        $sql = "UPDATE users SET name='$name',address='$address',type='$blood',phone='$phone',date='$date' WHERE id=$id";

        $cnt = mysqli_query($db, $sql);

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
    <link rel="stylesheet" href="edit.css">
    <title>blood-donation</title>
</head>

<body>


    <nav>
        <div class="container">
            <h1> <a href="index.php"> blood donation</a></h1>
            <div class="menu" id="menu"><i class="fa-solid fa-bars"></i></div>
            <div class="menux" id="menux"><i class="fa-solid fa-xmark"></i></div>

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
            <a href="dashboard.php">Go to your dashboard</a>
        </div>



    </div>



    <div class="container2">
        <div class="box">
            <h1>edit your profile</h1>
            <form action="" method="POST">


        
            
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $show['name'] ?? '' ?>">
                <p style="color:white;"><?php echo $errors['name'] ?? ''; ?></p>



                <label>Address</label>
                <input type="text" name="address" value="<?php echo $show['address'] ?? '' ?>">
                <p style="color:white;"><?php echo $errors['address'] ?? '' ?></p>


                <label>blood type</label>
                <select name="blood" id="">
                    <option value="<?php echo $show['type'] ?? '' ?>"><?php echo $show['type'] ?? '' ?></option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="AB+">AB+</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <p style="color:white;"><?php echo $errors['blood'] ?? '' ?></p>



                <label>phone number</label>
                <input type="text" name="phone" value="<?php echo $show['phone'] ?? '' ?>">
                <p style="color:white;"><?php echo $errors['phone'] ?? '' ?></p>






                <label>Date</label>
                <input type="date" name="date" value="<?php echo $show['date'] ?? '' ?>">
                <p style="color:white;"><?php echo $errors['date'] ?? '' ?></p>



                <input type="submit" name="submit" value="submit">
            </form>
        </div>
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