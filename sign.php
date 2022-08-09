<?php
require("db.php");
$errors = [];
$input = [];


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

    $blood = htmlspecialchars( $_POST['blood']);
    $input['blood'] = $blood;

    if ($blood === "") {
        $errors['blood'] = "please select a blood group";
    }



    // phone number validation

    $phone = htmlspecialchars($_POST['phone']) ;
    $input['phone'] = $phone;

    if ($phone === '') {
        $errors['phone'] = "please enter your phone number";
    } else {
        if (!preg_match('/^[0-9]{10}+$/', $phone)) {

            $errors['phone'] = " Invalid Phone Number";
        }

        $query_Phone = "SELECT * FROM `users` WHERE phone='$phone'";
        $query_Phone_Result= mysqli_query($db,$query_Phone);
        $query_Phone_row=mysqli_num_rows($query_Phone_Result);

        if($query_Phone_row>=1){
            $errors['phone']="This phone number alredy registered";
        }

    }



    // password  validation

    $password = htmlspecialchars($_POST['password']);
    $input['password'] = $password;


    if ($password === "") {
        $errors['password'] = "please enter a password";
    }else{
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/";

        if(!preg_match($pattern,$password)){
            $errors['password']="please inculed 1-uppercase, 1-lowercase, 1-symbol, 1-number, atleast 8 characters";
        }

    }





    // confirm password  validation

    $cpassword =htmlspecialchars( $_POST['cpassword']);
    $input['cpassword'] = $cpassword;

    if ($cpassword === '') {
        $errors['cpassword'] = "please confirm the password";
    }else{
        if(!($cpassword===$password)){
            $errors['cpassword'] = "please enter same password";
        }
    }



    // date  validation

    $date = $_POST['date'];
    $input['date'] = $input;

    if ($date === '') {
        $errors['date'] = "plase enter date";
    }


    // uploading datas to database

    if (empty($errors)) {

        $sql = "INSERT INTO users" . "(name,address,type,phone,password,date)" . "VALUES" . "('$name','$address','$blood','$phone','" . md5($password) . "','$date')";

        // $sql="INSERT INTO users('name','address','type','phone','password','date')VALUES($name,$address,$blood,$phone,$password,$date)";

        $cnt = mysqli_query($db, $sql);

        header("Location:login.php");
    }


    
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>blood-donation</title>
</head>

<body>
    <?php require("navbar.php") ?>





    <div class="container2">
        <div class="box">
            <h1>sign-up</h1>
            <form action="" method="POST">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $input['name'] ?? '' ?>">
                <p style="color:white;"><?php echo $errors['name'] ?? '' ?></p>



                <label>Address</label>
                <input type="text" name="address" value="<?php echo $input['address'] ?? '' ?>">
                <p style="color:white;"><?php echo $errors['address'] ?? '' ?></p>


                <label>blood type</label >
                <select name="blood" id="" ?>">
                    <option value=""></option>
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
                <input type="text" name="phone"  value="<?php echo $input['phone'] ?? '' ?>">
                <p style="color:white;"><?php echo $errors['phone'] ?? '' ?></p>



                <label>password</label >
                <input type="password" name="password" autocomplete="off">
                <p style="color:white;"><?php echo $errors['password'] ?? '' ?></p>



                <label>confrim password</label>
                <input type="password"  autocomplete="off" name="cpassword">
                <p style="color:white;"><?php echo $errors['cpassword'] ?? '' ?></p>



                <label>Date</label >
                <input type="date" name="date">
                <p style="color:white;"><?php echo $errors['date'] ?? '' ?></p>



                <input type="submit" name="submit" value="sign-up now">
            </form>
            <a href="login.php">i already have an account/login</a>
        </div>
    </div>


</body>

</html>