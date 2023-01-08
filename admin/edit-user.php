            <?php
            session_set_cookie_params(0);
            session_start();
            include('includes/config.php');
            if (strlen($_SESSION['alogin']) == 0) {
            header('location: login.php');
            } else {
            if (isset($_POST['submit'])) {
                $fname = $_POST['fname'];        
                $lname = $_POST['lname']; 
                $password =md5($_POST['password']);
                $email = $_POST['email'];        
                $contact = $_POST['contact'];
                $id = intval($_GET['id']);
        
                $sql = "UPDATE `users` SET fname=:fname,lname=:lname,email=:email,contact=:contact,password=:password WHERE id=:id ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':fname', $fname, PDO::PARAM_STR);        
                $query->bindParam(':lname', $lname, PDO::PARAM_STR);
                $query->bindParam(':password', $password, PDO::PARAM_STR);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':contact', $contact, PDO::PARAM_STR);
                $query->bindParam(':id', $id, PDO::PARAM_STR);
                $query->execute();
        
                echo "<script>alert('Details changed successfully');document.location = 'manage-users.php';</script>";
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
            <h4 class="page-title">Edit User Details</h4>
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
                                                $sql="SELECT * from users where users.id=:id";
                                                 $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                foreach ($results

                                                as $result) { ?>
            <div class="form-group mb-4">
            <label class="col-md-12 p-0">FName</label>
            <div class="col-md-12 border-bottom p-0">
            <input type="text" 
            name="fname" required  value="<?php echo htmlentities($result->fname); ?>" class="form-control"> </div>
            </div>

            <div class="form-group mb-4">
            <label class="col-md-12 p-0">LName</label>
            <div class="col-md-12 border-bottom p-0">
            <input type="text"  value="<?php echo htmlentities($result->lname); ?>"
            name="lname" required class="form-control"> </div>
            </div>

            <div class="form-group mb-4">
            <label for="example-email" class="col-md-12 p-0">Email</label>
            <div class="col-md-12 border-bottom p-0">
            <input type="email" required 
            class="form-control" name="email"  value="<?php echo htmlentities($result->email); ?>"
            id="example-email">
            </div>
            </div>

            <div class="form-group mb-4">
            <label class="col-md-12 p-0">Phone No</label>
            <div class="col-md-12 border-bottom p-0">
            <input type="number" required name="contact"  value="<?php echo htmlentities($result->contact); ?>"
            class="form-control">
            </div>
            </div>


            <div class="form-group mb-4">
            <label class="col-md-12 p-0">Password<span style="color:red">Minimum characters=8</span></label>
            <div class="col-md-12 border-bottom p-0">
            <input type="password"  name="password"   required class="form-control">

            </div>
            </div> 

            <div class="form-group mb-4">
            <div class="col-sm-12">
            <button type="submit" name="submit" class="btn btn-success">Update User Details</button>
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