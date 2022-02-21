<?php include('partials/menu.php'); ?>
  
  <!-- Main section starts -->
        <div class="main-content">
            <div class="wapper">
                <h1>DASHBOARD</h1> 
                <br><br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                
                ?>
                <br><br>
                <div class="col-4 text-center">
                    <?php 
                    $sql="SELECT * FROM tbl_category ";
                    // execute the query
                    $res=mysqli_query($conn,$sql);
                    // count the Rows
                    $count=mysqli_num_rows($res);
                    
                    ?>
                    <h1>
                        <?php echo $count;?>
                    </h1>
                    <br>
                    category
                </div>
                
                <div class="col-4 text-center">
                <?php 
                    $sql2="SELECT * FROM tbl_food ";
                    // execute the query
                    $res2=mysqli_query($conn,$sql2);
                    // count the Rows
                    $count2=mysqli_num_rows($res2);
                    
                    ?>
                    <h1><?php echo $count2?></h1>
                    <br>
                    Foods
                </div>
                <div class="col-4 text-center">
                <?php 
                    $sql3="SELECT * FROM tbl_order ";
                    // execute the query
                    $res3=mysqli_query($conn,$sql3);
                    // count the Rows
                    $count3=mysqli_num_rows($res3);
                    
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Total Order
                </div>
                <div class="col-4 text-center">
                    <?php
                        // GET SQL QUERY TOGET TOTAL REVENU GENERATED FOR THAT WE WILL USE AGGREGETE FUNCTION IN SQL
                        $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered' ";

                        // execute the query
                        $res4=mysqli_query($conn,$sql4);

                        // Get the value 
                        $row4=mysqli_fetch_assoc($res4);

                        // Get the total revenue
                        $total_revenue= $row4['Total'];
                    ?>
                
                    <h1><?php echo $total_revenue; ?></h1>
                    
                    <br>
                    Revenu Genereted
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main section Ends -->


<?php include('partials/footer.php'); ?>

        