<?php 
session_start();
if($_SESSION["loggedIn"] != true) {
   header('Location: error/accessdenied.html');
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
<a href="../views/newitem.php" class="btn btn-success btn-block">New Item</a>            
<a href="../user/logout.php" class="btn btn-danger btn-block">Logout</a>
<?php
    $id= $_SESSION['user'][0];
    // echo "<a href="edituser.php?id=".$id."' class="btn btn-info btn-block">Change password</a>";
    echo "<a class='btn btn-info btn-block' href='edituser.php?id=".$id."'>Change Password</a>";        

$id = $_GET['id'];
$filter = ['_id' => new MongoDB\BSON\ObjectId($id)];
$filterbid = ['itemid' => new MongoDB\BSON\ObjectId($id)];
$options = ['sort' => ['bidamt' => -1]];
try{
    include '../connect/db.inc.php';
    $query = new MongoDB\Driver\Query($filter);
    $querybid = new MongoDB\Driver\Query($filterbid, $options);

    $bids = $manager->executeQuery($dbbids, $querybid);

    $rows = $manager->executeQuery($dbitem, $query);
    echo "<table class='table'>
    <thead>
    <th>Date</th>
    <th>Time</th>
    <th>Bidder</th>
    <th>Bid Amount</th>
    </thead>";
    foreach($bids as $bid){
        echo "<tr>".
        "<td>".$bid->date."</td>".
        "<td>".$bid->time."</td>".
        "<td>".$bid->bidder."</td>".
        "<td>".$bid->bidamt."</td>".
        "</tr>";
    }
    echo "</table>";
    
    echo "<table class='table'>
    <thead>
    <th>Description</th>
    <th>Owner</th>
    <th>Closing date</th>
    <th>Action</th>
    </thead>";

    foreach($rows as $row){
        echo "<tr>".
        "<td>".$row->desc."</td>".
        "<td>".$row->owner."</td>".
        "<td>".$row->cdate."</td>".
        "<td>";
        if ($_SESSION["user"][1] == $row->owner){
            echo '<div class="alert alert-warning" role="alert">
            Owner cannot bid
          </div>';
}   else {
        echo "<form method='POST' action='../bids/newbid.php?id=".$row->_id."'>
        <input type='hidden' name='id' value='".$id."'>
        <input type='hidden' name='bidder' value='".$_SESSION["user"][1]."'>
        <div class='form-group'>
                    <label for='bid'>Your Bid</label>";
                    if (isset($_SESSION["message"]))
    {
        echo '<div class="alert alert-danger" role="alert">'
        .$_SESSION["message"].'</div>';
        unset($_SESSION["message"]);
    }           
        echo "<input type='number' name='bid' class='form-control' placeholder='Enter Amount'>
                </div>
                <button type='submit' class='btn btn-success btn-block'>Bid</button>
                </form></tr>";
    }
            }
    echo "</table>";
} catch(MongoDB\Driver\Exception\Exception $e){
    die("Error: ".$e);
}
?>    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>