<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_GET["id"];


    try{
        $bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite('phpbasics.test', $bulk);
        header("Location: ../userlist.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>