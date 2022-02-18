<!-- its a page to display the food based on category -->
<?php include("./partials-front/menu.php");   ?>
<?php 
    // check wheather id is passed or not 
    if(isset($_GET['category_id']))
    {
        // category is set and get the id
        $category_id=$_GET['category_id'];
        // get the category title here based on category_id
        $sql="SELECT title from tbl_category WHERE id=$category_id";
        // execute the query 
        $res=mysqli_query($conn,$sql);
        // get the values from the database
        $row=mysqli_fetch_assoc($res);
        // get the title
        $category_title=$row['title'];
    }
    else
    {
        // category not passed
        // redirect to home page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                // select the food items based on categroy id
                $sql2="SELECT * FROM tbl_food WHERE catogery_id=$category_id ";

                // execute the query
                $res2=mysqli_query($conn,$sql2);

                // count the rows
                $count=mysqli_num_rows($res2);

                // check wheather the food is available or not
                if($count>0)
                {
                    // Food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        // get all the food from the database
                        $title=$row2['title'];
                        
                        $price=$row2['price'];
                        
                        $description=$row2['description'];
                        
                        $image_name=$row2['image_name'];




                        ?> <!--first break here start-->
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    // check wheather the image is available
                                    if($image_name=="")
                                    {
                                        // image not available
                                        echo '<div class="error">Image Not Available.</div>';
                                    }
                                    else
                                    {
                                        // image available
                                        ?> <!-- second break start here -->
                                         <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php //second break end here

                                    }
                                
                                ?>

                               
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $title; ?></p>
                                <p class="food-detail">
                                   <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php   //first break end here
                    }

                }
                else
                {
                    // food is not available
                    echo '<div class="error">Food Not Available.</div>';
                }


            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("./partials-front/footer.php");   ?>