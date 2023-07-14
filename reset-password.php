<?php require_once('./config.php'); ?>
<?php
$redirectUrl = "forgot-password.php";
if(isset($_GET["token"])){
    $token = $_GET['token'];
    $type = $_GET['type'];
$is_valid_token = false;


$stmt = $conn->prepare("SELECT email, expiration_timestamp FROM password_reset WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
$resetData = $result->fetch_assoc();

if ($resetData) {
    $email = $resetData['email'];
    $expirationTimestamp = $resetData['expiration_timestamp'];

    // Verify if the token is still valid (not expired)
    if (time() <= $expirationTimestamp) {
        // Token is valid, display the password reset form
         $is_valid_token = true;
    } else {
        // Token has expired
        echo '<script>alert("The password reset link has expired. Please request a new one.");</script>';
        echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
        // echo "The password reset link has expired. Please request a new one.";
    }
} else {
    // Token is not valid
    echo '<script>alert("Invalid password reset link.");</script>';
    echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
    
    // echo "Invalid password reset link.";
}

}else{
    echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
    
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ITP || Reset Password</title>
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
                    <!-- <a href="forgot-password.php" class="back-btn"><i class="far fa-angle-left"></i></a> -->
                </div>
                <div class="col-xl-6 col-lg-4 col-sm-6">
                    <div class="singin-header-btn">
                        <p>Already a member? <a href="sign-in.php" class="sign-in-btn">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    <h2 class="title">We Offer the Best Products</h2>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                <?php if (isset($_GET["token"]) && $is_valid_token) : ?>
 
    
                    <div class="axil-signin-form">
                        <h3 class="title mb--35">Reset Password</h3>
                        <form id="reset-form" class="singin-form">
                        <input type="hidden" name="type" id="type" value="<?=$type?>">
                        <input type='hidden' name='token' value='<?= $token ?>'>
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" value="123456789">
                            </div>
                            <div class="form-group">
                                <label>Confirm password</label>
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" value="123456789">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
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

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>


    <script>


$(document).ready(function(){
    $('#reset-form').on('submit', function(e){
        e.preventDefault();
        var _this = $(this)
          $('.err-msg').remove();
          var el = $('<div>')
          el.addClass("alert err-msg")
          el.hide()
        // var email = $('#email').val();
        if ($('#new_password').val() != $('#confirm_password').val()) {
                    el.addClass('alert-danger').text('Password does not match.')
                    _this.append(el)
                    el.show('slow')
                    $('html,body').scrollTop(0)
                    return false;
                }
        $.ajax({
    url:_base_url_+"classes/Users.php?f=reset_password",
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
            var token = "<?=$_GET['type']?>";
            token == "1" ? window.location.href = "sign-in.php" : window.location.href = _base_url_+"vendor/login.php";
            // window.location.href = "sign-in.php";
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

</body>

</html>