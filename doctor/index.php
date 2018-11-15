<?php
    session_start();
    $userType = $_SESSION["user_type"];
    echo $userType;  
    echo "Hello";

?>