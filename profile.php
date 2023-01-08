<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
include('db_config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else 
{
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $email = $_SESSION['login'];

    $sql1 = "UPDATE `users` SET `fname`=:fname,`lname`=:lname,`email`=:email,`contact`=:contact WHERE `email`=:email";
    $query = $dbh->prepare($sql1);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':lname', $lname, PDO::PARAM_STR);
    $query->bindParam(':contact', $contact, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);

    $query->execute();
    echo "<script>alert('User UPDATED');document.location = 'profile.php';</script>";
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
                    <span class="breadcrumb-item active">Update Profile</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Update Profile</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <?php
                        $email = $_SESSION['login'];
                        $sql2 = "SELECT * FROM `users` WHERE `email`=:email";
                        $query = $dbh->prepare($sql2);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                        foreach ($results

                        as $result) { ?>
                    <form method="post">
                        <div class="control-group">
                        <label for="example-email" class="col-md-12 p-0">FNAME</label>
                            <input type="text" class="form-control" id="name"value="<?php echo htmlentities($result->fname); ?>"  placeholder="Your FName"
                                required="required" name="fname" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="control-group"><label for="example-email" class="col-md-12 p-0">LNAme</label>
                            <input type="text"  placeholder="Your LName"  value="<?php echo htmlentities($result->lname); ?>" name="lname" class="form-control" id="name"
                                required="required"  />
                            <p class="help-block text-danger"></p>
                        </div>


                        <div class="control-group">

                        <label for="example-email" class="col-md-12 p-0">Email</label>
                        <input type="email" name="email"
                                                class="form-control" required="true" value="<?php echo htmlentities($result->email); ?>"
                                                id="example-email">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <label class="col-md-12 p-0">Phone No</label>
                        <input type="number" name="contact" required="true"  value="<?php echo htmlentities($result->contact); ?>"
                                                class="form-control">
                            <p class="help-block text-danger"></p>
                        </div>
                        
                        <div>
                        <button name="submit" type="submit" class="btn btn-success">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
              
                                        <img
src="photos/d41d8cd98f00b204e9800998ecf8427e1656931295.jpg"  
width="300" height="200" style="border:solid 1px #000"> 
     <div>                              
<a href="#"> </a> 

                        </div>


                </div>
                
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <?php }
                            } ?>

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