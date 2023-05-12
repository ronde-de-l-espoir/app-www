<?php

    require('../../../db_config.php');

    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM preinscriptions WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        $ans = mysqli_fetch_assoc($res);
    } else {
        header('Location: ../how-to.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../root.css">
    <link rel="stylesheet" href="./informations.css">
    <title>Informations</title>
</head>
<body>

    <header>
        <h1>Fiche d'individu</h1>
    </header>

    <?php if ($ans == null) : ?>
        
        <section class="not-found">
            <img src="../../img/not-found-icon.png" alt="Not Found icon">
            <p class="warning">Attention, ce ticket n'existe pas.</p>
            <div class="button-wrapper">
                <a href="../how-to.php" class="btn">Retour</a>
            </div>
        </section>
        
    <?php else : ?>

        <main class="fiche">
            <div class="main-wrapper">        

                <section id="identity">
                    <div class="code-display">
                        <p><?php 
                            for($i = 0; $i < 5; $i++) {
                                echo $ans['id'][$i];
                            }
                        ?></p>
                        <p><?php 
                            for($i = 5; $i < 9; $i++) {
                                echo $ans['id'][$i];
                            }
                        ?></p>
                    </div>
                    <div class="more-infos">
                        <div id="id-display">
                            <p><span id="fname"><?php echo $ans['fname'] ?></span>
                            <span id="lname"><?php echo $ans['lname'] ?></span></p>
                        </div>
                        <div class="contact-infos">
                            <p><span id="email"><?php echo $ans['email'] ?></span></p>
                        </div>
                    </div>
                </section>

                <section id="event">
                    <div class="info-field">
                        <?php if ($ans['event'] == 'Gala') : ?>
                            <img src="../../img/show-icon.png" class="info-icon" alt="Event Icon">
                        <?php elseif ($ans['event'] == 'Concert') : ?>
                            <img src="../../img/concert-icon.png" class="info-icon" alt="Event Icon">
                        <?php endif; ?>
                        <p>Participe au <span class="important-info"><?php echo $ans['event'] ?>.</span></p>
                    </div>
                    <div class="info-field">
                        <img src="../../img/crowd-icon.png" class="info-icon" alt="Icon">
                        <p>Est accompagné par <span class="important-info"><?php echo $ans['nChildren'] ?> personnes.</span></p>
                    </div>
                </section>

            </div>
        </main>
        
    <?php endif ?>
    
    
    </body>
</html>