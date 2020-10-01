<?php
session_start();
try{
    include 'db.inc.php';
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $filter = ['username' => $username];
    $query = new MongoDB\Driver\Query($filter);

    $rows = $manager->executeQuery($dbname, $query);
    $cursorArray = $rows->toArray();
    if(isset($cursorArray[0])) {
            if(password_verify($pwd, $cursorArray[0]->password)){
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["username"] = $username;
                    header('Location: ../userlist.php');
            } else {
                $_SESSION["message"] = "Wrong password";
                header('Location: ../loginuser.php');                
            } 
    } else {
        $_SESSION["message"] = "No User Found";
        header('Location: ../loginuser.php');
    }
} catch(MongoDB\Driver\Exception\Exception $e){
    die("Error: ".$e);
}
?>    