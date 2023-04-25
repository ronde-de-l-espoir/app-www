<?php

    $data = [
        'id' => $_GET['id'],
        'fname' => 'Jonathan',
        'lname' => 'ARCHER',
        'age' => 49
    ];

    echo json_encode($data);

?>