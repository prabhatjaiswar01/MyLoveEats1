<?php
            // Check wheather the button is cliked or not
            if(isset($_POST['submit']))
            {
                // echo "clicked button";
                // 1 .Get all the details form the form
                echo $id=$_POST['id'];
                echo $title=$_POST['title'];
                echo $description=$_POST['description'];
                echo $price=$_POST['price'];
                echo var_dump($current_image=$_POST['current_image']);
                echo $category=$_POST['category'];
                echo $featured=$_POST['featured'];
                echo $active=$_POST['active'];
                //2. Upload the image if selected
                    // check wheather upload button is clicked or not
                    if(isset($_FILES['image']['name']))
                    {
                        // upload button clicked
                        $image_name=$_FILES['image']['name']; //new image name

                        // check wheathe the file is avilable or not
                        if($image_name != "")
                        {
                            // image is avilable
                            // A.Upload the New image.
                            $ext=end(explode(".",$image_name)); //get the extension of the image

                            $image_name="Food-Name-".rand(0000,9999).".".$ext;  //this will be rename the image

                            // e we need path and destanation path
                            $src_path=$_FILES['image']['tmp_name'];  //Source path

                            $dest_path="../images/food/".$image_name; //Destnation path
                             
                            
                            $upload=move_uploaded_file($src_path,$dest_path);

                            // check wheahter the image is uploaded or not
                            if($upload==false)
                            {
                                // Failed to upload 
                                $_SESSION['upload']='<div class="erro">Failed to upload the Image</div>';
                                // redirect the image food
                                header('location:'.SITEURL.'admin/manage-food.php'); 
                                // Stop the process
                                die();
                            }
                //3. Upload the image if current image is exist
                            // B.Remove Current image if avilable
                            if($current_image != "")
                            {
                                // Current image is avilable
                                // Remove the image
                                $remove_path="../images/food/".$current_image;

                                $remove=unlink($remove_path);

                                // check wheather the image is removed or not
                                if($remove==false)
                                {
                                    // failed to remove current imaeg
                                    $_SESSION['remove-failed']='<div class="error">Failed to Remove Current Image</div>';
                                    // redirect to manage food 
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    // Stop the process
                                    die();
                                }
                            }



                        }

                    }
                    else
                    {
                        // if upload image is not clicked that means image will be same
                        $image_name=$current_image;
                    }
                
                // 4. Update the food in database
                $sql3="UPDATE tbl_food SET 
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                catogery_id=$category,
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";
                // Execute the sql query
                $res3=mysqli_query($conn,$sql3);
                // check wheather the query is executed or not
                if($res3==true)
                {
                    // food updated
                    $_SESSION['update']='<div class="success">Food Updated Successfully..!</div>';
                    // redirect to the manage-food.php
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // Failed to update the food
                    $_SESSION['update']='<div class="error">Failed to Update Food..!</div>';
                    // redirect to the manage-food.php
                    echo "Failed to update the data".mysqli_error($conn);
                    // header('location:'.SITEURL.'admin/manage-food.php');
                }
                // Redirect to the manage-food.php



            }
            
        
        ?>




<!-- image changer code -->
<td>
                        <!-- diaplay all the category from the database -->
                        <!--  
                            // query to get active  category
                            $sql="SELECT * FROM tbl_category WHERE active='Yes' " ;                   
                            // Execute the query
                            $res=mysqli_query($conn,$sql);
                            // count rows
                            $count=mysqli_num_rows($res);
                            // check wheather the category is available or not
                            if($count>0)
                            {
                                // category available
                                // for diplaying all the category we will use the while loop
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title=$row['title'];
                                    $category_id=$row['id'];

                                    

                                }
                            }
                            else
                            {
                                // category not available
                                echo "<option value='0'>Category Not  Available.</option>";
                            }

                        
                        ?> -->
