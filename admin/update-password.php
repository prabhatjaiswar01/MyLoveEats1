<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wapper">
        <h1>Change password</h1>
        <br> <br>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        } 
        ?>
        <form action="" method="POST">
            <table class="tbl_30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
        // check wheather the button is working or not
        if(isset($_POST["submit"]))
        {
            // echo "Button Clicked";
            // step1 :-- to get the data  from form
            $id=$_POST['id'];
            $current_password=md5($_POST['current_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);
            // step2 :-- Check wheather the user is current id or password exist or not
            $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";
            // Execute the Query
            $res=mysqli_query($conn,$sql);
            if($res==TRUE)
            {
                // Check wheather data is avilable or not
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    // User Exist and password can be change
                    // echo "User Found";
                    // Check Wheather the new password and confirm password is matched or not
                    if($new_password==$confirm_password)
                    {
                        // upadte the password
                        // echo "password matched";
                        $sql2="UPDATE tbl_admin SET
                         password='$new_password'
                         WHERE id=$id
                        ";
                        // Execute the Query
                        $res2=mysqli_query($conn,$sql2);
                        // Check wheather the query is execute successfully or not
                        if($res2==TRUE)
                        {
                            // Display message 
                            // Redirect to the manage page 
                            $_SESSION['changed-pwd']="<div class='success'>Your Password is Changed Successfully</div>";
                            // redirect the user
                            header("location:".SITEURL."admin/manage-admin.php");
                        }
                        else
                        {
                            // Display error message
                            // Redirect to the manage page 
                            $_SESSION['changed-pwd']="<div class='error'>Your password is not Changed!</div>";
                            // redirect the user
                            header("location:".SITEURL."admin/manage-admin.php");
                        }

                    }
                    else
                    {
                        //if newpassword and confirm password is not same
                        // Redirect to the manage page 
                        $_SESSION['pwd-not-match']="<div class='error'>Your new password and Confirm Password should be same..!</div>";
                        // redirect the user
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                }
                else
                {
                    // echo "user not found";
                    // User Does not Exist
                    $_SESSION['User-not-found']="<div class='error'>User Not Found</div>";
                    // redirect the user
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
            // Check wheather New password and confirm password match or not
            // Change password if all above is true

        }
        else
        {
            // echo "Button is not clicked";
        }
?>

<?php include('partials/footer.php');?>