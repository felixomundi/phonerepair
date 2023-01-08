<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
   
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    <title>Phone Repairs System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">




     <!-- Custom fonts for this template-->
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css2/sb-admin-2.min.css" rel="stylesheet">
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
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        
                        <a href="#" class="page-title"
                                >Dashboard</a>
                    </div>
                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container-fluid">
              
                <div class="row justify-content-center">



<!-- Active Users -->
<div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <a href="manage-services.php">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                       Services
                                                    </div>
                                                    <?php
                                                    $sql = "SELECT `id` FROM `services` WHERE `status`=1";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $services = $query->rowCount();
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlentities($services); ?></div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>


<!-- Active Users -->
<div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <a href="manage-users.php">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                       Total Customers
                                                    </div>
                                                    <?php
                                                    $sql = "SELECT `id` FROM `users` WHERE `status`=1";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $regusers = $query->rowCount();
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlentities($regusers); ?></div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>


<!-- Active Users -->
<div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <a href="pending-repairs.php">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                       Pending Repairs
                                                    </div>
                                                    <?php
                                                    $sql = "SELECT `id` FROM `repairs` WHERE `status`=0";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $pr = $query->rowCount();
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlentities($pr); ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>


<!-- Active Users -->
<div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <a href="manage-repairs.php">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                       Approved Repairs
                                                    </div>
                                                    <?php
                                                    $sql = "SELECT `id` FROM `repairs` WHERE `status`=1";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $r = $query->rowCount();
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlentities($r); ?></div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>


<!-- Active Users -->
<div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <a href="progress-repairs.php">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                       In Progress Repairs
                                                    </div>
                                                    <?php
                                                    $sql = "SELECT `id` FROM `repairs` WHERE `status`=2";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $pr = $query->rowCount();
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlentities($pr); ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>


<!-- Active Users -->
<div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <a href="done-repairs.php">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                       Done repairs
                                                    </div>
                                                    <?php
                                                    $sql = "SELECT `id` FROM `repairs` WHERE `status`=4";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $dr = $query->rowCount();
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlentities($dr); ?></div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>






<!-- Active Users -->
<div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <a href="approved-payments.php">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                       Approved Payments
                                                    </div>
                                                    <?php
                                                    $sql = "SELECT `id` FROM `payment` WHERE `status`=0";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $rs = $query->rowCount();
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlentities($rs); ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>


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
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>




        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php } ?>