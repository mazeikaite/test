<?php
if (isset($_FILES['upload'])) {
    $file_name = $_FILES['upload']['name'];
    $file_size = $_FILES['upload']['size'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $file_type = $_FILES['upload']['type'];
    move_uploaded_file($file_tmp, $path . $file_name);
}
