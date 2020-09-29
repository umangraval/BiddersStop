<a href="../userlist.php">View User</a>
<br>
<?php
    $bulk = new MongoDB\Driver\BulkWrite;
    $name = $_POST["name"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $user = [
        '_id' => new MongoDB\BSON\ObjectId,
        'name' => $name,
        'username' => $username,
        'password' => $pwd
    ];

    try{
        $bulk->insert($user);
        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite('phpbasics.test', $bulk);
        echo "user added";    
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>