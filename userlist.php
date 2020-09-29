<a href="form.php">Craete New User</a>
<br>
<?php
try{
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\DRiver\Query([]);

    $rows = $manager->executeQuery("phpbasics.test", $query);
    echo "<table>
    <thead>
    <th>Name</th>
    <th>Username</th>
    <th>Action</th>
    </thead>";

    foreach($rows as $row){
        echo "<tr>".
        "<td>".$row->name."</td>".
        "<td>".$row->username."</td>".
        "<td><a href='edituser.php?
        id=".$row->_id."&name=".$row->name.
        "&username=".$row->username.
        "&password=".$row->password.
        "'>Edit</a> | <a href='user/delete.php?id=".$row->_id."'>Delete</a></td>".
        "</tr>";
    }
    echo "</table>";
} catch(MongoDB\Driver\Exception\Exception $e){
    die("Error: ".$e);
}
?>