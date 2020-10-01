<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_GET["id"];
    // $name = $_POST["name"];
    // $username = $_POST["username"];
    $bid = $_POST["bid"];
    // $password = password_hash($pwd,  PASSWORD_DEFAULT);
    try{
        $bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$push' => ['bids' => $bid]],
    );
        include '../connect/db.inc.php';
        $result = $manager->executeBulkWrite($dbitem, $bulk);
        header("Location: ../views/itemlist.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>