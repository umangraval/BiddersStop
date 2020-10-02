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
        <div class="col-md-6 mt-5">
        <h1 class="text-center">Change Password</h1>
        <?php
            if (isset($_SESSION['message']))
            {
                echo '<div class="alert alert-danger" role="alert">'
                .$_SESSION['message'].'</div>';
                unset($_SESSION['message']);
            } else if (isset($_SESSION['smessage'])) {
                echo '<div class="alert alert-success" role="alert">'
                .$_SESSION['smessage'].'</div>';
                unset($_SESSION['smessage']);
            }
        ?>
            <form action="/user/update.php" method="POST">
            <input type="hidden" name="id" id="id"  value="<?php echo $_SESSION['user'][0]; ?>">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text"  name="pwd" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password"  name="cpwd" class="form-control" id="cpwd">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
