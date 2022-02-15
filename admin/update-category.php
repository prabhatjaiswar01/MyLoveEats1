<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wapper">
        <h1>Upadte Category</h1>
        <br><br>
        
        <?php
        // Check weather  the ID is set or not
        if(isset($_GET['id']))
        {
            // Get the id and all the other details

            // echo "Getting the data ";
            $id=$_GET['id'];
            // create sql query to get all the datials
            $sql="SELECT * FROM tbl_category WHERE id=$id";
            // Execute the query 
            $res=mysqli_query($conn,$sql);
            // Count the rows to check wheather th ei dis valid or not 
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                // get all the data 
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

            }
            else
            {
                // if category is not found
                $_SESSION['no-category-found']='<div class="error">Category Not Found.!</div>';
                // Redirect to the manage category session page
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        }
        else
        {
            // redirect to the manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="50px">
                                <?php
                            }
                            else
                            {
                                // Display Message
                                echo '<div class="error">Image Not Added</div>';
                            }
                        
                        ?>
                    </td>

                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                // echo 'Clicked';
                // 1 -->GET all the values form the form 
                $title=$_POST['title'];
                $id=$_POST['id'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2. Update the new image if selected
                    // Check Wheather the image is selected or not 
                    if(isset($_FILES['image']['name']))
                    {
                        // Get the image Detials
                        $image_name=$_FILES['image']['name'];
                        // check wheather the image is avilable or not
                        if($image_name != "")
                        {
                            // Image avilable
                            // SECTON A.--->upload the new image
                            
                            // 1:20:45
                                // Auto rename the image if we try to upload the same image
                            // GEt the Extension of our image(i.e jpg,png,gif etc) e.g ("food1.jpg")
                            $ext=end(explode('.',$image_name));

                            // Rename the image 
                            $image_name="Food_Category_".rand(000,999).'.'.$ext;  //e.g food_category_834

                            $source_path=$_FILES['image']['tmp_name'];

                            $destination_path='../images/category/'.$image_name;
                            // finally upload the image
                            $upload=move_uploaded_file($source_path,$destination_path);
                            
                            
                            // check weather the image is uploaded or not
                            // and if the image is not uploaded then we will stop the process 
                            // and redirect with error message
                            if($upload==false)
                            {
                                // SET MESSAGE
                                $_SESSION['upload']='<div class="error">FAILED TO UPLOAD IMAGE</div>';
                                // Redirect to add category page
                                header('location:'.SITEURL.'admin/manage-category.php');
                                // stop process
                                die();//We have stop the process becz if the image is failed to upload the image then
                                // that data should not be uploaded into the database
                            }
                            //  Section B. --->remove the current image if avilable
                            
                            if($current_image != "")  //here the checking code is not working so we are using empyt 
                                                        // again to check wheather the current image is empty or not 
                                // True because $a is empty
                                if(empty($current_image)) {
                                    die();
                                }
                                else
                                {

                                    $remove_path="../images/category/".$current_image;
                                    $remove=unlink($remove_path);
                                    
                                    // Check wheather the image is removed or not
                                    // if image is failed to remove then display message and stop the processes
                                    if($remove==false)
                                    {
                                        // failed to remove the image
                                        $_SESSION['failed-remove-image']='<div class="error">Failed to remove current image</div>';
                                        // redirect to manage category
                                        echo ("Failed to upload the image");
                                        // header('location:'.SITEURL.'admin/manage-category.php');
                                        // if we are not able to remove the current image then we will stop the process
                                        die();
                                    }
                                }
                                
                            
                        }
                        else
                        {
                            // image is not avilable
                            $image_name=$current_image;
                        }
                    }
                    else
                    {   
                        // if image is not selected then our image name will our current image name
                        $image_name=$current_image;
                    }
                
                // 3.Upadte the database
                $sql2= "UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured = '$featured',
                active ='$active'
                WHERE id=$id
                ";
                

                // Execute the query 
                $res2=mysqli_query($conn,$sql2);
                // echo var_dump($res2);

                // Redirect to the Manage category with Message
                // Check weather the query executed or not
                if($res2==true)
                {
                    // Category Updated
                    $_SESSION['update']='<div class="success">Category Updated Successfully.</div>';
                    // redirect to the manage-category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    
                }
                else
                {
                    // Failed to upadate the category
                    $_SESSION['update']='<div class="error">Failed to Update Category..!.</div>';
                    // redirect to the manage-category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                   
                }




            }
            

        ?>


    </div>
</div>






<?php include("partials/footer.php");?>