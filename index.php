<?php
session_start();
if (isset($_SESSION['user_email'])) {
    header('location:home.php');
}
?>
<!doctype html>
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
    <title>Chat</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-custom">
        <a href="index.php" class="navbar-brand">
            <div class="logo ">
                <span class="font-weight-bold ">EL</span><span class="font-weight-lighter">Chat</span>
            </div>
        </a>
        <form class="form-inline">
            <a href="signup.php" class="btn btn-outline-light my-2 my-sm-0">Sign Up</a>
        </form>
    </nav>

    <div class="container">
        <div class="content">
            <div class="row h-75">
                <div class="col-xs-12 col-md-6">
                    <img src="assets/img/welcome.svg" class="w-100">
                </div>
                <div class="col-xs-12 p-4 flex-column col-md-6 d-flex justify-content-center align-items-center">
                    <h1 class="font-weight-bold">Welcome To ElChat</h1>
                    <p class="lead">This Website just as a practise of ajax php and sql </p>
                    <div class="login d-flex justify-content-around align-items-center">
                        <a href="signin.php" class="btn btn-secondary font-weight-bold">Login </a>
                        <a href="signup.php" class="btn btn-primary font-weight-bold">Sign up </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-dark text-white">
        <div class="container">
            <div class="footer-content d-flex align-items-center justify-content-around">
                <div class="avatar d-flex align-items-center justify-content-center">
                    <img src="https://i1.sndcdn.com/artworks-000175541659-tf1iel-t500x500.jpg" class="rounded-circle rounded-sm mr-1" alt="">
                    <div class="d-inline-block">
                        <div class="font-weight-bold">Created By</div>
                        Mohamed Elhefni
                    </div>
                </div>
                <div class="social-icons w-25 d-flex justify-content-around  align-items-center ">
                    <h5><a href="https://www.facebook.com/profile.php?id=100008240208604" class="text-white" target="_blink"><i class="fa fa-facebook"></i></a></h5>
                    <h5><a href="https://www.instagram.com/mohamed_hosam19/" class="text-white" target="_blink"><i class="fa fa-instagram"></i></a></h5>
                    <h5><a href="https://github.com/MohamedElhefni/" class="text-white" target="_blink"><i class="fa fa-github"></i></a></h5>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>

</html>