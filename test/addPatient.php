<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="jumbotron.css" rel="stylesheet">
<?php
  include("title.php");
  include("lib.php");
  noPermitAdmin();
  notLogIn();
  
?>
<div class="container">
  <h2>Welcome, <?php echo $_SESSION["fullname"];?>!</h2>
      <div class='alert alert-info'>
              <strong>Welcome to the part where we ask you for your information!</strong> Don't worry, we will not share it with anybody else - <? echo date("d/m/y"); ?>GODIVALABS. LABS OF THE FUTURE</div>
      <h3>Enter Your details</h3>
                <?php
                  if(isset($_POST['patientName'])){
                    $i = enterPatient($_POST['patientName'],$_POST['patientAge'],$_POST['patientWeight'],$_POST['phonenumber'],$_POST['patientAddress']);
                    appointmentBooking($i, $_POST['patientSpecialist'], $_POST['patientCondition']);
                    unset($_POST['patientName']);
                    if (isset($_POST['patientName'])){
                      echo '<script type="text/javascript">location.reload();</script>';
                    }
                  }
                ?>
            <form action="addPatient.php" method="POST">

            <div class="form-group" >
              <label for="usr">Full Name:</label>
              <input type="text" class="form-control" id="usr" name="patientName" required>
            </div>

            <div class="form-group">
              <label for="pwd">DoB</label>
              <input type="number" class="form-control" id="pwd" name="patientAge" min="1" max="200" required>
            </div>
            <div class="form-group">
              <label for="pwd">Phone number:</label>
              <input type="tel" class="form-control" id="pwd" name="phonenumber" required>
            </div>
            <div class="form-group">
              <label for="pwd">Postcode:</label>
              <textarea class="form-control" id="pwd" name="patientAddress" required></textarea>
            </div>
            <div class="form-group">
              <label for="pwd">Address:</label>
              <textarea class="form-control" id="pwd" name="patientAddress" required></textarea>
            </div>

            <div class="form-group">
              <label for="pwd">Test required</label>
              <select required value=1 name="patientSpecialist">
              <option value="HIV" class="option">HIV</option>
              <option value="HPV" class="option">HPV</option>
              <option value="FULL BLOOD COUNT" class="option">FUL BLOOD COUNT</option>
              <option value="CHOLESTEROL AND LIPID" class="option">CHOLESTEROL AND LIPID</option>
              <option value="CALCIUM" class="option">CALCIUM</option>
              <option value="HBA1C (DIABETES)" class="option">HBA1C (DIABETES)</option>
              <option value="CARDIAC ENZYMES" class="option">CARDIAC ENZYMES</option>

              </select>
            </div>

            <div class="form-group">
              <label for="pwd">Medical Condition:</label>
              <textarea class="form-control" id="pwd" name="patientCondition" required></textarea>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" >
              <input type="reset" name="" class="btn btn-danger">
            </div>
          </form>
</div>