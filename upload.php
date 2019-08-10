<?php


if (!empty($_FILES)) {
    if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
        $img_src = $_FILES['uploadfile']['tmp_name'];
        $img_path = 'upload/' . $_FILES['uploadfile']['name'];
        if (move_uploaded_file($img_src, $img_path)) {
            echo "<p> <img src='" . $img_path . "' class='img-thumbnail'>  </p>";
        }
    }
}
