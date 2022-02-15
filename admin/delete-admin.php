<?php
    // Include Constant.php file here
    include("../config/constants.php");

// Step 1:-- Get the ID of admin to be deleted
  // echo $id=$_GET['id'];--------> With the help of this get method we are going to take the id of data from the database 

$id=$_GET['id'];     //This is a ID which is used for delete the particular user based on this id 



// step 2:-- Create Sql query to delete admin 
 $sql="DELETE FROM tbl_admin WHERE id=$id";
//  Execute the Query --
 $res=mysqli_query($conn,$sql);

//  Check Wheather the query Executed Successfully or not
if($res==TRUE)
{
    // Query Executed Successfully and admin Deleted
    // echo "Admin Deleted Successfully";
    // Create Session variable to Display message
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
    // Redirect to Our Magane admin page
    header("location:".SITEURL."admin/manage-admin.php");
}
else{
    // Field to delete admin
    // echo "Failed to Deleted Admin";
    $_SESSION['delete']="<div class='error'>Failed to Deleted Admin. Try Again Later..!</div>";
    header("location:".SITEURL."admin/manage-admin.php");


}
// step3:-- redirect to Manage Admin With Message (Success /Error)




?>