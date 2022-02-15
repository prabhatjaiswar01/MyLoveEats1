<?php
// include the Session.php for SITEURL
include("../config/constants.php");

// 1 Destory the session 
session_destroy();  //unsets$_SESSION['user'];

// 2.redirect to the login page
header('location:'.SITEURL.'admin/login.php');



?>