<?php

include('./includes/connection.php');
include('./includes/functions.php');
session_start();



$get_uesrs = "select * from users where user_id != '" . $_SESSION['id'] . "'";
$run_get_users = mysqli_query($con, $get_uesrs);
$row_users = mysqli_fetch_all($run_get_users, MYSQLI_ASSOC);
$output = '
  
';

foreach ($row_users as $row_user) {
    $current_tiemstamp = strtotime(date('Y-m-d H:i:s') . '-10 second');
    $current_tiemstamp = date('Y-m-d H:i:s', $current_tiemstamp);
    $user_last_activity = fetch_user_last_activity($row_user['user_id'], $con);
    if ($user_last_activity > $current_tiemstamp) {
        $status = '<span class="badge custom-status badge-success" >Active Now</span>';
    } else {
        $status = '<span class="badge custom-status badge-danger" >offline</span>';
    }
    $is_write = fetch_is_typing($row_user['user_id'], $con);
    $output .= '
    <div class="card rounded-lg text-center z-depth-2" data-gender="' . $row_user['user_gender'] . '">
    <div class="view ">
        <div class="overlay ' . ($is_write ? "d-block" : "") . ' "></div>
        <img class="card-img-top custom-height" src=' . $row_user['profile_pic'] . ' /> 
    </div>
<div class="card-body">
        <h4 class="card-title">' . $row_user['username'] . '</h4>
        <p>' . $status . '</p>
        <p class="lead">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem incidunt doloribus "</p>
</div>

    <span  class="unread-message">
        <i class="fa fa-bell text-white"></i> <span class="badge badge-danger">' . count_unread_message($row_user['user_id'], $_SESSION['id'], $con) . '</span>
    </span>
        <div class="cont d-flex align-items-center justify-content-between" >
          <button type="button" onclick="update_unread_message(' . $row_user['user_id'] . ');"  class=" btn-primary start_chat chat-btn ml-2 mb-2" data-touserid = ' . $row_user['user_id'] . ' data-tousername=' . $row_user['username'] . '> <i class="fa fa-send"></i> </button> 
            <div class="icons p-2 " >
                <i class="fa fa-facebook  p-1 ml-4 text-primary" ></i>
                <i class="fa fa-instagram p-1 ml-4 text-danger " ></i>
                <i class="fa fa-twitter   p-1 ml-4 text-info" ></i>
            </div>
        </div>
</div>
<script>

function update_unread_message(to_user_id) {
    $.ajax({
        url: "update_notifications.php",
        method: "POST",
        data: {
            to_user_id: to_user_id
        },
        success: function(data) {

        }
    })
}

</script>
    ';
}





echo $output;
