<?php

    if (isset($_POST['submit'])) {
        echo $_POST['type'] . '<br>' . $_POST['moyen'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../root.css">
    <title>Entéres d'argent</title>
</head>
<body>

    <header>
        <h1>Entrées d'argent</h1>
    </header>

    <main>
        <form action="./form.php" method="POST">
            <div class="form-element">
                <h3>Type de l'entrée :</h3>
                <div class="input-wrapper">
                    <label><input type="radio" name="type" value="don" required><div class="label-img" id="don"></div>Don</label>
                    <label><input type="radio" name="type" value="vente" required><div class="label-img" id="vente"></div>Vente</label>
                </div>
            </div>

            <div class="form-element">
                <h3>Moyen de paiement :</h3>
                <div class="input-wrapper">
                    <label><input type="radio" name="moyen" value="cash" required><div class="label-img" id="cash"></div>Espèces</label>
                    <label><input type="radio" name="moyen" value="cheque" required><div class="label-img" id="cheque"></div>Chèque</label>
                </div>
            </div>

            <div class="form-element">
                <h3>Montant :</h3>
                <div class="input-wrapper columnFlex">
                    <div class="amount-input-wrapper">
                        <input
                            type="number"
                            class="amount-input"
                            name="amount"
                            value=""
                            min="0"
                            max="10000"
                        >€
                    </div>
                    <div class="amount-input-wrapper">
                        <h4>Confirmez :</h4>
                        <input
                            type="number"
                            class="amount-input"
                            name="amount"
                            value=""
                            min="0"
                            max="10000"
                        >€
                    </div>
                </div>
            </div>

            <input type="submit" name="submit" value="submit">
        </form>
    </main>
    
</body>
</html>