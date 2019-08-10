<?php session_start();
if (!isset($_SESSION['user_email'])) {
    header('location:signin.php');
}
include('./includes/connection.php');
$user_id = $_SESSION['id'];
$get_data = "select * from users where user_id = '$user_id'";
$run_data = mysqli_query($con, $get_data);
$row = mysqli_fetch_array($run_data);
$profile_pic = $row['profile_pic'];
$username = $row['username'];
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
            <input type="hidden" id="is_active_group_chat" value="no">
            <button id="group_chat" class="btn purple-gradient rounded-btn" data-toggle="modal" data-target="#group_chat_dialog">GROUP Chating</button>
            <div class="form-inline">
                <div class="dropdown">
                    <div class="trigger select-none pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="small-img avatar-width rounded-circle pointer" id="dropdownMenuButton" src="<?php echo $profile_pic ?>" alt="">
                        <span class="font-weight-bold"><?php echo $username ?></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="dropdownMenuButton">
                        <a href="settings.php?action=edit&user_id=<?php echo $_SESSION['id'] ?>" class="dropdown-item"><i class="fa fa-cog"></i> Settings</a>
                        <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <div id="app">
        <div class="container">
            <div class="row d-flex justify-content-around align-items-center">
                <div class="search col-sm-8">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-search"></i></span>
                        </div>
                        <input id="search" type="text" class="form-control" placeholder="Member Name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="buttons">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="all" name="gender" checked value="3" class="custom-control-input">
                            <label class="custom-control-label" for="all">All</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="gender" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="gender" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="user_details" class="user_details mt-3">

            </div>
            <div id="user_modal_details"></div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade " id="group_chat_dialog" tabindex="-1" role="dialog" aria-labelledby="group_chat_dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable " role="document">
            <div class="modal-content">
                <div class="modal-header purple-gradient">
                    <h2 class="modal-title font-weight-bold text-white" id="group_chat_dialog">Group Chat</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="min-height: 400px;height:400px; overflow-y : scroll;" id="group_history">

                </div>
                <div class="modal-footer">
                    <div method="post" class="w-100 prevent">
                        <div class="input-group d-flex justify-content-around align-items-start">
                            <div class="input group-input w-75">
                                <!-- <input type="text" class="form-control message chat_message" id="group_chat_message" placeholder="Message .." aria-label="Input group example" aria-describedby="btnGroupAddon "> -->
                                <div class="form-control message " contenteditable="" style="max-height:150px;height:120px;overflow-y:scroll" id="group_chat_message" placeholder="Message .." aria-label="Input group example" aria-describedby="btnGroupAddon "></div>
                                <div class="upload-image">
                                    <form class="uploadimg" action="upload.php" method="post" id="uploadImage">
                                        <label for="uploadfile"><i class="fa fa-image pointer fa-2x text-primary"></i></label>
                                        <input type="file" class=" d-none pointer" name="uploadfile" id="uploadfile" accept=".png, .jpeg, .jpg">
                                    </form>
                                </div>
                            </div>
                            <div class=" input-group-prepend">
                                <button id="send_group_message" class="input-group-text btn btn-primary  p-3 ml-1 mb-2 rounded-circle" type="submit"><i class="fa fa-send"></i></button>
                            </div>
                        </div>
                        <div class="alert alert-danger d-none">Please Enter Message</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>
        $(document).ready(function() {

            $('#search').keyup(function() {
                $('.card').removeClass('d-none');
                var filter = $(this).val(); // get the value of the input, which we filter on
                $('.user_details').find('.card .card-body h4:not(:contains("' + filter + '"))').parent().parent().addClass('d-none');
            })
            $('#all').click(function() {
                var filter = $(this).val(); // get the value of the input, which we filter on
                var users = $('.user_details').find('.card');
                users.each(function() {
                    if ($(this).data('gender') == 3) {
                        $(this).css('display', '');
                    } else {
                        $(this).css('display', '');
                    }
                })
            })
            $('#male').click(function() {
                var filter = $(this).val(); // get the value of the input, which we filter on
                var users = $('.user_details').find('.card');
                users.each(function() {
                    if ($(this).data('gender') == 1) {
                        $(this).css('display', '');
                    } else {
                        $(this).css('display', 'none');
                    }
                })
            })
            $('#female').click(function() {
                var filter = $(this).val(); // get the value of the input, which we filter on
                var users = $('.user_details').find('.card');
                users.each(function() {
                    if ($(this).data('gender') == 2) {
                        $(this).css('display', '');
                    } else {
                        $(this).css('display', 'none');
                    }
                })
            })





            $('.dropdown-toggle').dropdown();
            fetch_user();
            setInterval(function() {
                update_last_activity();
                update_chat_history();
                fetch_group_history();

            }, 5000);

            setInterval(function() {
                fetch_user();

            }, 5000)

            function fetch_user() {
                console.log('fetched');
                $.ajax({
                    url: 'fetch_user.php',
                    method: 'POST',
                    success: function(data) {
                        $('#user_details').html(data)
                    }
                })
            }

            function update_last_activity() {
                $.ajax({
                    url: 'update_last_activity.php',
                    success: function() {

                    }
                })
            }

            function make_chat_dialog(to_user_id, to_user_name) {
                var modal_content = `
                    <div id="user_dialog_${to_user_id}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog bd-example-modal-lg" role="document">
                            <div class="modal-content" >
                                <div class="modal-content">
                                    <div class="modal-header purple-gradient color-block  text-white  z-depth-1">
                                        <h5 class="modal-title">Send Message To ${to_user_name}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div id="chat_history_${to_user_id}" class="modal-body  chat_history" style="min-height: 400px;height:400px; overflow-y : scroll;">
                                    ${fetch_user_chat_history(to_user_id)}
                                    </div>
                                    <div class="modal-footer w-100 ">
                                        <form method="post" class="w-100 send-message">
                                        <div class="input-group d-flex justify-content-around align-items-center">
                                            <div class="input w-75">
                                                <input type="text" class="form-control message chat_message" id="chat_message_${to_user_id}" placeholder="Message .." aria-label="Input group example" aria-describedby="btnGroupAddon name="chat_message_${to_user_id}" id="chat_message_${to_user_name}"">                                                                                    </div>
                                            <div class="input-group-prepend">
                                                <button class="input-group-text btn btn-primary send_chat p-3 ml-1 mb-2 rounded-circle" type="submit" data-id="${to_user_id}"><i class="fa fa-send"></i></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-danger d-none" >Please Enter Message</div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </div>
                
                `;

                $('#user_modal_details').html(modal_content);
                $('.send-message').submit(e => {
                    e.preventDefault();
                })

            }

            $('.prevent').submit(e => {
                e.preventDefault();
            })

            $(document).on('click', '.start_chat', function() {
                let to_user_id = $(this).data('touserid');
                let to_user_name = $(this).data('tousername');
                make_chat_dialog(to_user_id, to_user_name);
                $("#user_dialog_" + to_user_id).modal();
                $("#chat_message_" + to_user_id).emojioneArea({
                    pickerPosition: 'top',
                    toneStyle: 'bull',
                    buttonTitle: "Use the TAB key to insert emoji faster",


                });

                $(`#chat_history_${to_user_id}`).stop().animate({
                    scrollTop: $(`#chat_history_${to_user_id}`)[0].scrollHeight
                }, 1000);


            });

            $(document).on('click', '.send_chat', function() {
                let to_user_id = $(this).data('id');
                let chat_message = $(this).parent().parent().find('input').val();
                if ($(`#chat_message_${to_user_id}`).val().length == 0) {

                    $(`#chat_message_${to_user_id}`).parents().find('.alert').addClass('d-block')
                } else {
                    $.ajax({
                        url: 'insert_chat.php',
                        method: 'POST',
                        data: {
                            to_user_id: to_user_id,
                            chat_message: chat_message
                        },
                        success: function(data) {
                            $(`.emojionearea-editor`).text('');
                            $(`#chat_history_${to_user_id}`).html(data)
                        }
                    });

                    function scroll() {
                        $(`#chat_history_${to_user_id}`).stop().animate({
                            scrollTop: $(`#chat_history_${to_user_id}`)[0].scrollHeight
                        }, 1000);

                    }
                    scroll();
                    $(`#chat_message_${to_user_id}`).parents().find('.alert').removeClass('d-block');
                    $(`#chat_message_${to_user_id}`).val('');
                }

            });





            function fetch_user_chat_history(to_user_id) {
                $.ajax({
                    url: 'fetch_user_history_chat.php',
                    method: 'POST',
                    data: {
                        to_user_id: to_user_id
                    },
                    success: function(data) {
                        $(`#chat_history_${to_user_id}`).html(data);
                    }
                })
            }



            function update_chat_history() {
                $('.start_chat').each(function() {
                    let to_user = $(this).data('touserid');
                    fetch_user_chat_history(to_user);
                })
            }

            $('.start_chat').each(function() {
                $(this).click(function() {})
                let to_user = $(this).data('touserid');
                update_unread_message(to_user);
            })

            $(document).on('keyup', '.chat_message', function() {
                let is_type = 'yes';
                $.ajax({
                    url: 'update_is_type.php',
                    method: 'POST',
                    data: {
                        is_type: is_type
                    },
                    success: function() {

                    }
                })
            })
            $(document).on('blur', '.chat_message', function() {
                let is_type = 'no';
                $.ajax({
                    url: 'update_is_type.php',
                    method: 'POST',
                    data: {
                        is_type: is_type
                    },
                    success: function() {

                    }
                })
            });

            $('#group_chat').click(function() {
                $('#is_active_group_chat').val('yes');
                fetch_group_history();
            });

            $('#send_group_message').click(function() {
                let chat_message = $('#group_chat_message').html();
                let action = 'insert_data';

                if (chat_message != '') {
                    $.ajax({
                        url: 'group_chat.php',
                        method: 'POST',
                        data: {
                            chat_message: chat_message,
                            action: action
                        },
                        success: function(data) {
                            $('#group_chat_message').html('');
                            $('#group_history').html(data)
                        }
                    });
                }
            });

            function fetch_group_history() {
                let group_chat_active = $('#is_active_group_chat').val();
                let action = 'fetch_data';
                if (group_chat_active == 'yes') {

                    $.ajax({
                        url: 'group_chat.php',
                        method: 'POST',
                        data: {
                            action: action
                        },
                        success: function(data) {
                            $('#group_history').html(data)

                        }

                    })

                }
            }

            $('#uploadfile').on('change', function() {
                $('#uploadImage').ajaxSubmit({
                    target: "#group_chat_message",

                })
            })


            $(document).on('click', '.remove_chat', function() {
                let message_id = $(this).attr('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Deleted!',
                            'Your message has been deleted.',
                            'success'
                        )
                        deletMessage(message_id)
                    }
                })

                function deletMessage(message_id) {
                    $.ajax({
                        url: 'remove_message.php',
                        method: "POST",
                        data: {
                            message_id: message_id
                        },
                        success: function(data) {
                            update_chat_history();
                        }
                    })
                }
            })


        });
    </script>
</body>

</html>