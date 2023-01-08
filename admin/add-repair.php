<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');

include('db_config.php');
if (strlen($_SESSION['alogin']) == 0) {
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
                        <h4 class="page-title">Add New Pepair Service</h4>
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

                                <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">User Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select  name="userid" required="true">
                  <option value="">Select User </option>
                  <?php $ret="select id, fname,lname from users";
                  $query= $dbh -> prepare($ret);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                   // $name = $result->fname . " " . $result->lname;
                  ?>
                                            <option value="<?php echo htmlentities($result->id); ?> "> <?php echo htmlentities($result->fname); ?>  <?php echo htmlentities($result->fname); ?>
                                            </option>
                                        <?php }
                                    } ?>
                                </select>
                                    </div>
                </div>


                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select class="form-control" required="true" name="pid" id="product">
					<option value="">Select Product</option>
					<?php 
					$query = "SELECT * FROM product";
					$result = $con->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['id'].'">'.$row['pname'].'</option>';
						}
					}else{
						echo '<option value="">Product you are seeking is not available</option>'; 
					}
					?>
				</select>
                                
                            </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Service Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select class="form-control" required="true" name="sid" id="service">
                                        <option value="">Select Service</option>
                                        </select>
                                    </div>
                </div>
                                    <div class="form-group mb-4">
                                        <label for="service" class="col-md-12 p-0">Price</label>
                                        <div class="col-md-12 border-bottom p-0">
                                       
				<select class="form-control" required="true" name="price" id="price">
					<option value="">Select Price</option>
				</select>
             </div>
             </div>
                                   
             <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button  id="save"name="submit" type="submit" class="btn btn-success">Add Repair</button>
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
  <script type="text/javascript">
    $(document).ready(function(){
      // Country dependent ajax
      $("#product").on("change",function(){
        var productId = $(this).val();
        $.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{productId:productId},
          success:function(data){
            $("#service").html(data);
            $('#price').html('<option value="">Select Price</option>');
          }
        });			
      });

      // state dependent ajax
      $("#service").on("change", function(){
        var serviceId = $(this).val();
        $.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{serviceId:serviceId},
          success:function(data){
            $("#price").html(data);
          }
        });
      });
    });
  </script>


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