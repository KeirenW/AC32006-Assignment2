<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

?>
<link href="bootstrap.min.css" rel="stylesheet">

<?php 
  include("title.php");
  include("lib.php");

  nopermitPatient();
  noPermitAdmin();
?>
<div class="container">
<h2>Apponitment information</h2>
<p>details</p>
<table class="table table-striped">
<?php

  if(isset($_GET['appointment_no'])){
    $appointment_no = $_GET['appointment_no'];
    $result = patientInformation($appointment_no);

  	$row = $result->fetch_array();
  
    echo "<tr>";   

    echo "<tr><th> Appointment No </th><td>". $row['appointment_no'] . "</td></tr>";
    echo "<tr><th> Full Name </th><td>" . $row['full_name'] . "</td></tr>";
    echo "<tr><th> Age (years) </th><td>" . $row['dob'] . "</td></tr>";

    echo "<tr><th> Weight </th><td>" . $row['weight'] . "</td></tr>";

    echo "<tr><th> Phone No </th><td>" . $row['phone_no'] . "</td></tr>";

    echo "<tr><th> Address </th><td>" . $row['address'] . "</td></tr>";

    echo "<tr><th> Medical Condition </th><td>" . $row['medical_condition'] . "</td></tr>";


    echo "</tr>";
  
  }
?>
</table>

</div>