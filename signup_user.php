<?php

include('includes/connection.php');

if (isset($_POST['sign_up'])) {

    $name = htmlentities(mysqli_escape_string($con, $_POST['username']));
    $email = htmlentities(mysqli_escape_string($con, $_POST['email']));
    $pass = htmlentities(mysqli_escape_string($con, $_POST['password']));
    $used_pass = sha1($pass);
    $gender = htmlentities(mysqli_escape_string($con, $_POST['user_gender']));

    if ($gender == 1) {
        $profile_pic = "https://www.w3schools.com/w3images/avatar2.png";
    } else {
        $profile_pic = "https://www.w3schools.com/howto/img_avatar2.png";
    }

    $errors = array();

    if (empty($name)) {
        $errors[] = '<p> Please enter user name </p>';
    }
    if (empty($pass)) {
        $errors[] = '<p> Please enter Password </p>';
    } elseif (strlen($pass) != 0 && strlen($pass) < 8) {
        $errors[] = '<p> password should be larger than 8 charcharters </p>';
    }
    if (empty($email)) {
        $errors[] = '<p> Please enter email </p>';
    }
    $check_email = "select * from users where user_email='$email'";
    $run_email = mysqli_query($con, $check_email);
    $check = mysqli_num_rows($run_email);
    if ($check == 1) {
        $errors[] = "Email Already Exists";
    }

    if (empty($gender)) {
        $errors[] = '<p> Please enter gender </p>';
    }

    if (empty($errors)) {

        $insert = "insert into users (username, user_email, user_pass,  user_gender, profile_pic) Values ('$name', '$email', '$used_pass', '$gender', '$profile_pic')";
        $query = mysqli_query($con, $insert);

        if ($query) {
            echo "
            <script> 
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                type: 'success',
                title: 'Profile added successfully'
            })
        </script>
        ";

            echo "<script> setTimeout('window.open(\'signin.php\', \'_self\')', 2000) </script>";
        }
    } else {
        $new_errors = implode($errors);

        echo "
        <script> 
            Swal.fire({
                title: 'Error!',
                html: '$new_errors',
                type: 'error',
                confirmButtonText: 'Done' 
            })
        </script>
        ";
    }
}
