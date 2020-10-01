<?php
try{
    session_start();
    unset($_SESSION["loggedIn"]);
    unset($_SESSION["username"]);
    header('Location: ../loginuser.php');
} catch(MongoDB\Driver\Exception\Exception $e){
    die("Error: ".$e);
}
?>    
