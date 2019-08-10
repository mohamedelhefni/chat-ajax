<?php
include('./includes/connection.php');

session_start();

if (!empty($_FILES)) {
    if (is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {
        $img_src = $_FILES['profile_pic']['tmp_name'];
        $img_path = 'upload/' . $_FILES['profile_pic']['name'];
        if (move_uploaded_file($img_src, $img_path)) {
            echo $img_path;
            $user_id = $_SESSION['id'];
            $query = "UPDATE users SET profile_pic = '$img_path' WHERE user_id = '$user_id' ";
            $run_query = mysqli_query($con, $query);
        }
    }
}
