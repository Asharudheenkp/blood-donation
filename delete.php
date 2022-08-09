<?php
session_start();
require("db.php");

// this will delete user data from profile

$id= $_SESSION['id'];


$sql="DELETE FROM users WHERE `users`.`id` = $id";

mysqli_query($db,$sql);


session_destroy();

header("Location:index.php");







?>