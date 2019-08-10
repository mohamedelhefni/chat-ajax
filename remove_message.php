<?php

include('./includes/connection.php');
include('./includes/functions.php');
session_start();

$msg_id = $_POST['message_id'];

$query = "DELETE FROM `chat_message` WHERE `chat_message`.`chat_message_id` = $msg_id ";

$run_query = mysqli_query($con, $query);
