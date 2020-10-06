<?php
    // use this with docker
    $manager = new MongoDB\Driver\Manager("mongodb://mongo:27017");
    
    // use this with localhost server
    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    $dbuser = "biddersstop.users";
    $dbitem = "biddersstop.items";
    $dbbids = "biddersstop.bids";
?>