<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else{



    if (isset($_POST['submit'])) {
        $amount= $_POST['amount'];
        $refno= $_POST['refno'];          
        $status=1;  
        
        $email3 = $_SESSION['login'];

        $sql3 = "SELECT `id` FROM `users` WHERE `email`=:email3";
        $query3 = $dbh->prepare($sql3);
        $query3->bindParam(':email3', $email3, PDO::PARAM_STR);
        $query3->execute();
        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
        if ($query3->rowCount() > 0) {
            foreach ($results3 as $result3) {
                $uid = $result3->id;
            }
        }
        

        //$userid=$_POST['userid'];      
        $sql = "INSERT INTO payment(amount,refno,status,userid) VALUES(:amount,:refno,:status,:uid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':amount', $amount, PDO::PARAM_STR);
        $query->bindParam(':refno', $refno, PDO::PARAM_STR);                
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Payment  Added successfully wait for admin approval');document.location = 'manage-payments.php';</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
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
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Add Payment</span>
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
                        
                        <div class="control-group">
                        <label class="col-md-12 p-0">Amount</label>                       

                  <input name="amount" type="number" class="form-control" min="0" max="1000000" step="any">

                            <p class="help-block text-danger"></p>
                        </div>


                        <div class="control-group">
                        <label class="col-md-12 p-0">REFNO</label>
                        <input name="refno" class="form-control" type="text">
                                        
                            <p class="help-block text-danger"></p>
                        </div>


                        
                        <div>
                        <button  id="save"name="submit" type="submit" class="btn btn-success">Pay</button>
                        </div>
                    </form>
                </div>
            </div>

            

            
        </div>
    </div>
    <!-- Contact End -->


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