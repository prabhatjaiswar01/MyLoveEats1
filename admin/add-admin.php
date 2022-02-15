<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  //Display the session is added successfully 
                        unset($_SESSION['add']); // Removing the session is form the page after refresh
                    }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
            
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" ></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="UserName"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php include('partials/footer.php'); ?>



<?php
    // process the value for the form  and save it into a database
    // Check the button is hit or not
    if(isset($_POST['submit']))
    {
        // Button Clicked
        // echo "Button Clicked";
        
        // Step 1 --Get the data from form
        $full_name=$_POST["full_name"];
        $username=$_POST["username"];
        $password=md5($_POST["password"]);  //md5 is for encrypt the password
        
        // Step 2 --Sql Query to Save the data
        $sql="INSERT INTO tbl_admin SET
            full_name='$full_name',
            user_name='$username',
            password='$password'        
        ";
        // step3:--  executing Query and saving data into database

        $res= mysqli_query($conn,$sql) or die(mysqli_error());
        //check wheather the data us inserted or not or querry is executed or not and display approratite message
        if ($res==TRUE)
        {
            // echo "Your Record inserted Sucesssully";
            // Create a session variable to display message\
            $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
            // Redirect page to manage admin again after add successfully new admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // echo "Your Record is not inserted Sucesssully";
            // echo "Your Record inserted Sucesssully";
            // Create a session variable to display message\
            $_SESSION['add']="<div class='error'>failed to Add admin Successfully</div>";
            // Redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    

?>