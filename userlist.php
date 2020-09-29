<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="form.php" class="btn btn-success btn-block">New User</a>            
<br>
<?php
try{
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\DRiver\Query([]);

    $rows = $manager->executeQuery("phpbasics.test", $query);
    echo "<table class='table'>
    <thead>
    <th>Name</th>
    <th>Username</th>
    <th>Action</th>
    </thead>";

    foreach($rows as $row){
        echo "<tr>".
        "<td>".$row->name."</td>".
        "<td>".$row->username."</td>".
        "<td><a class= 'btn btn-info' href='edituser.php?
        id=".$row->_id."&name=".$row->name.
        "&username=".$row->username.
        "&password=".$row->password.
        "'>Edit</a> <a class='btn btn-danger' href='user/delete.php?id=".$row->_id."'>Delete</a></td>".
        "</tr>";
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
