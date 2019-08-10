<?php
session_start();
include('./includes/connection.php');

if (isset($_POST['sign_in'])) {

    $email = htmlentities(mysqli_escape_string($con, $_POST['email']));
    $pass = htmlentities(mysqli_escape_string($con, $_POST['password']));
    $used_pass = sha1($pass);
    $select_user = "select * from users where user_email = '$email' AND user_pass = '$used_pass'";
    $query = mysqli_query($con, $select_user);
    $check_user = mysqli_num_rows($query);

    if ($check_user == 1) {
        $_SESSION['user_email'] = $email;
        $user = $_SESSION['user_email'];
        $get_user = "select * from users where user_email = '$user' ";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);
        $_SESSION['id']  = $row['user_id'];
        $stat_query = "insert into login_details(user_id) Values (" .  $_SESSION['id'] . ")";
        $run_stat = mysqli_query($con, $stat_query);
        $_SESSION['login_details_id'] = mysqli_insert_id($con);
        echo "
            <script> 
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                type: 'success',
                title: 'Signed in successfully'
            })
        </script>
        ";

        echo "<script> setTimeout('window.open(\'home.php\', \'_self\')', 2000) </script>";
    } else {
        echo "
    <script> 
        Swal.fire({
            title: 'Error!',
            html: '<h5>Please Check Email Or Password Again</h5>',
            type: 'error',
            confirmButtonText: 'Done' 
        })
    </script>
    ";
    }
}
