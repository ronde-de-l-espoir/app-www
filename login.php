<?php
    require('../db_config.php');
    if (isset($_POST['submit'])) {
        if ($_POST['pwd'] == $appPWd){
            header('Location: ./main.php');
        }
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
        <form id="con-box" method="POST" action="login.php">
            <input type="password" placeholder="Mot de passe" required id="pwd" name="pwd">
            <button type="submit" id="btn" name="submit">Connexion</button>
        </form>
    </main>
</body>
</html>