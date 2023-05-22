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
                    <label><input type="radio" name="type" value="don" required><img src="../img/don-icon.png" alt="" class="label-img">Don</label>
                    <label><input type="radio" name="type" value="vente" required><img src="../img/vente-icon.png" alt="" class="label-img">Vente</label>
                </div>
            </div>

            <div class="form-element">
                <h3>Moyen de paiement :</h3>
                <div class="input-wrapper">
                    <label><input type="radio" name="moyen" value="cash" required><img src="../img/cash-icon.png" alt="" class="label-img">Espèces</label>
                    <label><input type="radio" name="moyen" value="cheque" required><img src="../img/cheque-icon.png" alt="" class="label-img">Chèque</label>
                </div>
            </div>

            <input type="submit" name="submit" value="submit">
        </form>
    </main>
    
</body>
</html>