<?php

$con = mysqli_connect('localhost', 'root', '', 'chat') or die('Connection  error');

if (mysqli_connect_errno()) {
    echo 'Failed to connnect to mysql ' . mysqli_connect_errno();
}

mysqli_set_charset($con, "utf8mb4");
