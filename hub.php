<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!(isset($_SESSION['connected']))){
        header('Location: ../login/login.php');
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
    
</body>
</html>