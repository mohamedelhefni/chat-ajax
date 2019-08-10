<?php

include('./includes/connection.php');
session_start();


$from_user_id = $_SESSION['id'];
$to_user_id = $_POST['to_user_id'];


$update_msg = "
    UPDATE chat_message SET status = '0' WHERE to_user_id = $from_user_id AND from_user_id = $to_user_id AND status = '1'
";
$update = mysqli_query($con, $update_msg);
