<?php include('./includes/connection.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/mdb.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <title>Chat</title>
</head>

<body class="signup-body">

    <div class="container">
        <div class="signup-card p-3">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="signup-form">
                        <h2 class="font-weight-bold display-4 m-2 ml-4 mt-3">
                            Sign UP
                        </h2>
                        <div class="form mt-5 m-3">
                            <form method="post">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" required placeholder="UserName">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="useremail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="useremail" name="email" required placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword" name="password" required placeholder="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="user_gender" class="custom-select" required>
                                            <option>User Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="buttons  mt-5">
                                    <input type="submit" value="Sign Up" name="sign_up" class="btn font-weight-bold  custom-btn bg-custom"> <span>OR</span>
                                    <a href="signin.php" class="btn btn-primary font-weight-bold custom-btn">Log In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12  col-md-6 d-none d-md-block d-lg-block">
                    <img class="w-100 mt-5" src="assets/img/signup.svg" alt="">
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <?php include('./signup_user.php') ?>
</body>

</html>