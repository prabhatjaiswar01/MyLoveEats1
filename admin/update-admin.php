<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wapper">
        <h1>Update Admin</h1>

        <br><br>
        <!-- Get the details of te current data that have we are currently  working-->
        <?php
            // Get the ID of Selected Admin
            $id=$_GET['id'];
            
            // Create Sql query for the upadte admin
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            
            // Execute the Query
            $res=mysqli_query($conn,$sql);
            
            //Check wheather the query is executed or not
            if($res==TRUE)
            {
                // Wheather the data is avilable or not
                $count=mysqli_num_rows($res);
                // Check Wheather we have admin data or not
                if($count==1)
                {
                    // Get the datails
                    echo "Admin Avilable";
                    $row=mysqli_fetch_assoc($res);
                    
                    // This is the values that we arw getting from the database now we are directly going to 
                    // put this values into the input tag of of its values 
                    $full_name=$row["full_name"];
                    $user_name=$row["user_name"];
                    
                }
                else
                {
                    // Redirect manage admin page
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            } 
        ?>

        <form action="" method="POST">
            <table class="tbl_30">
                <tr>
                    <td>FullName:</td>

                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="email" name="user_name" value="<?php echo $user_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name=submit value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php
    // Checked wheather submit button is working or not
    if(isset($_POST["submit"]))
    {
        // echo "Button Clicked";
        // get all the values from form to update
         $id=$_POST["id"];
         $full_name=$_POST["full_name"];
         $user_name=$_POST["user_name"];

        // Create a sql query to update the admin
        $sql="UPDATE tbl_admin SET
        full_name='$full_name',
        user_name='$user_name'
        WHERE id='$id'
        ";

        // Execute the Query 
        $res=mysqli_query($conn,$sql);
        // Check whether the query is successfully or not
        if($res==TRUE)
        {
            // Query Exected and admin Updated
            $_SESSION['update']="<div class='success'>Admin Updated Successfully</div>";
            // Ṛedirect to manage admin page
            header("location:".SITEURL."admin/manage-admin.php");
        }
        else
        {
            // Failed to Update the admin
            $_SESSION['update']="<div class='success'>Failed to Update the Admin</div>";
            // Ṛedirect to manage admin page
            header("location:".SITEURL."admin/manage-admin.php");

        }

    }
    else
    {
        // echo "Button is Not Clicked";
    }

?>


<?php include('partials/footer.php'); ?>