<?php

    $utc = new DateTimeZone('UTC');
    $now = new DateTime('now', $utc);
    $now_s = $now->format(DATETIME_FORMAT);
    
    //db constants
    $host = 'mysql1.000webhost.com';
    $db = 'a5727943_books';
    $user = 'a5727943_admin';
    $password = 'bears_with_beaks';
 
    // connect to db
    try {
        $dbh = new PDO('mysql:host='.$host.';dbname='.$db, $user, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

?>