
<?php include('partials/menu.php'); ?>

<div class="main-contain">
    <div class="wapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>
        <br><br>
        <!-- Add category form starts here -->
        <!-- enctype="multipart/form-data" this property will allow to upload the files-->
        <form action="" method="POST" enctype="multipart/form-data">  
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Feature: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form end here-->

        <!--Now working on the  database to move forward this data into a database -->
        <?php
            // Check weather the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                //++++++++++++++ 1.step--Get the valur from form i.e title,featured,active++++++++++++++++++++++++++++++++
                    // Title Value
                $title=$_POST['title'];
                    
                // Getting the feature value but it is an radio type so we need to check wheather he is selected or not
                // YES is selected or No is Default
                if(isset($_POST['featured']))
                {
                        // if button is selected then we get the value
                        $featured=$_POST['featured'];
                }
                else
                {
                        // if the value is not set then we are going to select the defualt value
                        $featured="No";

                }

                // Getting the active value but it is an radio type so we need to check wheather he is selected or not
                // YES is selected or No is Default
                if(isset($_POST['active']))
                {
                    // If user is selected yes in active radio button 
                    $active=$_POST['active'];
                }
                else
                {
                    // If user is not selected then By defualt it is No
                    $active="No";

                }

                // Check Wheather the image is selected or not for image name accordingly
                // print_r($_FILES['image']);  //this will show the array about the image ie [name][type][tmp_name]---tempname is path here
                // die(); //break the code here
                if(isset($_FILES['image']['name']))
                {
                    // if our input type file has has the name value then we will upload the file 
                    // to upload image we need image name and then source path and destnation path
                    
                    $image_name=$_FILES['image']['name'];
                    // Upload the image only if image is selected
                    if($image_name != "")
                    {

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
                            header('location:'.SITEURL.'admin/add-category.php');
                            // stop process
                            die();//We have stop the process becz if the image is failed to upload the image then
                            // that data should not be uploaded into the database
                        }
                    }

                }
                else
                {
                    // Dont upload the image and set the image_name value as blank
                    $image_name="";

                }

                // 2 Step:- ++++++++++++++++++++Create Sql query to insert category into a database++++++++++++++++++
                $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                // 3 Step :+++++++++++++++++++Execute the query to save it into a database+++++++++++++++++++++++++
                $res=mysqli_query($conn,$sql);
                // 4 step Check weather the query is execute or  not and data is added or not
                if($res==TRUE)
                {
                    // Query Executed 
                    $_SESSION['add']='<div class="success">Category Added Successfully</div>';
                    // Redirect to manage-category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Falied to add category
                    // Query Executed 
                    $_SESSION['add']='<div class="error">Failed to Added Category</div>';
                    // Redirect to manage-category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
                

            }
            else
            {
                // echo "Not clicked";

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

