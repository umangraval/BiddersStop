<?php 
session_start();
if($_SESSION["loggedIn"] != true) {
   header('Location: /error/accessdenied.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include('../components/navbar.php');
?>
<div class="container">
        <div class="row justify-content-center">
        <div class="col-md-8 mt-3 text-center">
<!-- <a href="../views/newitem.php" class="btn btn-success btn-block">New Item</a>             -->
<!-- <a href="../user/logout.php" class="btn btn-danger btn-block">Logout</a> -->
<br>
<?php
date_default_timezone_set("Asia/Kolkata");
$owner = $_SESSION['user'][1];
$filter = ['owner' => $owner];
$options = ['sort' => ['cdate' => -1]];   
try{
    include '../connect/db.inc.php';
    $query = new MongoDB\Driver\Query($filter, $options);

    $rows = $manager->executeQuery($dbitem, $query);
    echo "<table class='table table-hover'>
    <thead class='thead-dark'>
    <th>Description</th>
    <th>Closing date</th>
    <th>Action</th>
    </thead>";

    foreach($rows as $row){
        echo "<tr>".
        "<td>".$row->desc."</td>";
        $datetime = $row->cdate->toDateTime();
        $time=$datetime->format(DATE_RSS);
        $dateInUTC=$time;
        $time = strtotime($dateInUTC.' UTC');
        $dateInLocal = date("Y-m-d", $time);
        echo "<td>".$dateInLocal."</td>".
        "<td><a class='btn btn-danger' href='../items/deleteitem.php?id=".$row->_id."'>Delete</a></td>".
        "</tr>";
    }
    echo "</table>";
} catch(MongoDB\Driver\Exception\Exception $e){
    die("Error: ".$e);
}
?>  
</div>
</div>
</div>  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>