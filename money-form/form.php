<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // require('../../db_config.php');

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
                $showedError = false;
                if (isset($_POST['address'])){
                    if (preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 œ_\-,']*$/", $_POST['address'])){
                        $_SESSION['address'] = $_POST['address'];
                    } else {
                        createErrorMessage("Adresse invalide.");
                        $showedError = true;
                    }
                } elseif ($showedError == false) {
                    createErrorMessage("Veuillez renseigner l'adresse.");
                    $showedError = true;
                }
                if (isset($_POST['addressComplement'])){
                    if ((preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 œ_\-,']*$/", $_POST['addressComplement'])) || $_POST['addressComplement'] == ''){
                        $_SESSION['addressComplement'] = $_POST['addressComplement'];
                    } else {
                        createErrorMessage("Complément d'adresse invalide.");
                        $showedError = true;
                    }
                }
                if (isset($_POST['postal'])){
                    if (preg_match('/^[0-9]{5}/', $_POST['postal'])){
                        $_SESSION['postal'] = $_POST['postal'];
                    } elseif ($showedError == false) {
                        createErrorMessage("Code postal invalide.");
                        $showedError = true;
                    }
                    
                } elseif ($showedError == false) {
                    createErrorMessage("Veuillez renseigner le code postal.");
                    $showedError = true;
                }
                if (isset($_POST['city'])){
                    if (preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 œ_\-,']*$/", $_POST['city'])){
                        $_SESSION['city'] = $_POST['city'];
                    } elseif ($showedError == false) {
                        createErrorMessage("Ville invalide.");
                    }
                } elseif ($showedError == false) {
                    createErrorMessage("Veuillez renseigner le code postal.");
                    $showedError = true;
                }
                if ($showedError == false){
                    $_SESSION['step'] = 4;
                }

            } elseif ($_SESSION['step'] == 4){
                if (isset($_POST['isCompany'])){
                    $_SESSION['isCompany'] = $_POST['isCompany'] == 'true' ? true : false;
                    $_SESSION['step'] = 5;
                } else {
                    createErrorMessage("Veuillez renseigner le type de titulaire");
                }
            
            } elseif ($_SESSION['step'] == 5){
                $showedError = false;
                if ($_SESSION['isCompany'] == true){
                    if (isset($_POST['name'])){
                        if (preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 \-_.,']*$/", $_POST['name'])){
                            $_SESSION['companyName'] = $_POST['name'];
                        } elseif ($showedError == false) {
                            createErrorMessage("Dénomination sociale invalide.");
                            $showedError = true;
                        }
                    } elseif ($showedError == false) {
                        createErrorMessage("Veuillez rensiegner la dénomination sociale de l'entreprise");
                        $showedError = true;
                    }
                    if (isset($_POST['siren'])){
                        if (preg_match("/^\d{9}$/", $_POST['siren'])){
                            $_SESSION['siren'] = $_POST['siren'];
                        } elseif ($showedError == false) {
                            createErrorMessage("SIREN invalide");
                            $showedError = true;
                        }
                    } elseif ($showedError == false) {
                        createErrorMessage("Veuillez rensiegner le SIREN");
                        $showedError = true;
                    }
                    if (isset($_POST['siret'])){
                        if (preg_match("/^\d{14}$/", $_POST['siret'])){
                            $_SESSION['siret'] = $_POST['siret'];
                        } elseif ($showedError == false) {
                            createErrorMessage("SIRET invalide");
                            $showedError = true;
                        }
                    } elseif ($showedError == false) {
                        createErrorMessage("Veuillez renseigner le SIRET");
                        $showedError = true;
                    }
                } elseif ($_SESSION['isCompany'] == false){
                    if (isset($_POST['lname'])){
                        if (preg_match('/^[a-zA-Z\-\s]+$/', $_POST['lname'])){
                            $_SESSION['lname'] = $_POST['lname'];
                        } elseif ($showedError == false) {
                            createErrorMessage("Nom invalide");
                            $showedError = true;
                        }
                    } elseif ($showedError == false) {
                        createErrorMessage("Veuillez renseigner un nom.");
                        $showedError = true;
                    }
                    if (isset($_POST['fname'])){
                        if (preg_match('/^[a-zA-Z\-\s]+$/', $_POST['fname'])){
                            $_SESSION['fname'] = $_POST['fname'];
                        } elseif ($showedError == false) {
                            createErrorMessage("Prénom invalide");
                            $showedError = true;
                        }
                    } elseif ($showedError == false) {
                        createErrorMessage("Veuillez renseigner un prénom.");
                        $showedError = true;
                    }
                }
                if ($showedError == false){
                    $_SESSION['step'] = 6;
                }
            
            } elseif ($_SESSION['step'] == 6){
                $showedError = false;
                if (isset($_POST['email'])){
                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $_SESSION['email'] = $_POST['email'];
                    } else {
                        createErrorMessage("Email invalide");
                        $showedError = true;
                    }
                } elseif ($showedError == false) {
                    createErrorMessage("Veuillez renseigner un email.");
                    $showedError = true;
                }
                if (isset($_POST['phone'])){
                    if (preg_match('/^(0|(\+33[\s]?([0]?|[(0)]{3}?)))[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['phone'])){
                        $_SESSION['phone'] = $_POST['phone'];
                    } elseif ($showedError == false) {
                        createErrorMessage("Téléphone invalide");
                        $showedError = true;
                    }
                } elseif ($showedError == false) {
                    createErrorMessage("Veuillez renseigner un numéro de téléphone.");
                    $showedError = true;
                }
                if ($showedError == false){
                    $_SESSION['step'] = 7;
                }
            } elseif ($_SESSION['step'] == 7){
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
                <h3>Adresse</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="address" value="<?= isset($_SESSION['address']) ? $_SESSION['address'] : null ?>">
                    </div>
                </div>
            </div>
            <div class="form-element">
                <h3>Complément d'adresse</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="addressComplement" value="<?= isset($_SESSION['addressComplement']) ? $_SESSION['addressComplement'] : '' ?>">
                    </div>
                </div>
            </div>
            <div class="form-element">
                <h3>Code postal</h3>
                <div class="input-wrapper">
                    <div class="amount-input-wrapper">
                        <input type="number" class="amount-input" name="postal" value="<?= isset($_SESSION['postal']) ? $_SESSION['postal'] : null ?>">
                    </div>
                </div>
            </div>
            <div class="form-element">
                <h3>Ville</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="city" value="<?= isset($_SESSION['city']) ? $_SESSION['city'] : null ?>">
                    </div>
                </div>
            </div>
            <?php endif ?>

            <?php if ($_SESSION['step'] == 4) : ?>
            <div class="form-element">
                <h3>Type de titulaire :</h3>
                <div class="input-wrapper">
                    <label><input type="radio" name="isCompany" value="false"><div class="label-img" id="individu"></div>Individu</label>
                    <label><input type="radio" name="isCompany" value="true"><div class="label-img" id="entreprise"></div>Entreprise</label>
                </div>
            </div>
            <?php endif ?>

            <?php 
                if ($_SESSION['step'] == 5 && $_SESSION['isCompany'] == true) :
                    echo 'yes';
            ?>
            <div class="form-element">
                <h3>Dénomination sociale</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="name" value="<?= isset($_SESSION['companyName']) ? $_SESSION['companyName'] : null ?>">
                    </div>
                </div>
            </div>
            <div class="form-element">
                <h3>SIREN</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="number" class="text-input" name="siren" value="<?= isset($_SESSION['siren']) ? $_SESSION['siren'] : null ?>">
                    </div>
                </div>
            </div>
            <div class="form-element">
                <h3>SIRET</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="number" class="text-input" name="siret" value="<?= isset($_SESSION['siret']) ? $_SESSION['siret'] : null ?>">
                    </div>
                </div>
            </div>

            <?php 
                endif;
                if ($_SESSION['step'] == 5 && $_SESSION['isCompany'] == false) :
            ?>

            <div class="form-element">
                <h3>Nom</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="lname" value="<?= isset($_SESSION['lname']) ? $_SESSION['lname'] : null ?>">
                    </div>
                </div>
            </div>
            <div class="form-element">
                <h3>Prénom</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="fname" value="<?= isset($_SESSION['fname']) ? $_SESSION['fname'] : null ?>">
                    </div>
                </div>
            </div>

            <?php
                endif;
            ?>

            <?php if ($_SESSION['step'] == 6) : ?>
            <div class="form-element">
                <h3>Email</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : null ?>">
                    </div>
                </div>
            </div>
            <div class="form-element">
                <h3>Téléphone</h3>
                <div class="input-wrapper">
                    <div class="text-input-wrapper">
                        <input type="text" class="text-input" name="phone" value="<?= isset($_SESSION['phone']) ? $_SESSION['phone'] : null ?>">
                    </div>
                </div>
            </div>
            <?php endif ?>

            <?php if ($_SESSION['step'] == 7) : ?>
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