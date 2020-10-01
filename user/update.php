<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_POST["id"];
    // $name = $_POST["name"];
    // $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $password = password_hash($pwd,  PASSWORD_DEFAULT);
    try{
        $bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => ['password' => $password]],
        // [
        //     // 'name' => $name,
        //     // 'username' => $username,
        //     'password' => $password
        // ]
    );
        include '../connect/db.inc.php';
        $result = $manager->executeBulkWrite($dbuser, $bulk);
        header("Location: ../views/userlist.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>