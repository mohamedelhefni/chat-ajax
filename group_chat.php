<?php

include('./includes/connection.php');
include('./includes/functions.php');
session_start();

if ($_POST['action'] == 'insert_data') {

    $from_user_id = $_SESSION['id'];
    $chat_message = $_POST['chat_message'];
    $status = 1;

    $query = "
        INSERT INTO chat_message (to_user_id, from_user_id , chat_message, status) VALUES ('0','$from_user_id', '$chat_message', '0')
    ";
    $run_query = mysqli_query($con, $query);
    if ($run_query) {
        echo fetch_group_history($con);
    }
}

if ($_POST['action'] == 'fetch_data') {
    echo fetch_group_history($con);
}
