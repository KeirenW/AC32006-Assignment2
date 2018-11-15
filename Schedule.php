<?php
    include("db.php");
    session_start();

    $user = $_SESSION["login_user"];
    
?>



<html>
    <head>
        <title>GodivaLabs - Tests</title>
        <link rel="stylesheet" type="text/css" href="./css/appointment.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="./js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark sticky-top">
                <a class="navbar-brand" href="#"><svg data-name="Layer 1" viewBox="0 0 155.42 221.05" xmlns="http://www.w3.org/2000/svg" stroke="white" fill="white" width="40" height="40"><path transform="translate(-47.29 -28.73)" d="M169.8,115.22a30,30,0,0,0-30-30h-8.18V73.95h-5.45V68.49h5.45V63H104.35v5.45h5.45v5.45h-5.45v38.54h5.45V123.4h16.36V112.49h5.45V101.58h8.18a13.64,13.64,0,1,1,0,27.27H98.9v5.45h16.36v5.45h-2.73A13.65,13.65,0,0,0,98.9,153.4v2.73H148V153.4a13.57,13.57,0,0,0-3.08-8.62A30,30,0,0,0,169.8,115.22ZM115.26,68.49h5.45v5.45h-5.45Zm5.45,49.45h-5.45v-5.45h5.45ZM126.17,107H109.8V79.4h16.36Zm-5.45,27.27h5.45v5.45h-5.45Zm-15.9,16.36a8.2,8.2,0,0,1,7.71-5.45h21.82a8.2,8.2,0,0,1,7.71,5.45Zm35-10.91h-8.18v-5.45h8.18a19.09,19.09,0,0,0,0-38.18h-8.18V90.67h8.18a24.54,24.54,0,0,1,0,49.09Z"/><path transform="translate(-47.29 -28.73)" d="M125,28.73A77.73,77.73,0,0,0,58.89,147.3l61.69,99.41a6.48,6.48,0,0,0,5.5,3.06h.05a6.47,6.47,0,0,0,5.5-3.15l60.12-100.37A77.73,77.73,0,0,0,125,28.73ZM180.64,139.6,126,230.86,69.9,140.48a64.8,64.8,0,1,1,110.74-.88Z"/></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="material-icons">local_hospital</i>
                                <p>Tests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="material-icons">mail</i>
                                <p>Results</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="material-icons">question_answer</i>
                                <p>Queries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="history.php">
                                <i class="material-icons">folder</i>
                                <p>My Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="material-icons">list</i>
                                <p>Prescriptions</p>
                            </a>
                        </li>
                    </ul>
                    <a href="LogOut.php"><button class="btn btn-outline-warning my-2 my-sm-0" href="#">Sign out</button></a>
                </div>
            </nav>
        </header>

        <!-- Get schedule from DB -->




        <main role="main" class="container-fluid">
            <div class="row">
                <div class="col-md-9 pane-left">
                    <!-- List appointment -->
                        <tbody>
                            <?php
                            
                                if(isset($_GET['StaffID']))
                                {  
                                    if(isset($_GET['Datetime']))
                                    {  
                                        $StaffID = $_GET['StaffID'];
                                        $Datetime = $_GET['Datetime'];
                                        $sql = "SELECT AppointmentNumber,StaffID,PatientID,RoomNumber,Datetime,TestCode,Symptoms,FollowUp,Appointmentcol FROM appointment where $StaffID = appointment.StaffID and $Datetime = appointment.Datetime";
                                        $result = mysqli_query($db,$sql);
                                        while($row = $result->fetch_assoc()) {
                                            echo "<dl>";
                                            echo "<dt>"."Appointment:".$row['AppointmentNumber']."</dt>";
                                            echo "<li>"."StaffID:".$row['StaffID']."</li>";
                                            echo "<li>"."PatientID:".$row['PatientID']."</li>";
                                            echo "<li>"."RoomNumber:".$row['RoomNumber']."</li>";
                                            echo "<li>"."Datetime:".$row['Datetime']."</li>";
                                            echo "<li>"."TestCode:".$row['TestCode']."</li>";
                                            echo "<li>"."Symptoms:".$row['Symptoms']."</li>";
                                            echo "<li>"."FollowUp:".$row['FollowUp']."</li>";
                                            echo "<li>"."Appointmentcol:".$row['Appointmentcol']."</li>";
                                            echo "</dl>";
                                        }
                                    }else{
                                        $StaffID = $_GET['StaffID'];
                                        $sql = "SELECT AppointmentNumber, StaffID, PatientID,RoomNumber,Datetime,TestCode,Symptoms,FollowUp,Appointmentcol FROM appointment where $StaffID = appointment.StaffID";
                                        $result = mysqli_query($db,$sql);
                                        while($row = $result->fetch_assoc()){
                                            echo "<dl>";
                                            echo "<dt>"."Appointment:".$row['AppointmentNumber']."</dt>";
                                            echo "<li>"."StaffID:".$row['StaffID']."</li>";
                                            echo "<li>"."PatientID:".$row['PatientID']."</li>";
                                            echo "<li>"."RoomNumber:".$row['RoomNumber']."</li>";
                                            echo "<li>"."Datetime:".$row['Datetime']."</li>";
                                            echo "<li>"."TestCode:".$row['TestCode']."</li>";
                                            echo "<li>"."Symptoms:".$row['Symptoms']."</li>";
                                            echo "<li>"."FollowUp:".$row['FollowUp']."</li>";
                                            echo "<li>"."Appointmentcol:".$row['Appointmentcol']."</li>";
                                            echo "</dl>";
                                        }
                                    }
                                }
                                    else{
                                        header("Location: https://zeno.computing.dundee.ac.uk/2018-ac32006/Team18/LogOut.php"); 
                                        exit;
                                    }
                        
                            ?>
                        </tbody>
  
                </div>
                

                <!-- Get user details from DB -->
                <?php
                    $sql = "SELECT Name,DoB,PhoneNumber,Email FROM patient WHERE Email = '$user'";
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                ?>
                <div class="col-md-3 pane-right text-center">
                    <h1 class="mt-5">My details</h1>
                    <ul class="list-unstyled patient">
                        <li><i class="material-icons">account_circle</i><?php echo $row["Name"] ?></li>
                        <li><i class="material-icons">cake</i><?php echo $row["DoB"] ?></li>
                        <li><i class="material-icons">phone</i><?php echo $row["PhoneNumber"] ?></li>
                        <li><i class="material-icons">email</i><?php echo $row["Email"] ?></li>
                    </ul>

                </div>
            </div>
        </main>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <span class="text-muted text-left col-md-6">Godivalabs</span>
                    <span class="text-muted text-right col-md-6">AC32006 - Assignment 2 - Team 18</span>
                </div>
            </div>
        </footer>
    </body>
</html>