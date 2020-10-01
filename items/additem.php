<!-- <a href="../userlist.php">View User</a> -->
<!-- <br> -->
<?php
    session_start();
    include '../connect/db.inc.php';
    $bulk = new MongoDB\Driver\BulkWrite;
    $owner = $_POST["owner"];
    $cdate = $_POST["cdate"];
    $desc = $_POST["desc"];
    // $filter = ['username' => $username];
    // $regexUsername = '/^[a-zA-Z0-9]+$/';
    // $regexPwd = '/^\S*(?=\S{6,})\S*$/';
    
    // if(!preg_match($regexUsername, $username)){
    //     $_SESSION["message"] = "Username should contain only alphanumeric characters";
    //     $_SESSION["form"] = $_POST;
    //     header('Location: ../views/register.php');
    //     exit();
    // } 
    // else if(!preg_match($regexPwd, $username)){
    //     $_SESSION["message"] = "Password should contain at least 6 characters";
    //     $_SESSION["form"] = $_POST;
    //     header('Location: ../register.php');
    //     exit();
    // }

    // $query = new MongoDB\Driver\Query($filter);

    // $rows = $manager->executeQuery($dbname, $query);
    // $cursorArray = $rows->toArray();
    // if(isset($cursorArray[0])) {
    //     $_SESSION["message"] = "Username Exist";
    //     $_SESSION["form"] = $_POST;
    //     header('Location: ../views/register.php');
    //     exit();
    // }
    // $pwd = $_POST["pwd"];
    // $password = password_hash($pwd,  PASSWORD_DEFAULT);

    $item = [
        '_id' => new MongoDB\BSON\ObjectId,
        'owner' => new MongoDB\BSON\ObjectId($owner),
        'cdate' => $cdate,
        'desc' => $desc,
        'bids' => []
    ];

    try{
        $bulk->insert($item);
        // include 'db.inc.php';
        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite($dbitem, $bulk);
        header('Location: ../views/itemlist.php');   
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>