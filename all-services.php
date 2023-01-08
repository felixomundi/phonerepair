<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
include('db_config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else { 
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
</head>

<body>
<?php include('includes/header.php');?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#"><span style="color:red">All Product Services</span></a>
                   
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-bordered table-hover text-center mb-0">
                    <thead class="thead-dark">


                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Service</th>
                            <th>Price</th>
                           
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php   
                    $status=1;                  
    $sql="SELECT services.*, product.pname FROM services INNER JOIN product on product.id=services.pid  AND services.status=:status ORDER BY services.id DESC LIMIT 50";              
                                  
                                  $query = $dbh->prepare($sql);
                                   $query->bindParam(':status', $status, PDO::PARAM_STR);                                 
                                   $query->execute();
                                   $results = $query->fetchAll(PDO::FETCH_OBJ);
                                   $cnt = 1;
                                   if ($query->rowCount() > 0) {
                                       foreach ($results as $result) { ?>
                        <tr><td class="align-middle"> <?php echo htmlentities($cnt); ?></td>                       
                            <td class="align-middle"> <?php echo htmlentities($result->pname); ?></td>
                            <td class="align-middle"><?php echo htmlentities($result->sname); ?></td>
                            <td class="align-middle"><?php echo htmlentities($result->price); ?> </td>
                            
                            
                        </tr>
                        <?php $cnt = $cnt + 1;
                                        }
                                    } ?>                        
                    </tbody>
                </table>
            </div>


            <div class="col-lg-4">               
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Available Services</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                    
                    <?php  
           
$status=1;
                     $sql = "SELECT * FROM services where services.status=:status";                
                                     $query = $dbh->prepare($sql);
                                    
                                     $query->bindParam(':status', $status, PDO::PARAM_STR);
                                     $query->execute();
                                     $results = $query->fetchAll(PDO::FETCH_OBJ);
                                     $totalitems = $query->rowCount();
                                     ?>
                                    
                                                
                    <div class="d-flex justify-content-between mb-3">
                            <h6>Total Services </h6>
                            <h6> <?php echo htmlentities($totalitems); ?>  </h6>
                        </div>
                        
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


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