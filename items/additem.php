<!-- <a href="../userlist.php">View User</a> -->
<!-- <br> -->
<?php
    session_start();
    include '../connect/db.inc.php';
    $bulk = new MongoDB\Driver\BulkWrite;
    $owner = $_POST["owner"];
    $cdate = $_POST["cdate"];
    $cdate=new MongoDB\BSON\UTCDateTime(strtotime($cdate) * 1000);
    $desc = $_POST["desc"];

    $item = [
        '_id' => new MongoDB\BSON\ObjectId,
        'owner' => $owner,
        'cdate' => $cdate,
        'desc' => $desc
    ];

    try{
        $bulk->insert($item);
        $result = $manager->executeBulkWrite($dbitem, $bulk);
        header('Location: ../views/itemlist.php');   
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>