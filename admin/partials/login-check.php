<?php
    // Authorization--Access Control
    // Check wheather the user is logged in or not ---

    // This will work on each page if the user is not set then it will redirect to the login page 
    // for login details that we done here is Authentaction

    if(!isset($_SESSION['user'])) //if user session is not set 
    {
        // if user is not logged in
        // Redirect to the login page
        $_SESSION['no-login-message']='<div class="error text-center">Please login to access Admin Panel.</div>';
        // Redirect to login page
        header('location:'.SITEURL.'admin/login.php');



    }
    

?>