<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
include('db_config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else { 
    

    if (isset($_POST['submit'])) {
        $sid = $_POST['sid'];
        $pid = $_POST['pid'];
        $price = $_POST['price'];  
         $status=1;  
         $userid=$_POST['userid'];      
        $sql = "INSERT INTO repairs(sid,pid,status,price,userid) VALUES(:sid,:pid,:status,:price,:userid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);                
        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
        $query->bindParam(':userid', $userid, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Repair  Added successfully');document.location = 'manage-repairs.php';</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    }  
    
    
    if (isset($_POST['update'])) {     
        $id=intval($_GET['id']);   
        $status=$_POST['status'];           
        $sql5 = "UPDATE `repairs` SET  `status`=:status WHERE id=:id";         
        $query = $dbh->prepare($sql5);
        $query->bindParam(':status', $status, PDO::PARAM_STR);         
        $query->bindParam(':id', $id, PDO::PARAM_STR); 
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Status  updated successfully');document.location = 'manage-repair.php';</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    }  




    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
   
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css1/style.css" rel="stylesheet">
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
                        <h4 class="page-title">View Repair details</h4>
                    </div>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container-fluid">


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">

<!------>
<form method="post">
<h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Client Details</span></h5>
<?php
                                                $id = intval($_GET['id']);
                                                $sql1="SELECT repairs.*,users.lname,users.fname,users.email,users.contact,product.pname,services.sname from repairs inner join users on users.id=repairs.userid inner join product on product.id=repairs.pid inner join services on services.id=repairs.sid and  repairs.id=:id";
                                                 $query1 = $dbh->prepare($sql1);
                                                $query1->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query1->execute();
                                                $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query1->rowCount() > 0) {
                                                foreach ($results1

                                                as $resultz) { ?>
                <div class="bg-light p-30 mb-5">

                    <div class="row">
                        <div class="col-md-6 form-group">
                           
                            <input class="form-control" type="hidden" name="userid" value="<?php echo htmlentities($resultz->userid); ?>" >
                            <input class="form-control" type="text" disabled value="<?php echo htmlentities($resultz->fname); ?> <?php echo htmlentities($resultz->lname); ?> " >
                        </div>
                        <div class="col-md-6 form-group">                           
                          
                           <input class="form-control" type="text" disabled value="<?php echo htmlentities($resultz->pname); ?> " >
                       </div>
                       
                      
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                           
                            <input class="form-control" type="text" disabled value="<?php echo htmlentities($resultz->sname); ?>  " >
                        </div>
                        <div class="col-md-6 form-group">                           
                          
                           <input class="form-control" type="text" disabled value="Ksh : <?php echo htmlentities($resultz->price); ?> " >
                       </div>


                       <div class="row">
                        <div class="col-md-6 form-group">
                        <input class="form-control" type="text" disabled value=" Date booked: <?php echo htmlentities($resultz->date_created); ?>  " >
                        </div>
                        <div class="col-md-6 form-group">                       
                          
                          <input class="form-control" type="text" disabled value="Done Date : <?php echo htmlentities($resultz->done_date); ?> " >
                      </div>
                </div>

                <div class="row">
                        <div class="col-md-6 form-group">
                        <input class="form-control" type="text" disabled value=" Email: <?php echo htmlentities($resultz->email); ?>  " >
                        </div>
                        <div class="col-md-6 form-group">                       
                          
                          <input class="form-control" type="text" disabled value="Contact : <?php echo htmlentities($resultz->contact); ?> " >
                      </div>
                </div>


                    </div>
                </div>



                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment Status</span></h5>
                <div class="bg-light p-30 mb-5">

<div class="row">
    <form method="post">
    <div class="col-md-6 form-group">
        <label>Payment Status</label>
        
<option value="1"> <span style="color:blue;"> <b><?php echo htmlentities($resultz->pay_status); ?> </b> </span></option>

    </div>
   
</div>
</form>

</div>



<?php }}?>
<!------->

                
            </div>
           
    </div>
    <!-- Checkout End -->


    </div>
                
                </div>
    
    
    
    
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
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



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>





</body>

</html>
<?php }?>