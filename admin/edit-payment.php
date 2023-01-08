<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');

include('db_config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {


    if (isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        $refno = $_POST['refno'];           
        $userid=$_POST['userid'];
         $id = intval($_GET['id']); 
         $sql = "UPDATE `payment` SET amount=:amount, refno=:refno, userid=:userid WHERE id=:id ";
         $query = $dbh->prepare($sql);       
         $query->bindParam(':amount', $amount, PDO::PARAM_STR);
         $query->bindParam(':refno', $refno, PDO::PARAM_STR);                
        // $query->bindParam(':status', $status, PDO::PARAM_STR);
         $query->bindParam(':userid', $userid, PDO::PARAM_STR);
 
         $query->execute();
 
         echo "<script>alert('Payment details changed successfully');document.location = 'manage-payments.php';</script>";
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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
                        <h4 class="page-title">Edit Payment Details</h4>
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
                                <?php $sql = "SELECT payment.*, users.fname, users.lname FROM payment inner join users on users.id=payment.userid  WHERE payment.`status`=1";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                                ?>
                                <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">User Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select  class="form-control" name="userid" required="true">
                                        <option value="<?php echo htmlentities($result->userid); ?>"> <?php echo htmlentities($result->fname); ?> <?php echo htmlentities($result->lname); ?> </option>
               <option> --Select --</option>
                  <?php $ret="select id, fname,lname from users";
                  $query= $dbh -> prepare($ret);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $resultz)
                  {
                   
                  ?>
                                            <option value="<?php echo htmlentities($resultz->id); ?> "> <?php echo htmlentities($resultz->fname); ?>  <?php echo htmlentities($resultz->fname); ?>
                                            </option>
                                        <?php }
                                    } ?>
                                </select>
                                    </div>
                </div>


                                 

                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Amount</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <input  required="true" class="form-control" min="10" type="number" max="10000000" value="<?php echo htmlentities($result->amount); ?>" step="any" name="amount">
                                        
                                    </div>
                </div>
                                    <div class="form-group mb-4">
                                        <label for="service" class="col-md-12 p-0">REFNO</label>
                                        <div class="col-md-12 border-bottom p-0">                                       
				<input type="text" class="form-control" required="true" value="<?php echo htmlentities($result->refno); ?>" name="refno">
               
             </div>
             </div>
             

             <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button  id="save"name="submit" type="submit" class="btn btn-success">Edit Repair</button>
                                        </div>
                                    </div>
                                <?php }}?>
                                   
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