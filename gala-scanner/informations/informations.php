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
    <script src="./informations.js" defer></script>
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

                    <?php if ($ans['nChildren'] > 0) : ?>
                        <div class="info-field">
                            <img src="../../img/crowd-icon.png" class="info-icon" alt="Icon">
                            <p>
                                <span class="important-info">
                                    <?php echo $ans['nChildren'] ?> personne<?php if ($ans['nChildren'] > 1) echo "s" ?>
                                </span>
                                <?php if ($ans['nChildren'] > 1) echo "sont dépendantes." ?>
                                <?php if ($ans['nChildren'] == 1) echo "est dépendante." ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if ($ans['parentNode'] != 0) : ?>
                        <?php

                            $parentId = $ans['parentNode'];
                            $parentSql = "SELECT * FROM preinscriptions WHERE id = '$parentId'";
                            $parentRes = mysqli_query($conn, $parentSql);
                            $parentAns = mysqli_fetch_assoc($parentRes);

                        ?>

                        <div class="info-field">
                            <img src="../../img/parent-icon.png" class="info-icon" alt="Icon">
                            <p>Dépend de <span class="important-info"><?php echo $parentAns['id'] ?>.</span></p>
                        </div>
                    <?php endif; ?>
                </section>

                <section id="accounts">
                    <?php if ($ans['nChildren'] > 0) : ?>
                    <!-- ACCOUNTABILITY FOR ACCOMPANIED PEOPLE -->

                    <div id="owed">

                        <div class="person-accountability">
                            <img src="../../img/person-icon.png" alt="Icon" class="icon">
                            <p><?php echo $ans['fname'] ?></p>
                            <p>
                                <span class="important-info">
                                    <?php echo $ans['price'] ?>€
                                </span>
                            </p>
                        </div>
                        
                        <?php
                            ob_start(); // Start output buffering
                            include './fetchChildren.php'; // Include the first PHP file
                            $result = ob_get_clean(); // Capture the output of the first PHP file and store it in a variable
                            $result = json_decode($result, true);

                            $totalPrice = $ans['price'];

                            for ($i = 0; $i < count($result); $i++) {
                                $fname = $result[$i]['fname'];
                                $price = $result[$i]['price'];

                                $totalPrice += $price;

                                echo "
                                <div class='person-accountability'>
                                    <img src='../../img/person-icon.png' alt='Icon' class='icon'>
                                    <p>$fname</p>
                                    <p><span class='important-info'>$price</span><span class='important-info'>€</span></p>
                                </div>
                                ";
                            }
                        ?>



                    </div>

                    <div id="payment">
                        <div class="payment-method">

                            <p>L'accompagnant doit <span class="nowrap"> payer :</span></p>
                            <p class="price-display"><span class="important-info bigger-font"><?php echo $totalPrice ?>€</span></p>
                            
                            <button class="confirm-payment">
                                <img
                                    src="../../img/confirm-icon.png"
                                    id="everyone"
                                    class="icon-confirm"
                                    onclick="handleConfirm('everyone')"
                                    alt="Confirm"
                                    data-confirmed="false"
                                >
                            </button>

                            <!-- <p>L'accompagnant paie pour : <br></p> -->
                            <!-- <ul>
                                <li><span class="important-info"> - Lui-même</span></li>
                                <li><span class="important-info"> - Jonathan</span></li>
                                <li><span class="important-info"> - Jadzia</span></li>
                                <li><span class="important-info"> - Tom</span></li>
                            </ul> -->
                            <!-- <p>L'accompagnant doit payer <span class="important-info bigger-font"><?php echo $totalPrice ?>€</span> </p> -->

                        </div>

                        <!-- <div class="payment-method">
                            <p>L'accompagnant a payé <span class="nowrap">que pour lui :</span></p>
                            <button class="confirm-payment">
                                <img
                                    src="../../img/confirm-icon.png"
                                    id="solo"
                                    class="icon-confirm"
                                    onclick="handleConfirm('solo')"
                                    alt="Confirm"
                                    data-confirmed="true"
                                >
                            </button> -->
                        </div>
                    </div>

                <?php else : ?>


                    
                <?php endif; ?>
                </section>

            </div>
        </main>
        
    <?php endif ?>
    
    
    </body>
</html>