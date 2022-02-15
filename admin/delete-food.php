<?php
    //  Include constants 
    include('../config/constants.php');
    //  1 Check wheather the value is passes or not from the URl i.e id and image name
    if(isset($_GET['id']) && isset($_GET['image_name']))  
    {
        // Delete the things otherwise delete     
        // echo "Process to delete";

        // Step1--> GEt the id and image
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        // Step 2-->Remove the image if avilable
            // check wheather the image is avilable or not and delete only if the image is avilable
        if($image_name != "")
        {
            // It has image name and need to remove from folder
            // get the image path
            $path="../images/food/".$image_name;

            // remove image file form folder
            $remove=unlink($path);

            // check wheather the image is removed or not
            if($remove==false)
            {
                // failed to remove
                $_SESSION['upload']='<div class="error">Failed to remove Image File.</div>';
                // rediret to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the process of deleting the food
                die();
            }

        }
    
        // Step 3--> Delete the food fromt he database
        $sql="DELETE FROM tbl_food WHERE id=$id";
        // Execute the query
        $res=mysqli_query($conn,$sql);

        // check wheather  the query executed or not and se the session message respectively
        if($res==true)
        {
            // Food Deleted
            $_SESSION['delete']='<div class="success">Food Deleted Successfully..!</div>';
            // redirecting to the main page

            // echo "Successy fully delted the food";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // Failed to delete the food
            // Redirect to manage food with session message
            $_SESSION['delete']='<div class="error">Failed to delete food..!</div>';
            // echo "food not deleted yet";
            header('location:'.SITEURL.'admin/manage-food.php');

        }


    }
    else
    {
        // Redirect the page Manage food Page
        echo "redirect";
        $_SESSION['unauthorized']='<div class="error">Unauthorized Access.</div>';
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>