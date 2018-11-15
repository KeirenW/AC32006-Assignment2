<?php
    include("db.php");
    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
      
        $myEmail = mysqli_real_escape_string($db,$_POST['username']);
        $myPassword = mysqli_real_escape_string($db,$_POST['password']); 
      
        $sqlP = "SELECT email FROM patient WHERE email = '$myEmail' and password = '$myPassword'";
        $sqlD = "SELECT email FROM staff WHERE email = '$myEmail' and password = '$myPassword'";
        $resultP = mysqli_query($db,$sqlP);
        $resultD = mysqli_query($db,$sqlD);
        $rowP = mysqli_fetch_array($resultP,MYSQLI_ASSOC);
        $rowD = mysqli_fetch_array($resultD,MYSQLI_ASSOC);
      
        $countP = mysqli_num_rows($resultP);
        $countD = mysqli_num_rows($resultD);
      
        // If result matched $myusername and $mypassword, table row must be 1 row
        //$cookie_name = "email";
        if($countP == 1) {
            $_SESSION["login_user"] = $myEmail;
            //echo $_SESSION["login_user"];
            header("location:appointment.php");
            exit;
            //Logged in as patient and redirect to home page.
        } else if($countD == 1) {
            $_SESSION["login_user"] = $myEmail;
            header("location:appointment.php");
            exit;
            //Logged in as staff and redirect to staff home page.
        } else {
            $error = "Your email or password is inavlid!";
        }
    }
?>

<html>
    <head>
        <title>GodivaLabs - Log In</title>
        <link rel="stylesheet" type="text/css" href="./css/login.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <script src="./js/bootstrap.min.js"></script>

    </head>
    <body class="text-center">
        <nav class="navbar navbar-expand-md navbar-dark sticky-top">
            <a class="navbar-brand mr-auto" href="./index.php">
                <svg data-name="Layer 1" viewBox="0 0 155.42 221.05" xmlns="http://www.w3.org/2000/svg" stroke="white" fill="white" width="30" height="30"><path transform="translate(-47.29 -28.73)" d="M169.8,115.22a30,30,0,0,0-30-30h-8.18V73.95h-5.45V68.49h5.45V63H104.35v5.45h5.45v5.45h-5.45v38.54h5.45V123.4h16.36V112.49h5.45V101.58h8.18a13.64,13.64,0,1,1,0,27.27H98.9v5.45h16.36v5.45h-2.73A13.65,13.65,0,0,0,98.9,153.4v2.73H148V153.4a13.57,13.57,0,0,0-3.08-8.62A30,30,0,0,0,169.8,115.22ZM115.26,68.49h5.45v5.45h-5.45Zm5.45,49.45h-5.45v-5.45h5.45ZM126.17,107H109.8V79.4h16.36Zm-5.45,27.27h5.45v5.45h-5.45Zm-15.9,16.36a8.2,8.2,0,0,1,7.71-5.45h21.82a8.2,8.2,0,0,1,7.71,5.45Zm35-10.91h-8.18v-5.45h8.18a19.09,19.09,0,0,0,0-38.18h-8.18V90.67h8.18a24.54,24.54,0,0,1,0,49.09Z"/><path transform="translate(-47.29 -28.73)" d="M125,28.73A77.73,77.73,0,0,0,58.89,147.3l61.69,99.41a6.48,6.48,0,0,0,5.5,3.06h.05a6.47,6.47,0,0,0,5.5-3.15l60.12-100.37A77.73,77.73,0,0,0,125,28.73ZM180.64,139.6,126,230.86,69.9,140.48a64.8,64.8,0,1,1,110.74-.88Z"/>
</svg>
            </a>
            <a href="./index.php"><button class="btn btn-outline-light signInBtn" href="./index.php">Back to home</button></a>
        </nav>

        <form class="form-signin" method="post" action="">
            <img class="mb-4" src="./resources/logo.svg" alt="" width="100" height="100">
            <h1 class="h3 mb-3 font-weight-normal">Godivalabs</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="username" class="form-control" placeholder="Email address" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name ="password" class="form-control" placeholder="Password" required="">
            <div class="checkbox mb-3">
                <label><a href="Register.php" class="text-muted">Don't have an account?</a></label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <label class="error text-danger">Your username and/or password was invalid</label>
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