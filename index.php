<?php
   include("db.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT email FROM patient WHERE email = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
        
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }

   //echo "<span style=\"color:white\">THIS  IS IAIN YOU HAVE BEEN HACKED. GIVE ME $864389764783 IN BITCOIN WITHIN 24 HOURS OR I WILL DELETE</span>";
?>

<html>
    <head>
        <title>GodivaLabs - Home</title>
        <link rel="stylesheet" type="text/css" href="./css/index.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <script src="./js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark sticky-top">
            <a class="navbar-brand mr-auto" href="#">
                <svg data-name="Layer 1" viewBox="0 0 155.42 221.05" xmlns="http://www.w3.org/2000/svg" stroke="white" fill="white" width="30" height="30"><path transform="translate(-47.29 -28.73)" d="M169.8,115.22a30,30,0,0,0-30-30h-8.18V73.95h-5.45V68.49h5.45V63H104.35v5.45h5.45v5.45h-5.45v38.54h5.45V123.4h16.36V112.49h5.45V101.58h8.18a13.64,13.64,0,1,1,0,27.27H98.9v5.45h16.36v5.45h-2.73A13.65,13.65,0,0,0,98.9,153.4v2.73H148V153.4a13.57,13.57,0,0,0-3.08-8.62A30,30,0,0,0,169.8,115.22ZM115.26,68.49h5.45v5.45h-5.45Zm5.45,49.45h-5.45v-5.45h5.45ZM126.17,107H109.8V79.4h16.36Zm-5.45,27.27h5.45v5.45h-5.45Zm-15.9,16.36a8.2,8.2,0,0,1,7.71-5.45h21.82a8.2,8.2,0,0,1,7.71,5.45Zm35-10.91h-8.18v-5.45h8.18a19.09,19.09,0,0,0,0-38.18h-8.18V90.67h8.18a24.54,24.54,0,0,1,0,49.09Z"/><path transform="translate(-47.29 -28.73)" d="M125,28.73A77.73,77.73,0,0,0,58.89,147.3l61.69,99.41a6.48,6.48,0,0,0,5.5,3.06h.05a6.47,6.47,0,0,0,5.5-3.15l60.12-100.37A77.73,77.73,0,0,0,125,28.73ZM180.64,139.6,126,230.86,69.9,140.48a64.8,64.8,0,1,1,110.74-.88Z"/>
</svg>
            </a>
            <a href="./login.php"><button class="btn btn-outline-light signInBtn" href="#">Sign in</button></a>
        </nav>

        <div class="spacer my-5"></div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 noLeftPadding">
                    <div class="jumbotron jumbotron-fluid col-md-8">
                        <div class="container">
                            <h1 class="display-4">Godivalabs</h1>
                            <p class="lead">The world leading expert in medical testing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>

        <div class="container testimonials">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <img class="rounded-circle headshot border border-light" src="./resources/AndreRene.jpg" width="130" height="130">
                    <h2>André René</h2>
                    <p>"Bearing in mind my medical history, I wanted to be taken care of by the best. That's why I chose Godivalabs!"</p>
                </div>
                <div class="col-lg-4 text-center">
                    <img class="rounded-circle headshot border border-light" src="./resources/BruceBanner.png" width="130" height="130">
                    <h2>Bruce Banner</h2>
                    <p>"As a medical professional I worked in a multitude of enviroments but none compares to how welcome and happy everyone feels here. Godivalabs is like my second family."</p>
                </div>
                <div class="col-lg-4 text-center">
                    <img class="rounded-circle headshot border border-light" style="object-fit:fit" src="./resources/GalGadot.jpg" width="130" height="130">
                    <h2>Gal Gadot</h2>
                    <p>"I love the staff-patient interaction, and the website is so easy to use. The experience is wonderful everytime!"</p>
                </div>
            </div>
        </div>


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