<?php
    if (!isset($_SESSION)) {
        session_start();
    }
?>

<?php
  include("title.php");
  include("lib.php");
  nopermitPatient();
  noPermitstaff();
  noPermitAdmin();
?>
<div class = 'container'>
<h2>Upcomming Appointments</h2>
<p>Click on the the field to fill additional information</p>

<table class='table table-striped text-center '>
  <thead class="thead-inverse">
				<tr>
				<th><center>Appointment No</center></th>
				<th><center>Patient's Full Name</center></th>
				<th><center>Medical Condition</center></th>
				</tr>
	</thead>
<?php
    $result = getAllAppointments();

    while ($row = $result->fetch_array()) {
       

        $link = "<td ><a href= 'update_info.php?appointment_no=".$row['appointment_no']."'>";
        $endingTag = '</a></td>';
        echo "$link".$row['appointment_no']."$endingTag";
        echo "$link".$row['full_name']."$endingTag";
        echo "$link".$row['medical_condition']."$endingTag";
        echo '</tr>';
    }
?>
</table>
</div>