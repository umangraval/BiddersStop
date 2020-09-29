<form action="user/update.php" method="POST">
<input type="hidden" name="id" id="id"  value="<?php echo $_GET["id"]; ?>">
Name: <input type="text" name="name" id="name" value="<?php echo $_GET["name"]; ?>"> <br>
username: <input type="text" name="username" id="username" value="<?php echo $_GET["username"]; ?>"> <br>
password: <input type="password" name="pwd" id="pwd" value="<?php echo $_GET["password"]; ?>"> <br>
<input type="submit" value="Update">
</form>