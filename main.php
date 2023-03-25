<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!(isset($_SESSION['connected']))){
        header('Location: ./login.php');
    }
    require('../db_config.php');

    if (isset($_POST)){
        if (isset($_POST['annuler'])){
            header('Location: ./login.php');
        } elseif (isset($_POST['valider'])) {
            $isAnonymous = true;
            if ($_POST['type'] == 'don'){
                $isDonSimple = true;
                $isVente = false;
            } elseif ($_POST['type'] == 'vente'){
                $isVente = true;
                $isDonSimple = false;;
            }
            if ($_POST['moyen'] == 'especes'){
                $isCash = true;
                $isCheque = false;
            } elseif ($_POST['moyen'] == 'cheque'){
                $isCash = false;
                $isCheque = true;
            }
            $amount_donated = $_POST['montant'];

            $sql = "INSERT INTO donations(amount_donated, isAnonymous, isCash, isCheque, isDonSimple, isVente) VALUES ('$amount_donated', '$isAnonymous', '$isCash', '$isCheque', '$isDonSimple', '$isVente')";
            if (!mysqli_query($conn, $sql)) {
                echo "Query error: " .mysqli_error($conn);
            } else {
                $dbSuccess = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Ajouter un paiement</title>
</head>
<body>
    <h1>Veuillez compléter le formulaire</h1>
    <form action="./main.php" method="post">
        <div class="form-element">
            <label for="type" class="main-label">Type de rentrée de fonds</label>
            <label><input type="radio" name="type" value="don">Don</label>
            <label><input type="radio" name="type" value="vente">Vente</label>
        </div>
        <div class="form-element">
            <label for="moyen" class="main-label">Moyen de paiement</label>
            <label><input type="radio" name="moyen" value="especes">Espèces</label>
            <label><input type="radio" name="moyen" value="cheque">Chèque</label>
        </div>
        <div class="form-element" style="margin-bottom: 0;">
            <label for="montant" class="main-label">Montant</label>
            <label>La personne donne : <input type="number" name="montant" min="0.1" id="montant-1"> €</label>
            <label style="padding-bottom: 3px;">Confirmez : <input type="number" name="montant" min="0.1" id="montant-2" oninput="checkSame()"> €</label>
            <p id="error-text" class="hidden">Les montants ne correspondent pas</p>
        </div>
        <div class="form-element" id="final-btns">
            <div class="btn-div" style="justify-content: flex-start;">
                <button type="submit" name="annuler" id="annuler">Annuler</button>
            </div>
            <div class="btn-div" style="justify-content: flex-end;">
                <button type="submit" name="valider" id="valider">Valider</button>
            </div>
        </div>
    </form>
    <script src="./main.js"></script>
</body>
</html>