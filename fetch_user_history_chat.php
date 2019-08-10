<?php

    include('./includes/connection.php');
    include('./includes/functions.php');
    session_start();
    echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $con);