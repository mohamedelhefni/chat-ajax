<?php

include('./includes/connection.php');
include('./includes/functions.php');

session_start();

$query = " UPDATE login_details SET is_type = '" . $_POST['is_type'] . "'  WHERE login_details_id = '" . $_SESSION['login_details_id'] . "'";
$run_query = mysqli_query($con, $query);
