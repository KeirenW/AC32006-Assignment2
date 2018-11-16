<?php
    include("../db.php");
    session_start();
    $user = $_SESSION["login_user"];
    $userType = $_SESSION["user_type"];
    if($userType != "Doctor") {
        header("location:../LogOut.php");
    }

    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($db,$_POST['name']);
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $address = mysqli_real_escape_string($db,$_POST['address']);
        $postcode = mysqli_real_escape_string($db,$_POST['postcode']);
        $phone = mysqli_real_escape_string($db,$_POST['phone']);
        $job = mysqli_real_escape_string($db,$_POST['job']);
        $insurance = mysqli_real_escape_string($db,$_POST['insurance']);
        $gender = mysqli_real_escape_string($db,$_POST['gender']);
        $smoker = mysqli_real_escape_string($db,$_POST['smoker']);

        if($insurance == "Yes") {$insurance = "1";} else {$insurance = "0";}
        if($gender == "Male") {$gender = "1";} else {$gender = "0";}
        if($smoker == "Yes") {$smoker = "1";} else {$smoker = "0";}

        $sql = $db->query("UPDATE patient SET Name='$name',Password='$password',Email='$email',AddressLine1='$address',Postcode='$postcode',PhoneNumber='$phone',Occupation='$job',HasInsurance='$insurance',Gender='$gender',Smoker='$smoker' WHERE Email='$user'");
    }
?>

<html>
    <head>
        <title>GodivaLabs - My Details</title>
        <link rel="icon" href="./resources/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="../css/details.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="../js/bootstrap.min.js"></script>
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
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">
                                    <i class="material-icons">calendar_today</i>
                                    <p>Schedule</p>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="mydetails.php">
                                    <i class="material-icons">local_hospital</i>
                                    <p>Details</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="patientInfo.php">
                                    <i class="material-icons">supervisor_account</i>
                                    <p>Patients</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="prescriptions.php">
                                    <i class="material-icons">list</i>
                                    <p>Prescriptions</p>
                                </a>
                            </li>
                        </ul>
                    <a href="../LogOut.php"><button class="btn btn-outline-warning my-2 my-sm-0" href="#">Sign out</button></a>
                </div>
            </nav>
        </header>

        <!-- Get details from DB -->
        <?php
            $sql = "SELECT * FROM staff WHERE email = '$user'";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        ?>

        <main role="main">
            <div class="container">
                <form class="text-center form-update" method="post">
                    <img class="mb-4" src="../resources/logo.svg" alt="" width="100" height="100">
                    <h1 class="h3 mb-3 font-weight-normal">Godivalabs</h1>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <?php echo "<input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" value='" . $row["Name"] . "'>"; ?>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="password">Password</label>
                            <?php echo "<input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" value='" . $row["Password"] . "'>"; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="postcode">Email</label>
                            <?php echo "<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" value='" . $row["Email"] . "'>"; ?>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="phone">Address</label>
                            <?php echo "<input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\" value='" . $row["AddressLine1"] . "'>"; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="postcode">Postcode</label>
                            <?php echo "<input type=\"text\" class=\"form-control\" id=\"postcode\" name=\"postcode\" value='" . $row["Postcode"] . "'>"; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number</label>
                            <?php echo "<input type=\"tel\" class=\"form-control\" id=\"phone\" name=\"phone\" value='" . $row["PhoneNumber"] . "'>"; ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="job">Occupation</label>
                            <?php echo "<input type=\"text\" class=\"form-control\" id=\"job\" name=\"job\" value='" . $row["JobTitle"] . "'>"; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select class="custom-select" id="gender" name="gender">
                                <?php
                                    if($row["Gender"] == "Male") {
                                        echo "<option selected>Male</option>";
                                        echo "<option>Female</option>";
                                    } else {
                                        echo "<option selected>Female</option>";
                                        echo "<option>Male</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="salary">Salary</label>
                            <?php echo "<input type=\"text\" class=\"form-control\" id=\"salary\" name=\"salary\" value='" . $row["Salary"] . "'>"; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
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