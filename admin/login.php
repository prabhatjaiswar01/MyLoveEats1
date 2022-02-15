<?php
    include('../config/constants.php');
?>
<html>
    <head>
        <title>Login MyLoveEats</title>
        <link rel="stylesheet" href="../css/admin_1.css?v=<?php echo time(); ?>">
    </head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            
        ?>
        
        <!-- Form starts here -->
        <form action="" method="POST" class="text-center">
            <br><br>
            Username:
            <input type="text" name="username" placeholder="Enter Your username">
            <br>
            <br>
            Password:
            <input type="password" name="password" placeholder="Enter Your password">
            <br>
            <br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Form End here -->

        <p class="text-center">Created By - <a href="www.MYLoveEats.com">Prabhat Jaiswar</a></p>
    </div>

</body>

</html>
<!-- Check Wheather the Button is clicked or not -->
<?php
if(isset($_POST['submit']))
{
    // echo "Button Clicked";
    // Process the Login
    // Step1:-- Get the data from the form
    $username=$_POST["username"];
    $password=md5($_POST["password"]);

    // step2:--To check wheather the user with username and password exist or not
    $sql="SELECT * FROM tbl_admin WHERE user_name='$username' AND  password='$password' ";

    // step 3:Execute the query
    $res=mysqli_query($conn,$sql);
            // here result return true if teh query is exeuted successfully

    // step 4:--Count rows to check wheather the user exist or not
    $count=mysqli_num_rows($res);
    echo $count;
    if($count==1)
    {
        // User Avilable
        $_SESSION['login']='<div class="success text-center">LOGIN SUCCESS</div>';
        $_SESSION['user']=$username;  //To check weather the user is in or not and logout will unset it
        // After login Success Redirect to Home page or dashboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        // User not avilable
        $_SESSION['login']='<div class="error  text-center">LOGIN FAILED..!</div>';
        // After login Success Redirect to Home page or dashboard
        header('location:'.SITEURL.'admin/login.php');
    }



}
else
{
    // echo "Button is not clicked";
}

?>