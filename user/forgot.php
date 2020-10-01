<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_POST["id"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try{
        $bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
        [
            'password' => $pwd
        ]
    );
        include '../connect/db.inc.php';
        $result = $manager->executeBulkWrite($dbname, $bulk);
        header("Location: ../views/userlist.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>