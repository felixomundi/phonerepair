<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);

        $email = $_SESSION['alogin'];

        $sql = "SELECT `password` FROM `admin` WHERE email=:email AND password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "UPDATE `admin` SET password=:newpassword WHERE email=:email";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "<script>alert('Your password has been successfully updated')</script>";
        } else {
            echo "<script>alert('Your current password is not correct')</script>";
        }
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
    <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value !== document.chngpwd.confirmpassword.value) {
                    alert("New password and Confirm password field didn\'t match!!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>

        <script>
            var checkPass = function () {
                var password = document.getElementById('newpass').value;
                var repassword = document.getElementById('confirmpass').value;
                var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
                if (password !== "" || password !== null) {
                    if (password.match(regexpass)) {
                        document.getElementById('newpassmsg').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                        if (password === repassword) {
                            document.getElementById('confirmpassmsg').style.color = 'green';
                            document.getElementById('confirmpassmsg').innerHTML = 'password matched';
                            document.getElementById('submit').disabled = false;
                        } else {
                            document.getElementById('confirmpassmsg').style.color = 'red';
                            document.getElementById('confirmpassmsg').innerHTML = 'password not matching';
                            document.getElementById('submit').disabled = true;
                        }
                    } else {
                        document.getElementById('newpassmsg').innerHTML = 'Minimum len 8 & max len 12 where 1 uppercase & 1 digit mandatory';
                        document.getElementById('submit').disabled = true;
                    }
                } else {
                    document.getElementById('newpassmsg').innerHTML = 'Empty password';
                    document.getElementById('submit').disabled = true;
                }
            };
        </script>

        <script>
            function validate() {
                var currentpass = document.chngpwd.password.value;
                var newpass = document.chngpwd.newpassword.value;
                var confirmpass = document.chngpwd.confirmpassword.value;

                if (currentpass === "" || currentpass === null) {
                    document.getElementById('passmsg').style.color = 'red';
                    document.getElementById('passmsg').innerHTML = 'Invalid current password';
                    return false;
                }
                if (newpass === "" || newpass === null) {
                    document.getElementById('newpassmsg').innerHTML = 'Invalid new password';
                    return false;
                }
                if (confirmpass === "" || confirmpass === null) {
                    document.getElementById('confirmpassmsg').innerHTML = 'Invalid confirm password';
                    return false;
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
        

<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Update Password</h4>
                    </div>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container-fluid">
               
           
                <div class="row">
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                           
                                <form class="form-horizontal form-material" method="post" name="chngpwd" onSubmit="return validate();"
                                                      novalidate>
                                    
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Current Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <input class="form-control" id="pass" type="password"
                                                                       name="password" autocomplete="off" required>
                                                                <span id="passmsg" style="font-size: 12px;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">New Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <input class="form-control" id="newpass" type="password"
                                                                       name="newpassword" autocomplete="off"
                                                                       onkeyup="checkPass();" required>
                                                                <span id="newpassmsg" style="font-size: 12px;"></span>
                                        </div>
                                    </div>


                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Confirm New Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <input class="form-control" id="confirmpass" type="password"
                                                                       name="confirmpassword" autocomplete="off"
                                                                       onkeyup="checkPass();" required>
                                                                <span id="confirmpassmsg"
                                                                      style="font-size: 12px;"></span>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button class="btn btn-primary" type="submit"
                                                                            name="submit">Update
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
<?php }?>