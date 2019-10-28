<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{base_url('templates/default/assets/')}images/fev-icon.png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>newspaper</title>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{base_url('templates/default/assets/')}css/bootstrap.min.css">
    <!-- Scrollbar css -->
    <link rel="stylesheet" type="text/css" href="{base_url('templates/default/assets/')}css/jquery.mCustomScrollbar.css" />
    <!-- Owl Carousel css -->
    <link rel="stylesheet" type="text/css" href="{base_url('templates/default/assets/')}owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="{base_url('templates/default/assets/')}owl-carousel/owl.theme.css" />
    <link rel="stylesheet" type="text/css" href="{base_url('templates/default/assets/')}owl-carousel/owl.transitions.css" />
    <!-- youtube css -->
    <link rel="stylesheet" type="text/css" href="{base_url('templates/default/assets/')}css/RYPP.css" />
    <!-- jquery-ui css -->
    <link rel="stylesheet" href="{base_url('templates/default/assets/')}css/jquery-ui.css">
    <!-- animate -->
    <link rel="stylesheet" href="{base_url('templates/default/assets/')}css/animate.min.css">
    <!-- fonts css -->
    <link rel="stylesheet" href="{base_url('templates/default/assets/')}font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{base_url('templates/default/assets/')}css/Pe-icon-7-stroke.css" />
    <link rel="stylesheet" type="text/css" href="{base_url('templates/default/assets/')}css/flaticon.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="{base_url('templates/default/assets/')}css/style.css">
</head>

<body>
<div class="se-pre-con"></div>
<header>
    <!-- Mobile Menu Start -->
    <div class="mobile-menu-area navbar-fixed-top hidden-sm hidden-md hidden-lg">
        <nav class="mobile-menu" id="mobile-menu">
            <div class="sidebar-nav">
                <ul class="nav side-menu">
                    {get_menu_by_name('header')}
                    <!-- social icon -->
                    <li>
                        <div class="social">
                            <ul>
                                <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                                <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                                <li><a href="#" class="google"><i class="fa  fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="top_header_icon">
                    <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                        </span>
                <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                        </span>
                <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                        </span>
                <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                        </span>
                <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                        </span>
            </div>
            <div id="showLeft" class="nav-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- Mobile Menu End -->
    <!-- top header -->
    <div class="top_header hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="top_header_menu_wrap">
                        <ul class="top-header-menu">
                            <li><a href="login%26registration.html">REGISTER</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">LOGIN</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="login-inner">
                                            <input type="text" class="form-control" id="name_email" name="name_email" placeholder="username or emaile">
                                            <hr>
                                            <input type="password" class="form-control" id="pass" name="pass" placeholder="*******">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="">Remember me</label>
                                            <button type="button" class="btn btn-lr btn-active">LOGIN</button>
                                            <button type="button" class="btn btn-lr">REGISTR</button>
                                            <div class="foeget"><a href="#">Forget username/password?</a></div>
                                            <div class="social_icon">
                                                <div class="social_icon_box social_icon_box_1">
                                                    <div class="icon facebook-icon"></div>
                                                    <span class="social_info">Login with facebook</span>
                                                </div>
                                            </div>
                                            <div class="social_icon">
                                                <div class="social_icon_box social_icon_box_2">
                                                    <div class="icon twitter-icon"></div>
                                                    <span class="social_info">Login with twitter</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="contact-style-two.html">CONTACT</a></li>
                        </ul>
                    </div>
                </div>
                <!--breaking news-->
                <div class="col-sm-8 col-md-7">
                    <div class="newsticker-inner">
                        <ul class="newsticker">
                            <li><span class="color-1">Fashion</span><a href="#">Etiam imperdiet volutpat libero eu tristique.imperdiet volutpat libero eu tristique.</a></li>
                            <li><span class="color-2">International</span><a href="#">Curabitur porttitor ante eget hendrerit adipiscing.</a></li>
                            <li><span class="color-3">Health</span><a href="#">Praesent ornare nisl lorem, ut condimentum lectus gravida ut.</a></li>
                            <li><span class="color-4">technology</span><a href="#">Nunc ultrices tortor eu massa placerat posuere.</a></li>
                            <li><span class="color-1">Travel</span><a href="#">Etiam imperdiet volutpat libero eu tristique.imperdiet volutpat libero eu tristique.</a></li>
                        </ul>
                        <div class="next-prev-inner">
                            <a href="#" id="prev-button"><i class='pe-7s-angle-left'></i></a>
                            <a href="#" id="next-button"><i class='pe-7s-angle-right'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="top_header_icon">
                            <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                                </span>
                        <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                                </span>
                        <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                                </span>
                        <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                                </span>
                        <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                                </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="top_banner_wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <div class="header-logo">
                        <!-- logo -->
                        <a href="home-style-one.html">
                            <img class="td-retina-data img-responsive" src="images/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 col-md-8 col-sm-8 hidden-xs">
                    <div class="header-banner">
                        <a href="#"><img class="td-retina img-responsive" src="images/top-bannner.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navber -->
    <div class="container hidden-xs">
        <nav class="navbar">
            <div class="collapse navbar-collapse">
                {get_menu_by_name('header')}

            </div>
            <!-- navbar-collapse -->
        </nav>
    </div>
</header>