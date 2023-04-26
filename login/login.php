<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $_POST['pwd'] = 'LRDE2023';
    $_POST['submit'] = 'Log In';

    require('../../db_config.php');
    if (isset($_POST['submit'])) {
        if ($_POST['pwd'] == $appPWd){
            $_SESSION['connected'] = true;
            header('Location: ../hub.php');
        }
    } elseif (isset($_SESSION['connected'])){
        header('Location: ../hub.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <link rel="stylesheet" href="../root.css">
    <!-- <script src="./app.js"></script> -->
    <title>Login</title>
</head>
<body>

    <main>
        <div class="top-icon">
            <img src="../img/lrde-icon.png" alt="icon">
        </div>

        <form action="login.php" method="POST" autocomplete="off">
            <div class="field">
                <img src="../img/account-icon.png" alt="icon">
                <input type="text">
            </div>

            <div class="field">
                <img src="../img/password-icon.png" alt="icon">
                <input type="password">
            </div>
        </form>
        <div class="trouble-manager">
            <p><i>Identifiants oubliés ?</i></p>
        </div>
        
    </main>

</body>
</html>