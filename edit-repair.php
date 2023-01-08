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
         //$userid=$_POST['userid']; 
         $id = intval($_GET['id']); 
         $sql = "UPDATE `repairs` SET sid=:sid,pid=:pid,price=:price WHERE id=:id ";
         $query = $dbh->prepare($sql);
         $query->bindParam(':sid', $sid, PDO::PARAM_STR);  
         $query->bindParam(':pid', $pid, PDO::PARAM_STR); 
         $query->bindParam(':price', $price, PDO::PARAM_STR);
         $query->bindParam(':id', $id, PDO::PARAM_STR);
        // $query->bindParam(':userid', $userid, PDO::PARAM_STR);
         $query->execute();
 
         echo "<script>alert('Details changed successfully');document.location = 'cart.php';</script>";
     }




    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Online Repair Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
    <link href="css/style.css" rel="stylesheet">



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body>
   
<?php include('includes/header.php');?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Edit Repair</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
    
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form method="post">
                    <?php
                                                $id = intval($_GET['id']);
                                                $sql="SELECT repairs.*,product.pname,services.sname from repairs  inner join product on product.id=repairs.pid inner join services on services.id=repairs.sid and  repairs.id=:id";
                                                 $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                foreach ($results

                                                as $resultz) { ?>
                        <div class="control-group">
                        <label class="col-md-12 p-0">Product Name</label>
                        <select class="form-control" name="pid" id="product">
                        <option value="<?php echo htmlentities($resultz->pid); ?>"><?php echo htmlentities($resultz->pname); ?></option>
				
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
                            <p class="help-block text-danger"></p>
                        </div>


                        <div class="control-group">
                        <label class="col-md-12 p-0">Service Name</label>
                        <select class="form-control" name="sid" id="service">
                        <option value="<?php echo htmlentities($resultz->sid); ?>"><?php echo htmlentities($resultz->sname); ?></option>
                                        <option value="">Select Service</option>
                                        </select>
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="control-group">
                        <label for="service" class="col-md-12 p-0">Price</label>
                        <select class="form-control" name="price" id="price">
                        <option value="<?php echo htmlentities($resultz->price); ?>"><?php echo htmlentities($resultz->price); ?></option>
					<option value="">Select Price</option>
				</select>
                            <p class="help-block text-danger"></p>
                        </div>

                        
                        <div>
                        <button  id="save"name="submit" type="submit" class="btn btn-success">Add Repair</button>
                        </div>
                    </form>
                </div>
                <?php }}?>
            </div>

            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                <iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=pwani university&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">                    
                </iframe>
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

                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i><?php echo htmlentities($result->address); ?></p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i><?php echo htmlentities($result->email); ?></p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+254 <?php echo htmlentities($result->mobile);}} ?></p>
                </div>
            </div>

            
        </div>
    </div>
    <!-- Contact End -->


    <?php include('includes/footer.php');?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


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