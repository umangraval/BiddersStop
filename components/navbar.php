<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand ml-5" href="#">BiddersStop</a>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav ml-auto">';
    if($_SESSION["loggedIn"] == true) {
        echo '<li class="nav-item active px-md-3">
        <a class="nav-link" href="/views/allitems.php">Items<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active px-md-3">
      <a class="nav-link" href="/views/userlist.php">User List<span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item active px-md-3">
    <a class="nav-link" href="/views/itemlist.php">My Items<span class="sr-only">(current)</span></a>
  </li>
    <li class="nav-item active px-md-3">
        <a class="nav-link" href="/views/pwdchange.php?id="'.$_SESSION['user'][0].'">Change Pwd<span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item active ml-3 mr-5">
        <a class="nav-link" href="/user/logout.php">Logout<span class="sr-only">(current)</span></a>
      </li>';
    } else {
        echo '<li class="nav-item active px-md-3">
        <a class="nav-link" href="#">Login <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active px-md-5">
      <a class="nav-link" href="#">Signup<span class="sr-only">(current)</span></a>
    </li>';
    }
  echo '</ul>
</div>
</nav>';

?>