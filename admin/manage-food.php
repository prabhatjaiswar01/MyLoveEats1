<?php include('partials/menu.php'); ?>
        <div class="main-content">
              <div class="wapper">
                  <h1>Manage Food</h1>
                  <br>
                <!-- Button to add admin -->
                <a href="<?php echo SITEURL;?>admin/add-food.php" class=btn-primary>Add Food</a>
                <br>
                <br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorized']))
                    {
                        echo $_SESSION['unauthorized'];
                        unset($_SESSION['unauthorized']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['failed-remove-image']))
                    {
                        echo $_SESSION['failed-remove-image'];
                        unset($_SESSION['failed-remove-image']);
                    }
                ?>
                <table class="table">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    // Create Sql query to get all the to get all the food values form the database
                    $sql="SELECT * FROM tbl_food";

                    // Execute the query
                    $res=mysqli_query($conn,$sql);


                    // count the number of rows to check wheather we have food or not
                    $count=mysqli_num_rows($res);

                    // Create number variablae and set it as one
                    $sr=1;

                    if($count>0)
                    {
                        // then only we ha
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                        
                        ?>
                        <tr>
                            <td><?php echo $sr++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php 
                                // Check wheather the image is we have image or not
                                if($image_name=="")
                                {
                                    // We do not have an image
                                    // so we will echo 
                                    echo "<div class='error'>Image Not Added</div>";
                                }
                                else
                                {
                                    // We have the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name; ?>" width="50px">
                                    <?php
                                }

                            
                            
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class=btn-secondary>Update Food</a>
                                <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class=btn-danger>Delete Food</a>
            
                            </td>
                        </tr>
                    
                         <?php
                        
                        }

                    }
                    else
                    {
                        // We dont have a food
                        echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
                    }

                    ?>
                    
                </table>
              </div>
        </div>


        <?php include('partials/footer.php'); ?>