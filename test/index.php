<?php
session_start();
?>
<link href="bootstrap.min.css" rel="stylesheet">

<?php 
  include("title.php");
  include("lib.php");
  noAccess();
?>
<div class="container">
 	<h1>Welcome to XXXXXXX Hospital's xxxxxxxxxx Website</h1>
    <p class="block-quote">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
    <p align="center"><img src="images/s1.jpg" class="img-responsive" width="100%" id="slider" align="center"></p>
  <?php 
    if(isset($_POST['lemail'])){
      $i = login($_POST['lemail'],$_POST['lpassword'],"users");
      if($i==1){
        echo '<script type="text/javascript"> window.location = "addPatient.php" </script>';
      }
    }else if(isset($_POST['remail'])){
      $i = register($_POST['remail'],$_POST['rpassword'],$_POST['rfullname'],"users");
      if($i==1){
        echo '<script type="text/javascript"> window.location = "addPatient.php"</script>';
      }
    }else{
      echo "<div class='alert alert-info'>
              <strong>Info!</strong> Login or Register to be able to book your appointment.</div>";
    }
    unset($_POST);
  ?>
<div class="row">
  <div class="col col-xl-6 col-sm-6">
      <h2>Login</h2>
      <form action="index.php" method="POST">
        <div class="form-group">
          <label for="usr">Email:</label>
          <input type="email" class="form-control" name="lemail" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" name="lpassword" required>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Login">
          <input type="reset" class="btn btn-danger">
        </div>
          
      </form>
</div>
          
<div class="col col-xl-6 col-sm-6" id="register1">
    <form method="post" action="index.php">
	    <h2>Registration</h2>
	      <div class="form-group">
	        <label for="usr">Full Name:</label>
	        <input type="text" class="form-control" name="rfullname" required>
	      </div>
        
        <div class="form-group">
	        <label for="usr">Email:</label>
	        <input type="email" class="form-control" name="remail" required>
	      </div>
	          
        <div class="form-group">
	        <label for="pwd">Password:</label>
	        <input type="password" class="form-control"  name="rpassword" required>
	      </div>

	      <div class="form-group">
	        <input type="submit" class="btn btn-primary">
	        <input type="reset" class="btn btn-danger"></button>
	      </div>
    </form>
  </div>
</div>
</div>
<div class="container footer">
      <hr>
      <footer>
        <p align="right">
        Made and managed by Team18 - 2018
        </nav>
		</p>
      </footer>
</div>