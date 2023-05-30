<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require('../../db_config.php');

    function createErrorMessage($errorText) {
        echo "
            <div id='error-msg-wrapper'>
                <div id='error-msg'>
                    <img src='../img/close-icon.png' alt='close'>
                    <h3>Erreur :</h3>
                    <p>$errorText</p>
                </div> 
            </div>
        ";
    }

    if (!isset($_SESSION['step'])){
        $_SESSION['step'] = 1;
    }

    if (isset($_POST['submit'])){
        if ($_POST['submit'] == 'Valider'){
            if ($_SESSION['step'] == 1){
                if (isset($_POST['type'])){
                    if ($_POST['type'] == 'don'){
                        $_SESSION['isDonSimple'] = true;
                        $_SESSION['isVente'] = false;
                    } elseif ($_POST['type'] == 'vente'){
                        $_SESSION['isDonSimple'] = true;
                        $_SESSION['isVente'] = true;
                    }
                    $_SESSION['step'] = 2;
                } else {
                    createErrorMessage("Veuillez sélectionner le type de l'entrée.");
                }
            } elseif ($_SESSION['step'] == 2){
                if (isset($_POST['moyen'])){
                    if ($_POST['moyen'] == 'cash'){
                        $_SESSION['isCash'] = true;
                        $_SESSION['isCheque'] = false;
                        $_SESSION['step'] = 4;
                    } elseif ($_POST['moyen'] == 'cheque'){
                        $_SESSION['isCash'] = false;
                        $_SESSION['isCheque'] = true;
                        $_SESSION['step'] = 3;
                    }
                } else {
                    createErrorMessage("Veuillez sélectionner le moyen de paiement.");
                }
            } elseif ($_SESSION['step'] == 3){
                
            } elseif ($_SESSION['step'] == 4){
                $showedError = false;
                if (isset($_POST['amount']) && $_POST['amount'] != null){
                    $amount = $_POST['amount'];
                } else {
                    createErrorMessage("Le premier montant n'est pas renseigné.");
                    $showedError = true;
                }
                if (isset($_POST['amountConfirm']) && $_POST['amountConfirm'] != null){
                    $amountConfirm = $_POST['amountConfirm'];
                } elseif ($showedError == false) {
                    createErrorMessage("Le deuxième montant n'est pas renseigné.");
                    $showedError = true;
                }
                if (isset($amount) && isset($amountConfirm) && $amount == $amountConfirm){
                    $_SESSION['amount'] = $amount;
                    // do insert
                } elseif ($showedError == false) {
                    createErrorMessage("Le montant diffère d'une case à l'autre.");
                    $showedError = true;
                }
            }
        } elseif ($_POST['submit'] == "Effacer tout") {
            $startDeleting = false;
            foreach ($_SESSION as $key=>$value){
                if ($key == 'isDonSimple'){
                    $startDeleting = true;
                }
                if ($startDeleting == true){
                    unset($_SESSION[$key]);
                }
            }
            $_SESSION['step'] = 1;
        } elseif ($_POST['submit'] == "Retour"){
            $_SESSION['step'] = $_SESSION['step'] - 1;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../root.css">
    <script src="./app.js" defer></script>
    <title>Entéres d'argent</title>
</head>
<body>

    <header>
        <h1>Entrées d'argent</h1>
    </header>

    <main>
        <form action="./form.php" method="POST">
            <?php print_r($_SESSION) ?>
            <?php if ($_SESSION['step'] == 1) : ?>
            <div class="form-element">
                <h3>Type de l'entrée :</h3>
                <div class="input-wrapper">
                    <label><input type="radio" name="type" value="don"><div class="label-img" id="don"></div>Don</label>
                    <label><input type="radio" name="type" value="vente"><div class="label-img" id="vente"></div>Vente</label>
                </div>
            </div>

            <?php endif ?>

            <?php if ($_SESSION['step'] == 2) : ?>
            <div class="form-element">
                <h3>Moyen de paiement :</h3>
                <div class="input-wrapper">
                    <label><input type="radio" name="moyen" value="cash"><div class="label-img" id="cash"></div>Espèces</label>
                    <label><input type="radio" name="moyen" value="cheque"><div class="label-img" id="cheque"></div>Chèque</label>
                </div>
            </div>
            <?php endif ?>

            <?php if ($_SESSION['step'] == 3) : ?>
            <div class="form-element">
                <h3>Information :</h3>
                <div class="input-wrapper">
                    <label><input type="radio" name="moyen" value="cash"><div class="label-img" id="cash"></div>Espèces</label>
                    <label><input type="radio" name="moyen" value="cheque"><div class="label-img" id="cheque"></div>Chèque</label>
                </div>
            </div>
            <?php endif ?>

            <?php if ($_SESSION['step'] == 4) : ?>
            <div class="form-element">
                <h3>Montant :</h3>
                <div class="input-wrapper columnFlex">
                    <div class="amount-input-wrapper">
                        <input
                            type="number"
                            class="amount-input"
                            name="amount"
                            value="<?= isset($_SESSION['amount']) ? $_SESSION['amount'] : null ?>"
                            min="0"
                            max="10000"
                        >€
                    </div>
                    <div class="amount-input-wrapper">
                        <h4>Confirmez :</h4>
                        <input
                            type="number"
                            class="amount-input"
                            name="amountConfirm"
                            value="<?php // if (isset($_SESSION['amountConfirm'])) echo $_SESSION['amountConfirm'] ?>"
                            min="0"
                            max="10000"
                        >€
                    </div>
                </div>
            </div>
            <?php endif ?>

            <div class="button-field">
                <input type="submit" name="submit" value="Effacer tout">
                <input type="submit" name="submit" value="Retour">
                <input type="submit" name="submit" value="Valider">
            </div>

        </form>
    </main>
    
</body>
</html>