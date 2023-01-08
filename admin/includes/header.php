<header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-primary">
                <div class="navbar-header" data-logobg="skin6">
                    
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                    


                        <li>
                        <?php
                    $email = $_SESSION['alogin'];
                    $sql2 = "SELECT `username`,`profilepic` FROM `admin` WHERE `email`=:email;";
                    $query = $dbh->prepare($sql2);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            
                
                    ?>    

                            <a class="profile-pic" href="#">
                                <img 
src="photos/<?php echo htmlentities($result->profilepic); ?>" 
                                  width="36"
                                    class="img-circle"><span class="text-white font-medium">
                                    <?php echo htmlentities($result->username);}} ?>
                                    
                        </span></a>
                        </li>
                    </ul>
                </div>
            </nav>
</header>