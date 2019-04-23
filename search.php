<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Studio - Creative Photography Template | Portfolio</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet">

</head>

<body>
    
    <?php

        $data = $_GET['search'];

    ?>

    <!-- Gradient Background Overlay -->
    <div class="gradient-background-overlay"></div>

    <!-- Header Area Start -->
    <header class="header-area bg-img" style="background-image: url(img/bg-img/11.jpg);">
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 h-100">
                    <div class="main-menu h-100">
                        <nav class="navbar h-100 navbar-expand-lg">
                            <!-- Logo Area  -->
                            <a class="navbar-brand" href="index.html"><img src="img/core-img/logo.png"  width="250px" height="100px" alt="Logo"></a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#studioMenu" aria-controls="studioMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i> Menu</button>

                            <div class="collapse navbar-collapse" id="studioMenu">
                                <!-- Menu Area Start  -->
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about-me.html">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="photographers.php">Photographers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.html">Login/Sign Up</a>
                                    </li>
                                </ul>
                                <!-- Search Form -->
                                <div class="header-search-form ml-auto">
                                    <form action="search.php">
                                        <input type="search" class="form-control" placeholder="Input your keyword then press enter..." id="search" name="search">
                                        <input class="d-none" type="submit" value="submit">
                                    </form>
                                </div>
                                <!-- Search btn -->
                                <div id="searchbtn">
                                    <img src="img/core-img/search.png" alt="">
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Social Sidebar Area Start -->
    <div class="social-sidebar-area">
        <!-- Social Area -->
        <div class="social-info-area">
            <a href="#" data-toggle="tooltip" data-placement="right" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i> <span>Facebook</span></a>
            <a href="#" data-toggle="tooltip" data-placement="right" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i> <span>Twitter</span></a>
            <a href="#" data-toggle="tooltip" data-placement="right" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i> <span>Pinterest</span></a>
            <a href="#" data-toggle="tooltip" data-placement="right" title="Behance"><i class="fa fa-instagram" aria-hidden="true"></i> <span>Instagram</span></a>
        </div>
    </div>
    <!-- Social Sidebar Area End -->

    <!-- Project Area Start -->
    <div class="gallery_area clearfix">
        <div class="container-fluid clearfix">
            <div class="gallery_menu">
                <div class="portfolio-menu">
                    <button class="active btn" type="button" data-filter="*">All</button>
                    <button class="btn" type="button" data-filter=".portraits">Portraits</button>
                    <button class="btn" type="button" data-filter=".weddings">Weddings</button>
                    <button class="btn" type="button" data-filter=".studio">Studio</button>
                    <button class="btn" type="button" data-filter=".fashion">Fashion</button>
                    <button class="btn" type="button" data-filter=".life">Lifestyle</button>
                </div>
            </div>

            <div class="row portfolio-column">

            <?php
                require('backend/connect.php');

                // $data = $_GET['search'];
                // echo '<script language="javascript">';
                //     echo "alert('Aloha!')";
                //     echo '</script>';


                if($data != ""){
                    $query="SELECT * FROM public.imagestore WHERE (photographer_id like '%".$data."%') or (category like '%".$data."%') or (tags like '%".$data."%')";  
                    // echo '<script language="javascript">';
                    // echo "alert('data=".$data."!')";
                    // echo '</script>';
                }
                else{
                    $query="SELECT * FROM public.imagestore";  
                    // echo '<script language="javascript">';
                    // echo "alert('Search empty')";
                    // echo '</script>';
                }
                $result = pg_query($connection, $query) or  die('Query failed: ' . pg_last_error());
                if(pg_num_rows($result) > 0){
                    $i=0;
                    $arr=pg_fetch_all($result);
                    while($i < pg_num_rows($result))
                    {
                        $img_file="upload/".$arr[$i]['name'];
                        $category=$arr[$i]['category'];
                        echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 column_single_gallery_item '.strtolower($category).' life">';
                        echo '<img src="'.$img_file.'" alt="">';
                        echo '<div class="hover_overlay">';
                        echo '<a class="gallery_img" href="'.$img_file.'"><i class="fa fa-eye"></i></a>';
                        echo '</div></div>';
                        $i=$i+1;
                    }
                }
                else {
                    // echo '<script language="javascript">';
                    // echo "alert('No result!')";
                    // echo '</script>';
                }

                pg_close($connection);

            ?>
            </div>

            <div class="row">
                <div class="col-12 text-center ">
                    <a href="#" class="btn studio-btn"><img src="img/core-img/logo-icon.png" alt=""> Load More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Project Area End -->


    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>
