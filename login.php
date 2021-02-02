<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <title>Log In</title>

</head>
<style>
    <?php include "style.css" ?>
</style>

<body>

    <div class="login_card">
        <?php
        $msg = '';
        if (
            isset($_POST['login'])
            && !empty($_POST['username'])
            && !empty($_POST['password'])
        ) {
            if (
                $_POST['username'] == '1234' &&
                $_POST['password'] == 'asdf'
            ) {
                $_SESSION['logged_in'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = '1234';
            } else {
                $msg = 'Wrong username or password';
            }
        }
        ?>

        <?php
        if ($_SESSION['logged_in'] == true) {
            header("location: index.php");
        }
        ?>
        <p class="welcome">Welcome</p>
        <form class="form_login" action="./login.php" method="post">
            <h6><?php echo $msg; ?></h6>

            <input type="text" name="username" placeholder="Username = 1234" required autofocus>

            <input type="password" name="password" placeholder="Password = asdf" required>

            <button name="login">Log in</button>
        </form>


    </div>


</body>

</html>