<?php include("./partials-front/menu.php");   ?>

<?php
// check wheather food idis set or not
if(isset($_GET['food_id']))
{
    // get the food id and details of the selected food
    $food_id=$_GET['food_id'];

    // Get the detials of selected food
    $sql="SELECT * FROM tbl_food WHERE id=$food_id ";
    // execute the query
    $res=mysqli_query($conn,$sql);

    // count the rows
    $count=mysqli_num_rows($res);
    // check wheather the data is available or not
    if($count==1)
    {
        // we have data
        // get the data from database
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];

        
    }
    else
    {
        // food not available
        // redirect to home page
        header('location:'.SITEURL);
    }
}
else
{
    // redirect to home page
    header('location:'.SITEURL);
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            // check wheather image is available or not
                            if($image_name == "")
                            {
                                // image is not availabe.
                                echo '<div class="error">Image Not Available</div>';

                            }
                            else
                            {
                                // image is available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php
                                
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>

                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <p class="food-price"><?php echo $price;  ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Prabhat Jaiswar" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="number" name="contact" placeholder="E.g. 9819xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. prabhatjaiswar01@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            // check wheather the submit button is clicked or not\
            if(isset($_POST['submit']))
            {
                // clicked
                // get all the variable for the <database
                
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];

                $total= $price * $qty; //total =price * quantity

                // it will get the current date and time
                $order_date=date("Y-m-d h:i:sa"); //y-year,m=month,d=day,h=hours,i=minutes,s=seconda,a=am or pm
                $status="Ordered";  //ordered , Delivery , On Delivery , cancelled
                $customer_name=$_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$_POST['address'];

                // Save the order in database
                $sql2="INSERT INTO tbl_order SET 
                food='$food',
                price=$price,
                qty='$qty',
                total='$total',
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
                
                ";



                // execute the query
                $res2=mysqli_query($conn,$sql2);

                // check wheather the query executed successfully or not
                if($res2==true)
                {
                    // Query Executed or Ordered saved
                    $_SESSION['order']='<div class="success text-center">Food Ordered Successfully. </div>';
                    // redirecd to home page
                    header('location:'.SITEURL);


                }
                else
                {
                    // Failed to save the order
                    $_SESSION['order']='<div class="error text-center">Failed to  Order Food.</div>';
                    // redirecd to home page
                    header('location:'.SITEURL);

                }

            }


            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include("./partials-front/footer.php");   ?>