<?php

    // Trois cas différents existent :
    //  - hasPaid = 0 && hasPaidAll = 0
    //  => Cela veut dire que l'accompagnant n'a pas payé de quelques manières
    //  - hasPaid = 1 && hasPaidAll = 0
    //  => Cela veut dire que l'accompagnant s'est seulement payé sa place, laissant les autres payer eux-mêmes
    //  - hasPaid = 1 && hasPaidAll = 1
    //  => Cela signifie que l'accompagnant a payé pour tout le monde
    //
    //  Note : Le cas "hasPaid = 0 && hasPaidAll = 1" est impossible car l'accompagnant paie pour lui si il paie aussi pour les autres

    require('../../../db_config.php');

?>