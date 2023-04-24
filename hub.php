<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!(isset($_SESSION['connected']))){
        header('Location: ./login/login.php');
    }
    require('../db_config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hub.css">
    <title>Hub</title>
</head>
<body>
    
    <header>
        <h1>Ronde de l'Espoir</h1>
    </header>

    <main>

        <div class="option" id="money-form">
            <img src="./img/form-icon.png" alt="icon">
            <div class="option-text">
                <h3>Entrées d'argent</h3>
                <p class="explanation">Formulaire pour toutes rentrées d'argent.</p>
            </div>
        </div>

        <div class="option" id="gala-scanner">
            <img src="./img/scanner-animated.gif" alt="icon">
            <div class="option-text">
                <h3>Scanner de tickets</h3>
                <p class="explanation">Scanner des tickets de gala.</p>
            </div>
        </div>

    </main>

    <div class="sign-out" onclick="window.location = './reinit.php'">
        <img src="./img/sign-out.png" alt="sign-out">
    </div>
</body>
</html>