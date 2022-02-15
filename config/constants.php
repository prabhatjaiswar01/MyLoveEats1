<?php
    // start the session
    session_start();



    // Create constants To store non repating code
    define('SITEURL','http://localhost/MyLoveEats/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('PASSWORD','');
    define('DB_NAME','myloveeats');

    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,PASSWORD) or die(mysqli_error()); //database Connection
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //Selecting database
    
?>