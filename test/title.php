<p align="right">
<?php
    if (!isset($_SESSION)) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> Godivalabs
    </title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="jumbotron.css" rel="stylesheet">
  </head>
  <body>
  <?php
                if (!isset($_SESSION['username'])) {
                    echo '<a class="nav-link" href="staff.php">Staff Login</a>
                  </li>';
                }
        ?>
      <div class="container" style="padding-top: 10px;">
              <?php
                if (isset($_SESSION['username'])) {
                    echo '<li class="nav-item" style="align-items: right;"> <a class="nav-link" href="logout.php">Logout</a>
                  </li>';
                }
              ?>
</div>