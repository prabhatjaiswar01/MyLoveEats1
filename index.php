<?php include("./partials-front/menu.php");   ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Create Sql query to display categories from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ";
                // execute the query
                $res=mysqli_query($conn,$sql);
                // check and count the rows
                $count=mysqli_num_rows($res);  //to coount rows to check wheather the caterory is available or not
                // if the category is there thenwe will display on the front end otherwise we will diplay the error msg
                if($count>0)
                {
                    // categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get the values like title,image name and id
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>  <!-- break1 start here-->
                        <!-- we are using the html inside the php by braking the php -->
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                // check wheathere image is available or not
                                    if($image_name == "")
                                    {
                                        // display the message
                                        echo '<div class="error">Image Not Available.</div>';
                                    }
                                    else
                                    {
                                        // display the image
                                        ?>  <!-- break2 start here-->
                                        <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php //break 2 ends here
                                    }

                                ?>
                                
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php //break1 End here 
                    }
                }
                else
                {
                    // categories not available
                    echo "<div class='error'>Category Not Available.</div>";
                }


            ?>
            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
                // Getting foods from database thatare active and featured
                $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                // execute the Query
                $res2=mysqli_query($conn,$sql2);
                // count the rows
                $count2=mysqli_num_rows($res);
                
                // Check whearthe food available or not
                if($count2>0)
                {
                    // Food Available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        // Get all the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];

                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    // check wheather image available or not
                                    if($image_name=="")
                                    {
                                        // image not available
                                        
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        // Image is not available
                                      
                                        ?>
                                        <img src="<?php SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                        
                                        
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php  echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price;  ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="./order.html" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                        
                    }
                }
                else
                {
                    // if food is not available
                    echo '<div class="error">Food Not Available.</div>';
                    
                }

            ?>

            


            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("./partials-front/footer.php");   ?>