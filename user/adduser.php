<!-- <a href="../userlist.php">View User</a> -->
<!-- <br> -->
<?php
    session_start();
    include 'db.inc.php';
    $bulk = new MongoDB\Driver\BulkWrite;
    $name = $_POST["name"];
    $username = $_POST["username"];
    $filter = ['username' => $username];
    $query = new MongoDB\Driver\Query($filter);

    $rows = $manager->executeQuery($dbname, $query);
    $cursorArray = $rows->toArray();
    if(isset($cursorArray[0])) {
        $_SESSION["message"] = "Username Exist";
        $_SESSION["form"] = $_POST;
        header('Location: ../register.php');
        exit();
    }
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
        // include 'db.inc.php';
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