<?php require_once('./config.php'); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ITP || Forgot Password</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

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
    <link rel="stylesheet" href="assets/css/style.min.css">

    <?php
     require_once "inc/header_1.php"; 
     ?>

     
    <style>
        .alert-danger {
            margin-bottom: 2rem !important;
        }

        select.form-control-lg {
            height: 50px;
            padding: 0.5rem 1rem;
            font-size: 16px;
            border-width: 1px;
        }

        .form-group input:focus {
            border-color: var(--color-primary);
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

        .bg_image--10 {
            background-image: url("./assets/images/bg/bg-image-15.png");
        }

        .bg_image>.title {
            position: absolute;
            top: 50px;
            left: 65px;
        }

        .axil-btn.btn-bg-secondary.sign-up-btn::before {
            background-color: var(--color-primary);
        }

        .axil-btn.btn-bg-primary.submit-btn::before {
            background-color: var(--color-primary);
        }
    </style>



</head>


<body class="hold-transition">
  <script>
    start_loader()
  </script>

<?php if ($_settings->chk_flashdata('success')) : ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
      </script>
    <?php endif; ?>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-xl-4 col-sm-6">
                    <!-- <a href="index.php" class="site-logo"><img src="./assets/images/logo/logo.png" alt="logo"></a> -->
                </div>
                <div class="col-md-2 d-lg-block d-none">
                    <!-- <a href="sign-in.php" class="back-btn"><i class="far fa-angle-left"></i></a> -->
                </div>
                <div class="col-xl-6 col-lg-4 col-sm-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="sign-in.php" class="sign-up-btn axil-btn btn-bg-secondary">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    <h3 class="title">We Offer the Best Products</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Forgot Password?</h3>
                        <p class="b2 mb--55">Enter the email address you used when you joined and we’ll send you instructions to reset your password.</p>
                        <form id="forgot-password" class="singin-form">
                            <input type="hidden" name="ref" id="ref" value="<?=isset($_GET['ref']) ? $_GET['ref'] : ''?>">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="annie@example.com">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Send Reset Instructions</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/js.cookie.js"></script>
    <!-- <script src="assets/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/sal.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="assets/js/vendor/counterup.js"></script>
    <script src="assets/js/vendor/waypoints.min.js"></script>

    

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    




    
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
<script>


$(document).ready(function(){
    $('#forgot-password').on('submit', function(e){
        e.preventDefault();
        var _this = $(this)
          $('.err-msg').remove();
          var el = $('<div>')
          el.addClass("alert err-msg")
          el.hide()
        var email = $('#email').val();
        $.ajax({
    url:_base_url_+"classes/Users.php?f=forgot_password",
    data: new FormData($(this)[0]),
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST',
    dataType: 'json',
    error:err=>{
        console.error(err)
        el.addClass('alert-danger').text("An error occured");
        _this.prepend(el)
        el.show('.modal')
        end_loader();
    },
    success:function(resp){
        if(typeof resp =='object' && resp.status == 'success'){
            // alert(resp.msg)
       
            // location.reload()
            console.log(resp.msg);
        }else if(resp.status == 'failed' && !!resp.msg){
            el.addClass('alert-danger').text(resp.msg);
            _this.prepend(el)
            el.show('.modal')
        }else{
            el.text("An error occured");
            console.error(resp)
        }
        $("html, body").scrollTop(0);
        end_loader()

    }
})
    });
});

</script>

</body>

</html>