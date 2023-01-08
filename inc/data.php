                                <?php 
                                function getcategoryblogs($poz,$id){

                                $con=mysqli_connect("localhost","root","","kilifi");
                                // Check connection
                                if (mysqli_connect_errno())
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }

                                $sql="SELECT poz.*, categories.cat_name FROM poz INNER JOIN categories WHERE categories.id=poz.category_id  AND poz.category_id='$id' ORDER BY poz.id DESC LIMIT 50";
                                if ($result=mysqli_query($con,$sql))
                                {
                                //count number of rows in query result
                                $rowcount=mysqli_num_rows($result);
                                //if no rows returned show no news alert
                                if ($rowcount==0) {
                                # code...
                                echo 'No Blogs Available at the moment';
                                }
                                //if there are rows available display all the results
                                foreach ($result as $categories => $cdata) {
                                # code...
                                echo 
                                '

                                <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="photo/'.$cdata['Profile'].'" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">'.$cdata['cat_name'].'  </a>
                                        <span class="px-1">/</span>
                                        
                                <small>'.$cdata['username'].'
                                </small>
                                <span class="px-1">/</span>   
                                <small>'.$cdata['created_date'].'
                                </small>
                                    </div>
                                    <a class="h4" href="single.php?id='.$cdata['id'].'" > '.$cdata['title'].'</a>
                                
                                    <a href="single.php?id='.$cdata['id'].'" class="btn btn-primary read-m">Read More</a>
                                </div>
                            </div>
            ';
                                }
                                }

                                mysqli_close($con);
                                }

                                function countcategories(){

                                $con=mysqli_connect("localhost","root","","kilifi");
                                // Check connection
                                if (mysqli_connect_errno())
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }
                                $sql="SELECT * FROM categories order by ID DESC LIMIT 5";
                                if ($result=mysqli_query($con,$sql))
                                {
                                //count number of rows in query result
                                $rowcount=mysqli_num_rows($result);
                                //if no rows returned show no news alert
                                if ($rowcount==0) {
                                # code...
                                echo 'No Categories!!';
                                }
                                //if there are rows available display all the results
                                foreach ($result as $categoriescount => $categorydata) {
                                #count how many times each category appears in blogs
                                $categoryid=$categorydata['id'];
                                $sql="SELECT * FROM poz WHERE category_id='$categoryid'";
                                if ($result=mysqli_query($con,$sql)) {
                                # code...
                                $rowcountcategory=mysqli_num_rows($result);
                                $getcatcount=$rowcountcategory;
                                }
                                # code...show data
                                echo '<a href="./category.php?id='.$categoryid.'" style="color:unset">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                '.$categorydata['cat_name'].'
                                <span class="badge badge-success badge-pill">'.$rowcountcategory.'</span>
                                </li></a>';
                                }
                                }

                                mysqli_close($con);
                                }


                                function getolderposts($poz){

                                $con=mysqli_connect("localhost","root","","kilifi");
                                // Check connection
                                if (mysqli_connect_errno())
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }
                                $sql="SELECT poz.*, categories.cat_name  FROM poz INNER JOIN  categories WHERE categories.id=poz.category_id AND  poz.status = 1 ORDER BY poz.id ASC LIMIT 3";

                                if ($result=mysqli_query($con,$sql))
                                {
                                //count number of rows in query result
                                $rowcount=mysqli_num_rows($result);
                                //if no rows returned show no posts alert
                                if ($rowcount==0) {
                                # code...
                                echo 'No Posts To Fetch';
                                }
                                //if there are rows available display all the results
                                foreach ($result as $olderposts => $op) {
                                # code...
                                echo 

                                '  
                                <div class="d-flex mb-3">
                                <img src="photo/'.$op['Profile'].'" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        
                                        <span class="px-1">/</span>
                                        <span>'.$op['created_date'].'</span>
                                    </div>
                                    <a class="h6 m-0" href="single.php?id='.$op['id'].'">'.$op['title'].'</a>
                                </div>
                            </div>
            
                                ';
                                }
                                }
                                mysqli_close($con);
                                }

                                function getrecentposts($poz){

                                $con=mysqli_connect("localhost","root","","kilifi");
                                // Check connection
                                if (mysqli_connect_errno())
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }
                                
                                
                                $sql="SELECT poz.*, categories.cat_name  FROM poz INNER JOIN  categories WHERE categories.id=poz.category_id AND  poz.status = 1 ORDER BY poz.id DESC LIMIT 6";

                                if ($result=mysqli_query($con,$sql))
                                {
                                //count number of rows in query result
                                $rowcount=mysqli_num_rows($result);
                                //if no rows returned show no posts alert
                                if ($rowcount==0) {
                                # code...
                                echo 'No Posts To Fetch';
                                }
                                //if there are rows available display all the results
                                foreach ($result as $recentposts => $rc) {
                                # code...
                                echo 

                                '


                                <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="photo/'.$rc['Profile'].'" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                <a href="">  '.$rc['cat_name'].' </a>
                                <span class="px-1">/</span>
                                <span> '.$rc['created_date'].'   </span>
                                </div>
                                <a class="h4" href="single.php?id='.$rc['id'].'"> '.$rc['title'].' </a>
                                <p class="m-0">'.$rc['username'].' </p>
                                </div>
                                </div>
                                </div>


                                ';
                                }
                                }
                                mysqli_close($con);
                                }



                                function getcategoriesmenu($categories)
                                {  
                                     $con=mysqli_connect("localhost","root","","kilifi");
                                    // Check connection
                                    if (mysqli_connect_errno())
                                    {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                    }
                                    
                                    //require("database/db_connect.php");
                                    $sql="SELECT * FROM categories ";
                                    if ($result=mysqli_query($con,$sql))
                                    {
                                          //count number of rows in query result
                                        $rowcount=mysqli_num_rows($result);
                                          //if no rows returned show no categories alert
                                        if ($rowcount==0) {
                                              # code...
                                            echo 'No Categories';
                                        }
                                          //if there are rows available display all the results
                                        foreach ($result as $blog_categories => $category) {
                                          # code...
                                            echo '<a class="dropdown-item" href="category.php?id='.$category['id'].'">'.$category['cat_name'].'</a>
                                            <div class="dropdown-divider"></div>';
                                        }
                                    }
                                
                                    mysqli_close($con);
                                }


                                ?>

