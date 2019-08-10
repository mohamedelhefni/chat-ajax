<?php

function fetch_user_last_activity($user_id, $conn)
{
    $query = "SELECT * FROM login_details WHERE user_id = '$user_id' ORDER by last_activity DESC LIMIT 1";

    $run_query = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($run_query, MYSQLI_ASSOC);

    foreach ($result as $row) {
        return $row['last_activity'];
    }
}


function to_time_ago($time)
{

    // Calculate difference between current 
    // time and given timestamp in seconds 
    $diff = time() - $time;

    if ($diff < 1) {
        return 'less than 1 second ago';
    }

    $time_rules = array(
        12 * 30 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60       => 'month',
        24 * 60 * 60           => 'day',
        60 * 60                   => 'hour',
        60                       => 'minute',
        1                       => 'second'
    );

    foreach ($time_rules as $secs => $str) {

        $div = $diff / $secs;

        if ($div >= 1) {

            $t = round($div);

            return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
        }
    }
}




function fetch_user_chat_history($from_user_id, $to_user_id, $con)
{
    $query = "SELECT * FROM chat_message WHERE (to_user_id = $to_user_id AND from_user_id = $from_user_id) OR (to_user_id = $from_user_id AND from_user_id = $to_user_id) ORDER BY timestamp ASC";
    $run_query = mysqli_query($con, $query);
    $result = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
    $output = '<ul class="list-unstyled">';
    foreach ($result as $row) {
        $user_name = '';
        if ($row['from_user_id'] == $from_user_id) {
            $user_name = '<b class="text-success">You</b>';
            $visible_me =  true;
            $src = get_avatar($row['from_user_id'], $con);
        } else {
            $user_name = "<b class='text-danger'> " . get_user_name($row['from_user_id'], $con) . " </b>";
            $visible_me =  false;
            $src = get_avatar($row['from_user_id'], $con);
        }
        $output .= "
        <li class='d-flex align-items-start mb-4'>
        <img src='$src' alt='avatar' class='avatar " . ($visible_me ? '' : 'd-none') . " avatar-width rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1'>

            <div class='chat-body white w-100 p-3 ml-2 z-depth-1'>
                <div class='header'>
                    <strong class='primary-font'>$user_name</strong>
                    <small class='pull-right text-muted'><i class='far fa-clock'></i> " .  to_time_ago(strtotime($row['timestamp']))   . "  " . ($visible_me ? "<i class='fa fa-times pointer ml-1 text-danger remove_chat' id='" . $row['chat_message_id'] . "' ></i>" : "") . " </small>
                </div>
                <hr class='w-100'>
                <p class='mb-0'>
                   " . $row['chat_message'] . "
                </p>
            </div>
            <img src='$src' alt='avatar' class='avatar " . ($visible_me ? 'd-none' : '') . " avatar-width rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1'>

        </li>
        ";
    }
    $output .= '</ul>';


    return $output;
}

function get_user_name($user_id, $con)
{
    $query = "SELECT * FROM users WHERE user_id = $user_id ";
    $run_query = mysqli_query($con, $query);
    $result = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
    foreach ($result as $row) {
        return $row['username'];
    }
}
function get_avatar($user_id, $con)
{
    $query = "SELECT * FROM users WHERE user_id = $user_id ";
    $run_query = mysqli_query($con, $query);
    $result = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
    foreach ($result as $row) {
        return $row['profile_pic'];
    }
}

function count_unread_message($from_user_id, $to_user_id, $con)
{
    $query = " SELECT * FROM chat_message WHERE to_user_id = '$to_user_id' AND from_user_id = '$from_user_id' AND status = '1' ";
    $run_query = mysqli_query($con, $query);
    $count = mysqli_num_rows($run_query);
    if ($count > 0) {
        $output  = $count;
    } else {
        $output = '';
    }

    return $output;
}


function fetch_is_typing($user_id, $con)
{
    $query = "
        SELECT is_type from login_details where user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1
    ";
    $run_query = mysqli_query($con, $query);
    $result = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
    foreach ($result as $row) {
        if ($row['is_type'] == 'yes') {
            $output = true;
        } else {
            $output = false;
        }
        return $output;
    }
}


function fetch_group_history($con)
{
    $query = "SELECT * FROM chat_message WHERE to_user_id = '0' order by timestamp DESC";
    $run_query = mysqli_query($con, $query);
    $result = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
    $output = '<ul class="list-unstyled">';
    foreach ($result as $row) {
        $user_name = '';
        $src = get_avatar($row['from_user_id'], $con);
        if ($row['from_user_id'] == $_SESSION['id']) {
            $user_name = '<b class="text-success">You</b>';
            $visible_me = true;
        } else {
            $user_name = "<b class='text-danger'> " . get_user_name($row['from_user_id'], $con) . " </b>";
            $visible_me = false;
        }
        $output .= "
        <li class='d-flex align-items-start mb-4'>
        <img src='$src' alt='avatar' class='avatar avatar-width rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1'>

            <div class='chat-body white w-100 p-3 ml-2 z-depth-1'>
                <div class='header'>
                    <strong class='primary-font'>$user_name</strong>
                    <small class='pull-right text-muted'><i class='fa fa-clock'></i> " .  to_time_ago(strtotime($row['timestamp']))   . "  " . ($visible_me ? "<i class='fa fa-times pointer ml-1 text-danger remove_chat' id='" . $row['chat_message_id'] . "' ></i>" : "") . "</small>
                </div>
                <hr class='w-100'>
                <p class='mb-0'>
                   " . $row['chat_message'] . "
                </p>
            </div>

        </li>
        ";
    }
    $output .= '</ul>';


    return $output;
}
