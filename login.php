
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (!empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = 1;
        $sql = "SELECT email,password FROM users WHERE email=:email AND password=:password AND status=:status";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $_SESSION['login'] = $_POST['email'];
            $currentpage = $_SESSION['redirectURL'];
            echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Electronic Repairs Shop</title>
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
    
    <script type="text/javascript">
            function validate() {
                let email = document.userlogin.email.value;
                let pass = document.userlogin.password.value;
                if (email === "" || email === null && pass === "" || pass === null) {
                    //alert("Please provide your email and password");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                    //document.userlogin.password.focus() ;
                    return false;
                }
                if (email === "" || email === null) {
                    //alert("Please provide your email");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.userlogin.email.focus();
                    return false;
                } else {
                    var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (email.match(mailformat)) {
                        if (pass === "" || pass === null) {
                            //alert("Please provide your password");
                            document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                            document.userlogin.password.focus();
                            return false;
                        }
                        return true;
                        // when password field is not empty
                    } else {
                        document.getElementById('emailcheck').innerHTML = 'Enter a correct email address';
                        document.userlogin.email.focus();
                        return false;
                    }
                }
            }
        </script>
</head>

<body class="bg-primary">


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-primary pr-3">Fill your details and login to our system </span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form class="user" method="post" id="userform" name="userlogin"
                                              onsubmit="return validate();" novalidate>
                        <div class="control-group">
                        <input type="email" class="form-control p-4"
                                                       id="email" aria-describedby="emailHelp" name="email"
                                                       autocomplete="off"
                                                       placeholder="Enter Email Address...">
                                                <span id="emailcheck" style="font-size: 12px; color: red;"></span>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="password" class="form-control p-4"
                                                       id="password" placeholder="Password" name="password"
                                                       autocomplete="off">
                                                <span id="passwordcheck" style="font-size: 12px; color: red;"></span>
                            <p class="help-block text-danger"></p>
                        </div>  
                        <div class="control-group">
                        <input class="btn btn-primary font-weight-semi-bold px-4" type="submit"  style="height: 50px;" value="Login" name="login" id="sendMessageButton">
                        </div><br/>

                            
                                        </form>
                                        
                                    <div class="modal-footer text-center">
                                    <p>Don't have an account? <a href="register.php" class="btn btn-danger" align="right" style="height: 50px;">Register Here</a></p>
                                    <p><a href="forgotpassword.php" class="btn btn-warning">Forgot Password ?</a></p>
                                    </div>
                                    </div>
                                    </div>
          
        </div>
    </div>
    <!-- Contact End -->


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
    
<script src="js/jquery.min.js"></script>
</body>

</html>

<?php }?>