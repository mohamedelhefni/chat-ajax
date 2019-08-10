<?php

include('./includes/connection.php');
include('./includes/functions.php');
session_start();

$to_user_id = $_POST['to_user_id'];
$chat_message = $_POST['chat_message'];
$from_user_id = $_SESSION['id'];
$status = '1';


// $data = array(
//     ':to_user_id' => $_POST['to_user_id'],
//     ':chat_message' => $_POST['chat_message'],
//     ':from_user_id' =>  $_SESSION['id'],
//     ':status' =>'1',
// );

// echo "<pre>";
//     print_r($data);
// echo "</pre>";

$query = "INSERT INTO chat_message (to_user_id, from_user_id, chat_message, status) VALUES ('$to_user_id', '$from_user_id', '$chat_message', '$status')";
$run_query = mysqli_query($con, $query);

if ($run_query) {
    echo fetch_user_chat_history($from_user_id, $to_user_id, $con);
}

$update_msg = "
    UPDATE chat_message SET status = '0' WHERE to_user_id = $from_user_id AND from_user_id = $to_user_id AND status = '1'
";
$update = mysqli_query($con, $update_msg);
