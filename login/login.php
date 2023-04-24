<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require('../../db_config.php');
    if (isset($_POST['submit'])) {
        if ($_POST['pwd'] == $appPWd){
            $_SESSION['connected'] = true;
            header('Location: ./main.php');
        }
    } elseif (isset($_SESSION['connected'])){
        header('Location: ./main.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <!-- <script src="./app.js"></script> -->
    <title>Ajouter un paiement</title>
</head>
<body>
    <main>
        <h1>Connectez-vous</h1>
        <form id="center-box" method="POST" action="login.php">
            <input type="password" placeholder="Mot de passe" required id="pwd" name="pwd">
            <button type="submit" class="btn" name="submit">Connexion</button>
        </form>
    </main>
</body>
</html>