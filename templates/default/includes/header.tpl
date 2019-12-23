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
    {literal}
        <!-- Google Tag Manager -->

        <!-- End Google Tag Manager -->
    {/literal}
</head>

<body>
<div class="se-pre-con"></div>
<header>
    <!-- Mobile Menu Start -->
    <div class="mobile-menu-area navbar-fixed-top hidden-sm hidden-md hidden-lg">
        <nav class="mobile-menu" id="mobile-menu">
            <div class="sidebar-nav">
                {get_menu_by_mobile('header')}
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
    <!-- top banner -->
    <div class="top_banner_wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <div class="header-logo">
                        <!-- logo -->
                        <a href="home-style-one.html">
                            <img class="td-retina-data img-responsive" src="{base_url('templates/default/assets/')}images/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 col-md-8 col-sm-8 hidden-xs">
                    <div class="header-banner">
                        <a href="#"><img class="td-retina img-responsive" src="{base_url('templates/default/assets/')}images/top-bannner.jpg" alt=""></a>
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