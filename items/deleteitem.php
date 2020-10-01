<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_GET["id"];


    try{
        $bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
        include '../connect/db.inc.php';
        $result = $manager->executeBulkWrite($dbitem, $bulk);
        header("Location: ../views/itemlist.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>