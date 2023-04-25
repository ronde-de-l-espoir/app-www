<?php

    require('../../config/db_config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../../root.css">
    <title>Manual Search</title>
</head>
<body>
    
    <main>

        <div class="search-bar">
            <input type="search" placeholder="Chercher un numéro...">
            <img src="../../img/search-icon.png" alt="search-icon">
        </div>

        <section class="results-wrapper">
            
            <div class="result">
                <div class="code-display">
                    <p>01752</p>
                    <p>1348</p>
                </div>

                <div class="more-infos">

                    <div id="id-display">
                        <p>
                            <span id="fname">Jonathan</span>
                            <span id="lname">ARCHER</span>
                            -
                            <span id="age">49 ans</span>
                        </p>
                    </div>

                    <div class="various-infos">

                        

                        <div class="info-icon already-used">
                            <img src="" alt="icon">
                        </div>
                    </div>

                </div>
            </div>

        </section>

    </main>

</body>
</html>