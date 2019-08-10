<?php

include('./includes/connection.php');
include('./includes/functions.php');
session_start();
$userid = $_SESSION['id'];
$username = htmlentities(mysqli_escape_string($con, $_POST['username']));
$useremail = htmlentities(mysqli_escape_string($con, $_POST['useremail']));
$mail = $_SESSION['user_email'];
$oldpass = htmlentities(mysqli_escape_string($con, $_POST['oldpass']));
$newpass = htmlentities(mysqli_escape_string($con, $_POST['newpass']));
$pass  = (strlen($newpass) > 0 ? sha1($newpass)  : $oldpass);

$errors = array();

if (empty($username)) {
    $errors[] = '<p> Please enter user name </p>';
}
if (empty($pass)) {
    $errors[] = '<p> Please enter Password </p>';
} elseif (strlen($pass) != 0 && strlen($pass) < 8) {
    $errors[] = '<p> password should be larger than 8 charcharters </p>';
}
if (empty($useremail)) {
    $errors[] = '<p> Please enter email </p>';
}
$check_email = "select * from users where user_email='$useremail'";
$run_email = mysqli_query($con, $check_email);
$check = mysqli_num_rows($run_email);
if ($useremail == $mail) { } else { }
if ($check == 1) {
    if ($useremail == $mail) { } else {
        $errors[] = "Email Already Exists";
        $err = 3;
    }
}


if (empty($errors)) {
    $update = "UPDATE  users SET username = '$username', user_email = '$useremail' , user_pass = '$pass' Where  `users`.`user_id` = '$userid' ";
    $query = mysqli_query($con, $update);

    if ($query) {
        echo 1;
    }
} else {

    echo $err;
}
