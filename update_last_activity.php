<?php
include('./includes/connection.php');
session_start();

$query = "UPDATE login_details SET last_activity = now() WHERE login_details_id = '" . $_SESSION['login_details_id'] . "' ";

$run_query = mysqli_query($con, $query);
