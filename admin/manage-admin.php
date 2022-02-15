
<?php include('partials/menu.php'); ?>


        <!-- Main section starts -->
        <div class="main-content">
            <div class="wapper">
                <h1>Admin manage</h1> 
                <br>
                <br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  //Display the session is added successfully 
                        unset($_SESSION['add']); // Removing the session is form the page after refresh
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];  //Display the session is deleted successfully 
                        unset($_SESSION['delete']); // Removing the session is form the page after refresh
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];  //Display the session is updated successfully 
                        unset($_SESSION['update']); // Removing the session is form the page after refresh
                    }
                    if(isset($_SESSION['User-not-found']))
                    {
                        echo $_SESSION['User-not-found'];  //Display the session is user not found  
                        unset($_SESSION['User-not-found']); // Removing the session is form the page after refresh
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];  //Display the session if new password and confirm password should not same 
                        unset($_SESSION['pwd-not-match']); // Removing the session is form the page after refresh
                    }
                    if(isset($_SESSION['changed-pwd']))
                    {
                        echo $_SESSION['changed-pwd'];  //Display the session if password got change or not 
                        unset($_SESSION['changed-pwd']); // Removing the session is form the page after refresh
                    }
                    
                ?>
                <br>
                <br>
                <!-- Button to add admin -->
                <a href="add-admin.php" class=btn-primary>Add Admin</a>
                <br>
                <br>
                <table class="table">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    // Query to get all admin 
                    $sql="SELECT * FROM tbl_admin";
                    // Execute the Query
                    $res=mysqli_query($conn,$sql);

                    // Check Wheather the Query is Executed or not
                    if($res==TRUE)
                    {
                        // Count Rows to check wheather we have data in database or not 
                        $count=mysqli_num_rows($res); //function to get all the rows of data base
                        // check the num of rows
                        if($count>0)
                        {
                            
                            $sn=1;// Creting the varibale for the number

                            
                            // We have data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                // Using while loop to get all the data from database
                                // While loop will execute as long as the data in data base

                                // Get individual  Data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $user_name=$rows['user_name'];
                                // Display the values in our Table
                                ?>
                                <!-- Html part for displaying the data -->
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $user_name; ?></td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class=btn-primary>Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class=btn-secondary>Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class=btn-danger>Delete Admin</a>
                         
                                    </td>
                                </tr>
                                <?php
                                
                            }
                        }
                        else
                        {
                            // We dont hava the data in database
                        }
                    }
                    ?>
                    
                </table>
                
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main section Ends -->

<?php include('partials/footer.php'); ?>
    

 