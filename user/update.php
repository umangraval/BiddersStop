<?php
    session_start();
    $bulk = new MongoDB\Driver\BulkWrite;

    $id = $_POST["id"];
    $pwd = $_POST["pwd"];
    $cpwd = $_POST["cpwd"];
    if($pwd == $cpwd && strlen($pwd)){
    $password = password_hash($pwd,  PASSWORD_DEFAULT);
    try{
        $bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => ['password' => $password]],
    );
        include '../connect/db.inc.php';
        $result = $manager->executeBulkWrite($dbuser, $bulk);
        $_SESSION["smessage"] = "Password Updated";
        header("Location: /views/pwdchange.php");
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
} else {
    $_SESSION["message"] = "Password is empty or Not equal";
    header('Location: /views/pwdchange.php'); 
}
?>