<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!(isset($_SESSION['connected']))){
        header('Location: ./login.php');
    }
    require('../db_config.php');
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
    <form>
        <div class="form-element">
            <label for="type" class="main-label">Type de rentrée de fonds</label>
            <label><input type="radio" name="type" value="don">Don</label>
            <label><input type="radio" name="type" value="vente">Vente</label>
        </div>
        <div class="form-element">
            <label for="moyen" class="main-label">Moyen de paiement</label>
            <label><input type="radio" name="moyen" value="don">Espèces</label>
            <label><input type="radio" name="moyen" value="vente">Chèque</label>
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