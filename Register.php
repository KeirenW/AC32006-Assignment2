<?php
    include("db.php");
    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
      
        $myEmail = mysqli_real_escape_string($db,$_POST['username']);
        $myName = mysqli_real_escape_string($db,$_POST['name']);
        $myPassword = mysqli_real_escape_string($db,$_POST['password']);
        $myDoB = mysqli_real_escape_string($db,$_POST['DoB']);
        $myAddress = mysqli_real_escape_string($db,$_POST['Address']);
        $myPostCode = mysqli_real_escape_string($db,$_POST['PostCode']);
        $myPhoneNumber = mysqli_real_escape_string($db,$_POST['PhoneNumber']);
        $myGender = mysqli_real_escape_string($db,$_POST['gender']);
        $myOccupation = mysqli_real_escape_string($db,$_POST['Occupation']);
        $myMedialHistory = mysqli_real_escape_string($db,$_POST['MedicalHistory']);
        $myHasInsurance = mysqli_real_escape_string($db,$_POST['HasInsurance']);
        $mySmoker = mysqli_real_escape_string($db,$_POST['Smoker']);
        $myID = rand();
        
        $sql = "INSERT INTO patient (PatientID, Name, DoB, AddressLine1, Postcode, PhoneNumber, Email, Gender, Occupation, MedicalHistory, Smoker, HasInsurance, Password )
        VALUES ('$myID', '$myName', '$myDoB', '$myAddress', '$myPostCode', '$myPhoneNumber', '$myEmail', '$myGender', '$myOccupation', '$myMedialHistory', '$mySmoker', '$myHasInsurance', '$myPassword')";
        
        if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
            $_SESSION["login_user"] = $myemail;
            header("location:index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
        
        $db->close();        
    }
?>

<html>
    <head>
        <title>GodivaLabs - Register</title>
        <link rel="icon" href="./resources/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="./css/register.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <script src="./js/bootstrap.min.js"></script>

    </head>
    <body class="text-center">
        <nav class="navbar navbar-expand-md navbar-dark sticky-top">
            <a class="navbar-brand mr-auto" href="index.php">
                <svg data-name="Layer 1" viewBox="0 0 155.42 221.05" xmlns="http://www.w3.org/2000/svg" stroke="white" fill="white" width="30" height="30"><path transform="translate(-47.29 -28.73)" d="M169.8,115.22a30,30,0,0,0-30-30h-8.18V73.95h-5.45V68.49h5.45V63H104.35v5.45h5.45v5.45h-5.45v38.54h5.45V123.4h16.36V112.49h5.45V101.58h8.18a13.64,13.64,0,1,1,0,27.27H98.9v5.45h16.36v5.45h-2.73A13.65,13.65,0,0,0,98.9,153.4v2.73H148V153.4a13.57,13.57,0,0,0-3.08-8.62A30,30,0,0,0,169.8,115.22ZM115.26,68.49h5.45v5.45h-5.45Zm5.45,49.45h-5.45v-5.45h5.45ZM126.17,107H109.8V79.4h16.36Zm-5.45,27.27h5.45v5.45h-5.45Zm-15.9,16.36a8.2,8.2,0,0,1,7.71-5.45h21.82a8.2,8.2,0,0,1,7.71,5.45Zm35-10.91h-8.18v-5.45h8.18a19.09,19.09,0,0,0,0-38.18h-8.18V90.67h8.18a24.54,24.54,0,0,1,0,49.09Z"/><path transform="translate(-47.29 -28.73)" d="M125,28.73A77.73,77.73,0,0,0,58.89,147.3l61.69,99.41a6.48,6.48,0,0,0,5.5,3.06h.05a6.47,6.47,0,0,0,5.5-3.15l60.12-100.37A77.73,77.73,0,0,0,125,28.73ZM180.64,139.6,126,230.86,69.9,140.48a64.8,64.8,0,1,1,110.74-.88Z"/>
</svg>
            </a>
            <a href="index.php"><button class="btn btn-outline-light signInBtn" href="index.php">Back to home</button></a>
        </nav>

        <form class="form-register" method="post" action="">
            <img class="mb-4" src="./resources/logo.svg" alt="" width="100" height="100">
            <h1 class="h3 mb-3 font-weight-normal">Godivalabs</h1>
            <label for="inputName" class="sr-only">Name</label>
            <input type="name" id="inputName" name="name" class="form-control" placeholder="Name" required="" autofocus="">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="username" class="form-control" placeholder="Email address" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name ="password" class="form-control" placeholder="Password" required="">
            <label for="inputDoB" class="sr-only">Date of Birth</label>
            <input type="date" id="inputDoB" name ="DoB" class="form-control" placeholder="DoB" required="">
            <label for="inputAddress" class="sr-only">Address</label>
            <input type="text" id="inputAddress" name ="Address" class="form-control" placeholder="Address" required="">
            <label for="inputPostCode" class="sr-only">Post Code</label>
            <input type="text" id="inputPostCode" name ="PostCode" class="form-control" placeholder="PostCode" required="">
            <label for="inputPhoneNumber" class="sr-only">Phone Number</label>
            <input type="text" id="inputPhoneNumber" name ="PhoneNumber" class="form-control" placeholder="PhoneNumber" required="">
            <label for="Gender" class="sr-only">Gender</label>
            <input type="radio" name="gender" value="male" checked> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <label for="Occupation" class="sr-only">Occupation</label>
            <input type="text" id="inputOccupation" name ="Occupation" class="form-control" placeholder="Occupation" required="">
            <label for="inputMedicalHistory" class="sr-only">Medical History</label>
            <input type="text" id="inputMedicalHistory" name ="MedicalHistory" class="form-control" placeholder="MedicalHistory" required="">
            <label for="inputSmoker">Do you smoke?</label>
            <select class="form-control" id="inputSmoker" name="Smoker" required="">
                <option selected>No</option>
                <option>Yes</option>
            </select>
            <label for="inputHasInsurance">Do you have insurance?</label>
            <select class="form-control" id="inputHasInsurance" name="HasInsurance" required="">
                <option selected>No</option>
                <option>Yes</option>
            </select>

            <label><a href="index.php" class="text-muted">Already have an account?</a></label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>

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