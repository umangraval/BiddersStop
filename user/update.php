<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_POST["id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try{
        $bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
        [
            'name' => $name,
            'username' => $username,
            'password' => $pwd
        ]
    );
        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite('phpbasics.test', $bulk);
        header("Location: ../userlist.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>