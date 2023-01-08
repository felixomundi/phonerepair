<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
include('db_config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {  ?>


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
</head>

<body>
<?php include('includes/header.php');?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Single Repair Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    
                </div>
            </div>

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

                                                as $result) { ?>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>Product: <?php echo htmlentities($result->pname); ?></h3>
                    
                    <h3 class="font-weight-semi-bold mb-4">Repair Price : Ksh.<?php echo htmlentities($result->price); ?></h3>
                    <p class="mb-4">Service:<?php echo htmlentities($result->sname); ?></p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Status:</strong>
                        <form>
                            <div>
                              
                                <label  for="size-1">
                                <?php if($result->status == 0): ?>
						 			<span class="badge badge-warning">Pending</span>
						 		<?php elseif($result->status == 1): ?>
						 			<span class="badge badge-info">Approved</span>
					 			<?php elseif($result->status == 2): ?>
						 			<span class="badge badge-primary">In Progress</span>
					 			
					 			<?php elseif($result->status == 4): ?>
						 			<span class="badge badge-danger">Done</span>
                                     
						 		<?php endif; ?></label>
                            </div>                           
                        </form>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <form>
                            <div>
                               
                                <label for="color-1">Black</label>
                            </div>
                          
                        </form>
                    </div>
                  
                    
                </div>
            </div>
        </div>

        <?php }}?>
        
    </div>
    <!-- Shop Detail End -->



    <?php include('includes/footer.php');?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


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