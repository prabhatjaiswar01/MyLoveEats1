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
                    <h1>5</h1>
                    <br>
                    category
                </div>
                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br>
                    category
                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br>
                    category
                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    
                    <br>
                    category
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main section Ends -->


<?php include('partials/footer.php'); ?>

        