<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

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
    <link rel="stylesheet" href="../common.css">
    <!-- <script src="./app.js"></script> -->
    <title>Ajouter un paiement</title>
</head>
<body>