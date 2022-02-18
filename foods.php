<?php include("./partials-front/menu.php");   ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <!-- Display the foods that are active -->
            <?php
            // Display food that are active from the database
            $sql="SELECT * FROM tbl_food WHERE active='Yes' ";
            // Execute the query
            $res=mysqli_query($conn,$sql);
            // Count the rows
            $count=mysqli_num_rows($res);
            // check wheather are available or not
            if($count>0)
            {
                // Foods availabe
                while($row=mysqli_fetch_assoc($res))
                {
                    // get the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    //Now display all this detials into our html
                    ?> <!--first break here start-->
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // check wheather image is available or not
                            if($image_name== "")
                            {
                                // image  is not available
                                echo '<div class="error">Image Not Available</div>';
                            }
                            else
                            {
                                // image is availabe
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php

                            }
                            ?>

                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php  //first break here End
                    
                }

            }
            else
            {
                // Food is not available
                echo '<div class="error">Food Not Found.</div>';
            }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("./partials-front/footer.php");   ?>