<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:  </td>
                    <td>
                        <input type="text" name="title"  placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <!-- For display all the category from the database so we are using select tab
                        it will create the drop down  -->
                        <select name="category" >

                            <?php
                                // Create PHP Code to display category from Database
                                // 1.Create SQL to get all active categories from the database
                                // Display on dropdown---Display Only that category which is Active in the category
                                $sql="SELECT  * FROM tbl_category WHERE active='Yes' ";

                                // Execute the Query
                                $res=mysqli_query($conn,$sql);

                                // Count rows to check wheather we have categorys or not
                                $count=mysqli_num_rows($res);
                                // if count is greater then zero, we have categories else we do not have categories
                                if($count>0)
                                {
                                    // We have categories
                                    // if we have category then it is one or more so for displaying we can use while loop
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // Get the details of the category
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                        <option value="<?php echo $id?>"><?php echo $title?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    // We dont have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                                   
                 

                             ?>

                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:  </td>
                    <td>
                        <input type="radio" value="Yes" name="featured">Yes
                        <input type="radio" value="No" name="featured">No
                    </td>
                </tr>
                <tr>
                    <td>Active:  </td>
                    <td>
                        <input type="radio" value="Yes" name="active">Yes
                        <input type="radio" value="No" name="active">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                    
                </tr>
            </table>
        </form>
        <?php
            // Check wheather the buttonis clicked
            if(isset($_POST['submit']))
            {
                // Add the food in Database
                // echo "Button Clicked";
                // 1 Step --> Get the data from form
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];
                
                    // check wheather the radio button is checked or not
                if(isset($_POST['featured']))
                {
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";  //setting the defualt value here
                }
                    // check wheather the radio button is checked or not for active
                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";  //setting the defualt value here
                }


                // 2 Step --> Upload the image if selected
                // check wheather the select image is clicked or not and upload the image is selcted
                if(isset($_FILES['image']['name']))
                {
                    // Get the details of the selcected image
                    $image_name=$_FILES['image']['name'];
                    
                    // Check wheather the image is selected or not and uplod the image if only the image is selceted
                    if($image_name != "")
                    {
                        // Image is selcted
                        // 1. Rename the image
                        // get the extension of selected image(i.e -->png,jpg,ect) e.g "prabhat.png"--->prabhat and png
                        $ext=end(explode('.',$image_name));
                        // create new name for image
                        $image_name="Food-Name".rand(0000,9999).".".$ext; //New image name may be "Food-Name-798.jpg"


                        // 2.upload the image
                        // Get the source path and destanation path
                        
                        // Source path is the current location of the image
                        $src=$_FILES['image']['tmp_name'];

                        //Destnation path
                        $dst="../images/food/".$image_name;
                        
                        // Finally Upload the food image inside a image -->food folder
                        $upload= move_uploaded_file($src,$dst);
                        // Check wheather image is uploaded or not
                        if($upload== false)
                        {
                            // failed to upload the image 
                            // redirect to add food with Error massage
                            $_SESSION['upload']='<div class="error">Failed to Upload Image.</div>';
                            header('location:'.SITEURL.'admin/add-food.php');
                            // Stop the process
                            die();
                        }
                    }
                    


                }
                else
                {
                    // Otherwise we will empty the images
                    $image_name=""; //Setting defualt image value as blank
                }
                 
                echo "success-working till here";

                // 3 Step --> Insert the data into the database
                // Create a sql query at the to save and uplpoad the data into a database
                // here we are not passing the '' to the category and the price because it has numerical value
                $sql2="INSERT into tbl_food SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                catogery_id=$category,
                featured='$featured',
                active='$active'
                ";
                // Exectue the query

                $res2=mysqli_query($conn,$sql2);
                // check wheather the data is inserted or not


                // 4 Step --> Redirect message to Manage Food Page
                if($res2 == TRUE)
                {
                    // Data inserted succesfully 
                    $_SESSION['add']='<div class="success">Food Added Successfully.</div>';
                    // Redirect to the manage-food
                    header("location:".SITEURL."admin/manage-food.php");
                    // echo "success";
                }
                else
                {
                    // failed to Insert data
                    $_SESSION['add']='<div class="error">Failed to Add Food..!</div>';
                    // Redirect to the manage-food
                    // echo "error";
                    header("location:".SITEURL."admin/manage-food.php");
                }
                
            }
           
        ?>





    </div>
</div>


<?php include('partials/footer.php');?>