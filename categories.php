<?php include("./partials-front/menu.php");   ?>



    <!-- CAtegories Section Starts Here -->
    <!-- we will display on the categories that are active by the admin -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php 
                // Display all the categories that are active
                $sql="SELECT * FROM tbl_category WHERE active='Yes' ";
                // execute the query
                $res=mysqli_query($conn,$sql);
                // count the rows
                $count=mysqli_num_rows($res);
                // check wheather  the categories are available or not
                if($count>0)
                {
                    // categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get the values 
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?> <!--first break start here-->
                        <!-- breaking php to use the html code between php -->
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                            <?php 
                                // check wheather the image name is available or not
                                if($image_name=="")
                                {
                                    // Image Not Available
                                    echo '<div class="error">Image Not Added.</div>';
                                }
                                else
                                {
                                    // Image is Available
                                    ?> <!--second break start here-->
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                    <?php //second break start here
                                }
                                
                            ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php  //first break end here
                    }
                }
                else
                {
                    // categories are not available
                    echo '<div class="error">Category  not Found..!</div>';
                }
            
            ?>

            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include("./partials-front/footer.php");   ?>