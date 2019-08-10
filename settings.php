<?php

include('./includes/connection.php');
include('./includes/functions.php');

session_start();

if (!isset($_SESSION['user_email'])) {
    header('location:signin.php');
}

$action = isset($_GET['action']) ? $_GET['action'] : 'edit';

if ($action == 'edit') {


    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM users Where user_id = '$user_id' ";
    $run_query = mysqli_query($con, $query);
    $result = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
    foreach ($result as $row) { }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/mdb.min.css">

        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
        <title>Chat</title>
    </head>

    <body>
        <nav class="navbar navbar-dark bg-custom">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <div class="logo ">
                        <span class="font-weight-bold ">EL</span><span class="font-weight-lighter">Chat</span>
                    </div>
                </a>
                <div class="form-inline">
                    <div class="dropdown">
                        <div class="trigger select-none pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="small-img avatar-width rounded-circle pointer" id="dropdownMenuButton" src="<?php echo $row['profile_pic'] ?>" alt="">
                            <span class="font-weight-bold"><?php echo $row['username'] ?></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="dropdownMenuButton">
                            <a href="settings.php?action=edit&user_id=<?php echo $_SESSION['id'] ?>" class="dropdown-item"><i class="fa fa-cog"></i> Settings</a>
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <div class="container mt-4">
            <h1>Settings</h1>
            <div class="row mt-3">
                <div class="col-lg-3 col-md-6">
                    <div class="profile-pic ">
                        <img class=" rounded-circle " id="profilePicture" src="<?php echo $row['profile_pic'] ?>" alt="">
                        <div class="overlay">
                            <form method="POST" action="upload_profile_pic.php" id="uploadimage" enctype="multipart/form-data">
                                <label for="profile_pic"><i class="fa fa-camera pointer"></i></label>
                                <input type="file" class="d-none" name="profile_pic" accept=".png, .jpeg, .jpg" id="profile_pic">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6">
                    <form method="post" id="update_profile" class="prevent">
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" required value="<?php echo $row['username'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="useremail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="useremail" name="email" required value="<?php echo $row['user_email'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="oldpass" name="oldpass" value="<?php echo $row['user_pass']  ?>">
                                <input type="password" id="newpass" class="form-control" id="inputPassword" name="password" placeholder="Enter New Password">
                            </div>
                        </div>

                        <div class="buttons  mt-5">
                            <input type="submit" name="update" value="update" id="update" class="btn font-weight-bold  custom-btn bg-custom">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery-3.3.1.min.js">
        </script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/mdb.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            $(document).ready(function() {
                $('#profile_pic').on('change', function() {
                    $('#uploadimage').ajaxSubmit({
                        success: function(data) {
                            $('#profilePicture').attr('src', data);
                        }
                    })
                })
                $('form').submit(e => {
                    e.preventDefault();
                })
                $('#update_profile').submit(function(e) {
                    e.preventDefault();
                    let username = $(this).find('#username').val();
                    let useremail = $(this).find('#useremail').val();
                    let oldpass = $(this).find('#oldpass').val();
                    let newpass = $(this).find('#newpass').val();

                    $.ajax({
                        type: "POST",
                        url: 'update_profile.php',
                        data: {
                            username: username,
                            useremail: useremail,
                            oldpass: oldpass,
                            newpass: newpass
                        }, // serializes the form's elements.
                        success: function(data) {
                            if (data == 1) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    type: 'success',
                                    title: 'Profile Updated successfully'
                                })
                            } else if (data == 3) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Email Aleady Exist'
                                })
                            }
                        }
                    });

                });

            })
        </script>
    </body>

    </html>


<?php

}
?>