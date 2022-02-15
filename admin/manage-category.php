<?php include('partials/menu.php'); ?>
  <div class="main-content">
        <div class="wapper">
            <h1>manage category</h1>
            <br>
                <!-- Button to add admin -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class=btn-primary>Add Category</a>
                <br>
                <br>
                <?php
                    if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }
                    if(isset($_SESSION['remove']))
                        {
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
                        }
                    if(isset($_SESSION['remove']))
                        {
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
                        }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['failed-remove-image']))
                    {
                        echo $_SESSION['failed-remove-image'];
                        unset($_SESSION['failed-remove-image']);
                    }
                    if(isset($_SESSION['image-is-Empty']))
                    {
                        echo $_SESSION['image-is-Empty'];
                        unset($_SESSION['image-is-Empty']);
                    }

                    ?>
                    <br><br>
                <table class="table">
                    <tr>
                        <th>S.N.</th>
                        <th>Title  </th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        // query to get all the category from the database
                        $sql="SELECT * FROM tbl_category";
                        // Execute the query
                        $res=mysqli_query($conn,$sql);

                        // Count the rows
                        $count=mysqli_num_rows($res);
                        // Check wheather we have data in our database or not
                        if($count>0)
                        {
                            // We have data in database
                            // GEt the data and display
                            $srn=1;  //for serial no
                            while($row=mysqli_fetch_assoc($res))    //This while loop will work as long as we have data in database
                            {   
                                $id=$row['id'];
                                $title=$row['title'];
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];
                                
                                ?>

                                <tr>
                                    <td><?php echo $srn++; ?> </td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php
                                        // Check Weather the image name is avilabe or not
                                        if($image_name!="")
                                        {
                                            // Display the image
                                            ?>
                                            <img src="<?php echo SITEURL ;?>images/category/<?php echo $image_name?>" width="50px">
                                            <?php
                                        }
                                        else
                                        {
                                            // Just display the message
                                            echo '<div class="error">Image Not Added.</div>';
                                        }

                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class=btn-secondary>Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class=btn-danger>Delete Category</a>
                                    
                                    </td>
                                </tr>


                                <?php

                            }
                        }
                        else
                        {
                            // We do not have the data
                            // we will display the message inside table
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                            </tr>

                            <?php

                        }

                    ?>
                    
                    
                </table>
        </div>
  </div>


  <?php include('partials/footer.php'); ?>