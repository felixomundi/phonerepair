<?php
session_start();
include('includes/config.php');
if (!empty($_SESSION['alogin'])) {
    header("location: login.php");
} else {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "SELECT email,password FROM admin WHERE email=:email and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['email'];
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
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
    

    <script type="text/javascript">
            function validate() {
                let email = document.userlogin.email.value;
                let pass = document.userlogin.password.value;
                if (email === "" || email === null && pass === "" || pass === null) {
                    //alert("Please provide your email and password");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                    //document.userlogin.password.focus() ;
                    return false;
                }
                if (email === "" || email === null) {
                    //alert("Please provide your email");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.userlogin.email.focus();
                    return false;
                } else {
                    var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (email.match(mailformat)) {
                        if (pass === "" || pass === null) {
                            //alert("Please provide your password");
                            document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                            document.userlogin.password.focus();
                            return false;
                        }
                        return true;
                        // when password field is not empty
                    } else {
                        document.getElementById('emailcheck').innerHTML = 'Enter a correct email address';
                        document.userlogin.email.focus();
                        return false;
                    }
                }
            }
        </script>
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
    
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-primary">
                <div class="row align-items-center">
                   
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                           
                            <a href="#" 
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                                       Login Page</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                   
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <form  class="form-horizontal form-material" method="post" name="userlogin" onsubmit="return validate();" novalidate>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                           
                                                <input type="email" class="form-control p-0 border-0"
                                                       id="email" aria-describedby="emailHelp"
                                                       placeholder="Enter Email Address..." name="email">
                                                <span id="emailcheck" style="font-size: 12px; color: red;"></span>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" class="form-control p-0 border-0"
                                                       id="password" placeholder="Password" name="password">
                                                <span id="passwordcheck" style="font-size: 12px; color: red;"></span>

                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit"
                                                    name="login">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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

<?php } ?>