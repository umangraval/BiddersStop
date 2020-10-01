<a href="../userlist.php">View User</a>
<br>
<?php
    $bulk = new MongoDB\Driver\BulkWrite;
    $name = $_POST["name"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $password = password_hash($pwd,  PASSWORD_DEFAULT);

    $user = [
        '_id' => new MongoDB\BSON\ObjectId,
        'name' => $name,
        'username' => $username,
        'password' => $password
    ];

    try{
        $bulk->insert($user);
        include 'db.inc.php';
        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite($dbname, $bulk);
        session_start();
        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $username;
        header('Location: ../userlist.php');   
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>