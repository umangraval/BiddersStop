<?php 
    session_start();
    if($_SESSION["loggedIn"] != true) {
    header('Location: /error/accessdenied.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BiddersStop</title>
    </head>
    <body>
        <?php
            include('../components/navbar.php');
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-5">
                    <h1 class="text-center">New Item</h1>
                    <?php
                        session_start();
                        if (isset($_SESSION['message']))
                        {
                            echo '<div class="alert alert-danger" role="alert">'
                            .$_SESSION['message'].'</div>';
                            unset($_SESSION['message']);
                        }
                    ?>
                    <form action="../items/additem.php" method="POST">
                        <input type="hidden" name="owner" id="id"  value="<?php echo $_SESSION["user"][1]; ?>">
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <input type="text"  name="desc" class="form-control" id="desc" value="<?php echo isset($_SESSION['form']) ? $_SESSION['form']['desc'] : '' ?>" placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label for="cdate">Closing Date</label>
                            <input type="date"  name="cdate" class="form-control" id="cdate" value="<?php echo isset($_SESSION['form']) ? $_SESSION['form']['cdate'] : '' ?>" placeholder="Enter closing date">
                        </div>
                        <?php
                            unset($_SESSION['form']);
                        ?>
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                        <a class="btn btn-primary btn-block" href="/itemlist.php" role="button">Back</a>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include('../components/footer.php');
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>
