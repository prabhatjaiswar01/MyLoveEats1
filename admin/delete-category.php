<?php
    // Include Constants File
    include('../config/constants.php');
    // echo "Delete Category";
    // Check weather the the id and image_name value is set ot not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the value and delete
        echo "GET Value and Delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        // if image is present in the category then Remove the physical image file that is avilable
        if($image_name != "")
        {
            // image is  avilable then remove it
            $path="../images/category/".$image_name;
            // Remove the image
            $rem=unlink($path);   // this function remove our file from the path
            
            // If failed to remove image then add and error message and stop the process
            if($rem==false)
            {
                // Set  the session message 
                $_SESSION['remove']='<div class="error">Failed to remove Category Image.</div>';
                // Redirect the to the manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // stop the process
                die();
            }

        }
        // Delete data from the database
        $sql="DELETE FROM tbl_category WHERE id=$id ";

        // Execute the query 
        $res=mysqli_query($conn,$sql);
        var_dump($res);

        //Check weather the data is delete from the database or not
        if($res==true)
        {
           // Set success message
           $_SESSION['delete']='<div class="success">Category Deleted Successfully.</div>'; 
            // redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        } 
        else
        {
           //Set failed the message
           $_SESSION['delete']='<div class="erroe">Failed To  Deleted Category.</div>'; 
            // redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }


        
        // Delete Data from the database
        // Redirect to the category page with the message
    }
    else
    {
        // Redirect to manage category page
        // we are redirecting the page due to if some user in like direct write delete-categroy so he is not able to delete any this
        //  he will redirect to the manage-category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    

?>