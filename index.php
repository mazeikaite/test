<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
}

//logout
if (isset($_GET['action']) and $_GET['action'] == 'logout') {
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged_in']);
    header("location: login.php");
}

?>
<?php
require_once 'delete.php';
// require_once 'upload.php';
require_once 'download.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <title>File System Manager</title>
</head>
<style>
    <?php include "style.css" ?>
</style>
<!-- back'as  -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body>
    <p>File System Manager</p>
    <!--  back'o mygtukas -->

    <button class="forms__button back" onclick="history.go(-1);">Back</button>
    <?php

    $path = "./" . $_GET['path'];
    $myfiles = scandir($path); // direktoriju nuskenavimas
    $myfiles = array_diff($myfiles, array('.', '..', 'index.php', 'delete.php', 'upload.php', 'download.php', 'login.php', 'style.css'));
    $myfiles = array_values($myfiles);
    print('<table>
    <tr>
        <th>Type</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>');

    foreach ($myfiles as $files) {
        // parodom ar file'as ar directory
        if (is_dir($path . $files)) {
            print('<tr><td>Directory</td>
        <td> <a href=?path=' . $_GET['path'] . urlencode($files) . '/>' . $files . '</a></td><td></td></tr>');
        } elseif (is_file($path . $files)) {
            print('<tr><td>File</td>
        <td>' . $files .  "</td>
        <td class = 'action'><form action= '' method = 'POST' class='form_table'>
        <input type='hidden' name='file_name' value='" . $_GET['path'] . $files . "'>
        <input class='btn' type='submit' name='delete_file' value='Delete'>
        </form>

        <form class='form_table' action ='' method = 'POST' enctype='multipart/form-data'>
        <input  class='btn' type='submit' name='file_name' value= 'Download'>
        <input  type='hidden' name='download' value= '" . $_GET['path'] . $files . "'>
        </form>
        </td></tr>");
        };
    }
    print('</table>');
    ?>

    <br>
    <br>
    <!-- galimybe sukurti naujas direktorijas  -->
    <div class="create_card">
        <form class="new_directory" action="" method="POST">
            <input type="text" name="folderName" id="folderName" placeholder="Name New Directory">
            <input class="btn" type="submit" value="Create">
        </form>
        <?php
        $folderName = $_POST['folderName'];
        if (isset($_POST['folderName'])) {
            header("Refresh: 1");
            if (!file_exists($path . $folderName)) {
                mkdir($path . $folderName);
            }
        }

        ?>
        <!-- galimybe ikelti failus -->
        <?php
        require_once 'upload.php';
        ?>
        <form class="upload" action="" method="POST" enctype="multipart/form-data">
            <input class="upload_btn" type="file" name="upload">
            <input class="btn" type="submit" name="upload_button" value="UPLOAD">
        </form>
    </div>
    <p class="logout">Click here to <a href="index.php?action=logout"> logout.</p>

</body>

</html>