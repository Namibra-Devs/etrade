<?php require_once('./config.php'); ?>
<!doctype html>
 <html class="no-js" lang="en">

<head>
     <meta charset="utf-8">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title>ITP || <?= $title ? $title : "" ?></title>
     <meta name="robots" content="noindex, follow" />
     <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!-- Favicon -->
     <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon_2.png">

     <!-- CSS
    ============================================ -->

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
     <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
     <link rel="stylesheet" href="assets/css/vendor/flaticon/flaticon.css">
     <link rel="stylesheet" href="assets/css/vendor/slick.css">
     <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
     <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
     <link rel="stylesheet" href="assets/css/vendor/sal.css">
     <link rel="stylesheet" href="assets/css/vendor/magnific-popup.css">
     <link rel="stylesheet" href="assets/css/vendor/base.css">
     <link rel="stylesheet" href="assets/css/style.css">

     <!-- <link rel="stylesheet" href="assets/css/style.min.css"> -->

     <!-- Include External Header -->

     <?php
  // require_once('sess_auth.php');
  
?>

<style>
    .axil-breadcrumb-area .inner .bradcrumb-thumb::after{
        display: none;
    }
        a.axil-btn.btn-bg-lighter.btn-load-more:hover {
            color: white;
        }

        a.axil-btn.btn-bg-lighter:hover:before {
            background: var(--color-primary) !important;
            color: white !important;
        }
    </style>

<style>
    :root{
      --bg-img:url('<?php echo validate_image($_settings->info('cover')) ?>');
    }
    .alert-danger{
    margin-bottom: 2rem !important;
}

#main-header{
        position:relative;
        background: rgb(0,0,0)!important;
        background: radial-gradient(circle, rgba(0,0,0,0.48503151260504207) 22%, rgba(0,0,0,0.39539565826330536) 49%, rgba(0,212,255,0) 100%)!important;
    }
    #main-header:before{
        content:"";
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-image:url(<?php echo base_url.$_settings->info('cover') ?>);
        background-repeat: no-repeat;
        background-size: cover;
        filter: drop-shadow(0px 7px 6px black);
        z-index:-1;
    }


    select.form-control-lg {
    height: 50px;
    padding: 0.5rem 1rem;
    font-size: 16px;
    border-width: 1px;
}

select.form-control-lg:focus {
    border: 1px solid var(--color-primary);



    outline: none;
    box-shadow: none;
}

.image-preview-container {
  position: relative;
}

.image-preview-container .custom-file-input {
  padding-right: 60px; 
}

.image-preview {
  position: absolute;
  top: 0;
  right: 0;
  width: 50px;
  height: 50px;
  border-radius: 5px;
  overflow: hidden;
  /* box-shadow: 0 0 3px rgba(0, 0, 0, 0.2); */
}

.image-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
  </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> -->
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fullcalendar/main.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">
     <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <style type="text/css">/* Chart.js */
      @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>

    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css"> -->
     <!-- jQuery -->
    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>



     <style>
         a.axil-btn.btn-bg-lighter.btn-load-more:hover {
             color: white;
         }

         a.axil-btn.btn-bg-lighter:hover:before {
             background: var(--color-primary) !important;
             color: white !important;
         }

         .slider-box-wrap{
            background-color: white !important;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
         }
         ul.slick-dots {
    display: none;
}
.main-slider-style-8 .main-slider-thumb:after{
    display: none;
}
     </style>

         <style>
        a.axil-btn.btn-bg-lighter.btn-load-more:hover {
            color: white;
        }

        a.axil-btn.btn-bg-lighter:hover:before {
            background: var(--color-primary) !important;
            color: white !important;
        }
        


a.logo.logo-dark > img, .mobile-nav-brand > img {
    width: 100px;
    height: 100px;
}
    </style>



 </head>


 <body class="sticky-header layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto; font-size: 1.5rem;">
     <script>
         start_loader()
     </script>
     <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
     <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>

  <!-- Start Header -->
  <header class="header axil-header header-style-5">
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <!-- <div class="header-top-dropdown">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    English
                                </button>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    USD
                                </button>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-link">
                            <ul class="quick-link">
                                <!-- <li><a href="#">Help</a></li> -->

                                <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3) : ?>
                                    <li>
                                        <a href="my-account.php">Welcome, <?= !empty($_settings->userdata('lastname')) ? $_settings->userdata('lastname') : $_settings->userdata('email') ?>  </a>
                                    </li>
                                    <li>
                                        <a href="my-account.php">My Account</a>
                                    </li>
                                <?php else : ?>
                                    <li><a href="sign-up.php">Join Us</a></li>
                                    <li><a href="sign-in.php">Sign In</a></li>
                                    <li><a href="terms-of-service.php">Terms of Service</a></li>
                                    <li><a href="privacy-policy.php">Privacy Policy</a></li>
                                <?php endif; ?>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="index.php" class="logo logo-dark">
                        <img src="<?php echo base_url."assets/images/favicon.png" ?>" alt="Site Logo">
                        </a>
                        <a href="index.php" class="logo logo-light">
                        <img src="<?php echo base_url."assets/images/favicon.png" ?>" alt="Site Logo">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index.php" class="logo">
                                    <img src="<?php echo base_url."assets/images/favicon.png" ?>" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li class="menu-item-has-children">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="shop.php">Shop</a>
                                </li>
                                <li><a href="about-us.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <!-- <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input" name="search2" id="search2" value="" maxlength="128" placeholder="What are you looking for?" autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </li> -->
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <!-- <li class="wishlist">
                                <a href="wishlist.php">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li> -->

                            <li class="shopping-cart">
                                <?php $cart_count = 0; ?>
                                <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3) : ?>
                                    <?php
                                    $cart_count = $conn->query("SELECT sum(quantity) FROM `cart_list` where client_id = '{$_settings->userdata('id')}'")->fetch_array()[0];
                                    $cart_count = $cart_count > 0 ? $cart_count : 0;
                                    ?>
                                <?php endif; ?>
                                <a href="cart.php" class="cart-dropdown-btn">
                                    <span class="cart-count"><?= format_num($cart_count) ?></span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">QUICKLINKS</span>
                                    <ul>
                                    <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3) : ?>
                                        <li>
                                            <a href="my-account.php">My Account</a>
                                        </li>
                                    <?php endif; ?>

                                        <!-- <li>
                                            <a href="#">Initiate return</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="#">Support</a>
                                        </li> -->
                                        <li>
                                            <a href="about-us.php">About Us</a>
                                        </li>
                                        <li>
                                            <a href="terms-of-service.php">Terms of Service</a>
                                        </li>
                                        <li>
                                        <a href="privacy-policy.php">Privacy Policy</a>
                                        </li>
                                    </ul>

                                    <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3) : ?>
                                        <a class="axil-btn btn-bg-primary" href="<?= base_url . 'classes/Login.php?f=logout_client' ?>">Logout</a>
                                    <?php else : ?>
                                        <a href="sign-in.php" class="axil-btn btn-bg-primary">Login</a>
                                    <?php endif; ?>
                                    <div class="reg-footer text-center">No account yet? <a href="sign-up.php" class="btn-link">REGISTER HERE.</a></div>
                                </div>
                            </li>
                            <li class="my-account-dropdown">
                                <!-- <li class="sell-button neck"> -->
                                <a href="./vendor/register.php" class="sell-button">Sell</a>
                                <!-- <a href="./vendor/register.php" class="btn btn-primary btn-lg">Sell</a> -->
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
        <!-- <div class="header-top-campaign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-10">
                        <div class="header-campaign-activation axil-slick-arrow arrow-both-side header-campaign-arrow">
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </header>

