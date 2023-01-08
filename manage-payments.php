<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
include('db_config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else { 
    


    if (isset($_REQUEST['del'])) {
        $delid = intval($_GET['del']);
        $sql = "DELETE FROM repairs WHERE id=:delid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':delid', $delid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Repair deleted');document.location = 'cart.php';</script>";
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
</head>

<body>
<?php include('includes/header.php');?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    
                    
                    <a  class="btn btn-primary" href="add-payment.php"> Add New Payment </a>
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
                            <th>Date Approved</th>
                            <th>Amount</th>
                            <th>Refno</th>
                            
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

                                   $status = 0;
                                   $sql = "SELECT *  FROM payment where payment.userid=:uid and payment.status=:status";
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
                         <td class="align-middle"><?php echo htmlentities($result->amount); ?></td>
                            <td class="align-middle"><?php echo htmlentities($result->refno); ?> </td>
                            
                            
                        </tr>
                        <?php $cnt = $cnt + 1;
                                        }
                                    } ?>                        
                    </tbody>
                </table>
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