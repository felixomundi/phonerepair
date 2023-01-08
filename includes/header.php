
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    
                </div>
            </div>

            <?php
                    $email = $_SESSION['login'];
                    $sql2 = "SELECT `email` FROM `users` WHERE `email`=:email;";
                    $query = $dbh->prepare($sql2);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            
                        
                    
                    ?>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown"><?php echo htmlentities($result->email); }}?></button>
                        <div class="dropdown-menu dropdown-menu-right">                            
                            <a href="logout.php">Logout </a>
                        </div>
                    </div>
                  
                    <div class="btn-group">
                                            
                    <img  src="photos/d41d8cd98f00b204e9800998ecf8427e1656931295.jpg" class="img-profile rounded-circle" style="width:50px" alt="Cinque Terre">
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                <?php  
                                     $email1 = $_SESSION['login'];
                                     $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
                                     $query1 = $dbh->prepare($sql1);
                                     $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
                                     $query1->execute();
                                     $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                     if ($query1->rowCount() > 0) {
                                         foreach ($results1 as $result1) {
                                             $uid = $result1->id;
                                         }
                                     }
 
                                     $status = 0;    
                                     
                                    $sql = "SELECT * FROM repairs WHERE  repairs.status=:status and repairs.userid=:uid order by repairs.id desc ";                
                                     $query = $dbh->prepare($sql);
                                     $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                     $query->bindParam(':status', $status, PDO::PARAM_STR);
                                     $query->execute();
                                     $results = $query->fetchAll(PDO::FETCH_OBJ);
                                     $totalitems = $query->rowCount();
                                     ?>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;"><?php echo htmlentities($totalitems); ?> </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="#" class="text-decoration-none">
                
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Repairs</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <?php
                                                $sql = "SELECT * from system";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                foreach ($results

                                                as $result) { ?>

            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+254 <?php echo htmlentities($result->mobile);}} ?></h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
          
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Phone</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Repairs</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                           

                            <div class="nav-item dropdown">
                                <a href="#" class="btn d-flex align-items-center justify-content-between bg-primary w-100" style="height: 65px; padding: 0 30px;"  data-toggle="dropdown"><h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Services</h6>  <i class="fa fa-angle-down text-dark"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.php" class="dropdown-item"></a>
                                    <?php 
                $con=mysqli_connect("localhost","root","","repairs");
                // Check connection
                if (mysqli_connect_errno())
                {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                //require("database/db_connect.php");
                $sql="SELECT * FROM product ";
                if ($result=mysqli_query($con,$sql))
                {
                //count number of rows in query result
                $rowcount=mysqli_num_rows($result);
                //if no rows returned show no categories alert
                if ($rowcount==0) {
                # code...
                echo 'No Product at the moment';
                }
                //if there are rows available display all the results
                foreach ($result as $product => $pc) {
                # code...
                echo '<a class="dropdown-item" href="category.php?id='.$pc['id'].'">'.$pc['pname'].'</a>
                <div class="dropdown-divider"></div>';
                }
                }

                mysqli_close($con);

                ?>    
                                </div>
                            </div>




                            <div class="nav-item dropdown">
                                <a href="cart.php" class="nav-link dropdown-toggle">Repair Cart</i></a>
                                
                            </div>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                            <a href="add-repair.php" class="nav-item nav-link">Book repair</a>

                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="profile.php" class="dropdown-item">My Profile</a>
                                    <a href="update-password.php" class="dropdown-item">Update Password</a>
                                </div>
                            </div>                            
                        </div>
                        <a href="all-services.php" class="nav-item nav-link">All Services</a>
                        <!--<a href="manage-payments.php" class="nav-item nav-link">Payments</a>-->
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <?php  
                                     $email1 = $_SESSION['login'];
                                     $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
                                     $query1 = $dbh->prepare($sql1);
                                     $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
                                     $query1->execute();
                                     $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                     if ($query1->rowCount() > 0) {
                                         foreach ($results1 as $result1) {
                                             $uid = $result1->id;
                                         }
                                     }
 
                                     $status = 0;    
                                     
                                    $sql = "SELECT * FROM repairs WHERE  repairs.status=:status and repairs.userid=:uid order by repairs.id desc ";                
                                     $query = $dbh->prepare($sql);
                                     $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                     $query->bindParam(':status', $status, PDO::PARAM_STR);
                                     $query->execute();
                                     $results = $query->fetchAll(PDO::FETCH_OBJ);
                                     $totalitems = $query->rowCount();
                                     ?>
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo htmlentities($totalitems); ?></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
