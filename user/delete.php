<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_GET["id"];

    try{
        $bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
        include '../connect/db.inc.php';
        $result = $manager->executeBulkWrite($dbuser, $bulk);
        header("Location: ../views/userlist.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>