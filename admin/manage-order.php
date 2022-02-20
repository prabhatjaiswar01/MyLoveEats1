<?php include('partials/menu.php'); ?>
        <div class="main-content">
              <div class="wapper">
                  <h1>manage order</h1>
                  <br><br><br>
                  <?php
                  if(isset($_SESSION['update']))
                  {
                      echo $_SESSION['update'];
                      unset($_SESSION['update']);
                  }
                  ?>
                  <br><br>
                
                <br>
                <table class="table">
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order_Date</th>
                        <th>Status</th>
                        <th>Customer_Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <!-- Now from Here we will diplay all the details here from the database -->

                    <?php
                        // Get all the orders from the database
                        // we want here latest order into the top so thats why we are using Order by of id columns
                        //  in decending order
                        $sql="SELECT * FROM tbl_order ORDER BY id DESC" ;
                        // execute the query
                        $res=mysqli_query($conn,$sql);
                        // count the number of rows 
                        $count=mysqli_num_rows($res);

                        $sn=1;  //creating for the serial number aanad set its initial value is 1

                        // check wheather the order is Available or not 
                        if($count>0)
                        {
                            // order Available use while loop to get all the values from the database
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // Get all the orders details
                                $id=$row['id'];
                                $food=$row['food'];
                                $price=$row['price'];
                                $qty=$row['qty'];
                                $total=$row['total'];
                                $order_date=$row['order_date'];
                                $status=$row['status'];
                                $customer_name=$row['customer_name'];
                                $customer_contact=$row['customer_contact'];
                                $customer_email=$row['customer_email'];
                                $customer_address=$row['customer_address'];
                                
                                // Now display all this details inot our table row
                                ?>

                                <tr>
                                    <td><?php echo $sn++ ;?></td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price ;?></td>
                                    <td><?php echo $qty ;?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <!-- here we will check the status and display different color for different status-->
                                    
                                    <td>
                                        <?php
                                            // Ordered,On Delivery,Delivered,Cancelled 
                                            if($status=="Ordered")
                                            {
                                                echo "<label >$status</label>";
                                            }
                                            elseif(($status=="On Delivery"))
                                            {
                                                echo "<label style='color:orange'>$status</label>";
                                            }
                                            elseif(($status=="Delivered"))
                                            {
                                                echo "<label style='color:green'>$status</label>";
                                            }
                                            elseif(($status=="Cancelled"))
                                            {
                                                echo "<label style='color:red'>$status</label>";
                                            }

                                        ?>
                                    </td>


                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class=btn-secondary>Update Admin</a>
                                    <br>
                                    <a href="#" class=btn-danger>Delete Admin</a>
                                    
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            // order Not Available
                            echo "<tr><td colspan='12' class='error'>Order Not Available.</td></tr>";
                        }
                    ?>

                    
                    
                </table>
              </div>
        </div>


<?php include('partials/footer.php'); ?>
