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
                
                    <span class="breadcrumb-item active">Repair Cart</span>
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
                            <th>Date Booked</th>
                            <th>Products</th>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Repair Status</th> 
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php
                                   
                                   $email1 = $_SESSION['login'];
                                   $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
                                   $query1 = $dbh->prepare($sql1);
                                   $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
                                   $query1->execute();
                                   $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                   if ($query1->rowCount() > 0) {
                                       foreach ($results1 as $result1) {
                                           $uid = $result1->id;
                                       }
                                   }

                                   $status = 1;
                                   $sql = "SELECT repairs.*, product.pname,services.sname FROM repairs INNER JOIN product on product.id=repairs.pid INNER JOIN services on services.id=repairs.sid and  repairs.userid=:uid AND repairs.status=:status";
                                   $query = $dbh->prepare($sql);
                                   $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                   $query->bindParam(':status', $status, PDO::PARAM_STR);
                                   $query->execute();
                                   $results = $query->fetchAll(PDO::FETCH_OBJ);
                                   $cnt = 1;
                                   if ($query->rowCount() > 0) {
                                       foreach ($results as $result) { ?>
                        <tr><td class="align-middle"> <?php echo htmlentities($cnt); ?></td>
                        <td class="align-middle"> <?php echo htmlentities($result->date_created); ?></td>
                            <td class="align-middle"><?php echo htmlentities($result->pname); ?></td>
                            <td class="align-middle"><?php echo htmlentities($result->sname); ?></td>
                            <td class="align-middle"><?php echo htmlentities($result->price); ?> </td>
                            <td class="align-middle">
                            <?php if($result->status == 0): ?>
						 			<span class="badge badge-warning">Pending</span>
						 		<?php elseif($result->status == 1): ?>
						 			<span class="badge badge-info">Approved</span>
					 			<?php elseif($result->status == 2): ?>
						 			<span class="badge badge-primary">In Progress</span>
					 			
					 			<?php elseif($result->status == 4): ?>
						 			<span class="badge badge-danger">Done</span>
                                     
						 		<?php endif; ?> </td>
                                 <td class="align-middle"><?php echo htmlentities($result->pay_status); ?></td>
                            <td class="align-middle"> 
                                

                                                <a class="btn btn-sm btn-info" href="edit-repair.php?id=<?php echo $result->id; ?>">
                                                <i class="fa fa-edit"></i>
                                                </a>
                                                <a  class="btn btn-success border btn-flat btn-sm" href="view-repair.php?id=<?php echo $result->id; ?>">
                                                <i class="fa fa-eye"></i>
                                                </a>
                            
                            </td>
                        </tr>
                        <?php $cnt = $cnt + 1;
                                        }
                                    } ?>                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">               
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                    <?php  
                                     $email1 = $_SESSION['login'];
                                     $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
                                     $query1 = $dbh->prepare($sql1);
                                     $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
                                     $query1->execute();
                                     $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                     if ($query1->rowCount() > 0) {
                                         foreach ($results1 as $result1) {
                                             $uid = $result1->id;
                                         }
                                     }
 
                                     $status = 1;    
                                     
                                    $sql = "SELECT * FROM repairs WHERE  repairs.status=:status and repairs.userid=:uid order by repairs.id desc ";                
                                     $query = $dbh->prepare($sql);
                                     $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                     $query->bindParam(':status', $status, PDO::PARAM_STR);
                                     $query->execute();
                                     $results = $query->fetchAll(PDO::FETCH_OBJ);
                                     $totalitems = $query->rowCount();
                                     ?>
                                    
                                                
                    <div class="d-flex justify-content-between mb-3">
                            <h6>Total Items</h6>
                            <h6> <?php echo htmlentities($totalitems); ?>  </h6>
                        </div>
                        
                    </div>
                    <div class="pt-2">
                    <?php  
                                     $email1 = $_SESSION['login'];
                                     $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
                                     $query1 = $dbh->prepare($sql1);
                                     $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
                                     $query1->execute();
                                     $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                     if ($query1->rowCount() > 0) {
                                         foreach ($results1 as $result1) {
                                             $uid = $result1->id;
                                         }
                                     }
 
                                     $status = 1;
                                                                 
                                    $sql = "SELECT sum(price) from repairs where repairs.userid=:uid and repairs.status=:status";
                                       
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                        $query->bindParam(':status', $status, PDO::PARAM_STR);
                                        $query->execute();
                                        $total = $query->fetch(PDO::FETCH_NUM);{
                                       
                                       ?>
                    <div class="d-flex justify-content-between mt-2">
                            <h5>Total Repair Price</h5>
                            <h5>Ksh.<?php echo $totalprice=$total[0];}?></h5>
                        </div>


                        <a class="btn btn-block btn-primary font-weight-bold my-3 py-3"> LIPA NA MPESA :6756454 </a>
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