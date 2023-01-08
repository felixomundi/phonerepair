            <?php
            session_set_cookie_params(0);
            session_start();
            include('includes/config.php');
            if (strlen($_SESSION['alogin']) == 0) {
            header('location: login.php');
            } else {
            if (isset($_POST['submit'])) {
                $sname = $_POST['sname'];        
                $pid = $_POST['pid']; 
                $price = $_POST['price'];   
                $id = intval($_GET['id']);
        
                $sql = "UPDATE `services` SET sname=:sname,pid=:pid,price=:price WHERE id=:id ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':sname', $sname, PDO::PARAM_STR);  
                $query->bindParam(':pid', $pid, PDO::PARAM_STR); 
                $query->bindParam(':price', $price, PDO::PARAM_STR);
                $query->bindParam(':id', $id, PDO::PARAM_STR);
                $query->execute();
        
                echo "<script>alert('Details changed successfully');document.location = 'manage-services.php';</script>";
            }

            ?>

            <!DOCTYPE html>
            <html dir="ltr" lang="en">

            <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="keywords"
            content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
            <meta name="description"
            content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
            <meta name="robots" content="noindex,nofollow">
            <title>Phone Repairs System</title>
            <!-- Favicon icon -->
            <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
            <!-- Custom CSS -->
            <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
            <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
            <!-- Custom CSS -->
            <link href="css/style.min.css" rel="stylesheet">
            </head>

            <body>
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <div class="preloader">
            <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
            </div>
            </div>
            <!-- ============================================================== -->
            <!-- Main wrapper - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
            data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->


            <?php include('includes/header.php');?>
            <?php include('includes/sidebar.php');?>
            <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Service Details</h4>
            </div>

            </div>
            <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">

            <div class="col-lg-8 col-xlg-9 col-md-12">
            <div class="card">
           
            <div class="card-body">
            <form class="form-horizontal form-material" method="post">
            <?php
                                                $id = intval($_GET['id']);
                                                $sql="SELECT services.*,product.pname from services inner join product on product.id=services.pid and  services.id=:id";
                                                 $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                foreach ($results

                                                as $result) { ?>
            <div class="form-group mb-4">
            <label class="col-md-12 p-0">Product Name<span class="form-text text-danger help-block">Select Product</span></label>
            <div class="col-md-12 border-bottom p-0">
            <select class="form-control" id="select1"
                                        name="pid" required>
                                    <option value="<?php echo htmlentities($result->pid); ?>"><?php echo htmlentities($result->pname); ?></option>
                                    <?php $ret = "SELECT `id`,`pname` FROM `product`";
                                    $query = $dbh->prepare($ret);
                                    //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                    $query->execute();
                                    $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($resultss as $results) {
                                            //if ($results->pname == $cname) {
                                               // continue;
                                            //} else {
                                                ?>
                                                <option value="<?php echo htmlentities($results->id); ?>">
                                                    <?php echo htmlentities($results->pname); ?>
                                                </option>
                                            <?php //}
                                       }
                                    } ?>
                                </select>
         </div>

         <div class="form-group mb-4">
            <label class="col-md-12 p-0">Servive Name</label>
            <div class="col-md-12 border-bottom p-0">
            <input type="text" 
            name="sname" required  value="<?php echo htmlentities($result->sname); ?>" class="form-control">
         </div>
         </div>

         <div class="form-group mb-4">
            <label class="col-md-12 p-0">Service Price</label>
            <div class="col-md-12 border-bottom p-0">
            <input type="number" step="0.0" 
            name="price" required  value="<?php echo htmlentities($result->price); ?>" class="form-control">
         </div>
         </div>



            </div>


            <div class="form-group mb-4">
            <div class="col-sm-12">
            <button  type="submit" name="submit" class="btn btn-success">Update Service Details</button>
            </div>
            </div>
            </form>
            </div>
            <?php }}?>
            </div>
            </div>
            <!-- Column -->
            </div>

            </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="js/app-style-switcher.js"></script>
            <!--Wave Effects -->
            <script src="js/waves.js"></script>
            <!--Menu sidebar -->
            <script src="js/sidebarmenu.js"></script>
            <!--Custom JavaScript -->
            <script src="js/custom.js"></script>
            </body>

            </html>
            <?php }?>