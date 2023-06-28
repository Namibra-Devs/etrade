<?php require_once('./config.php'); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eTrade || Sign Up</title>
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

    
    

</head>


<body>
    
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="index.php" class="site-logo"><img src="./assets/images/logo/logo.png" alt="logo"></a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="<?= base_url.'sign-in.php'?>" class="axil-btn btn-bg-secondary sign-up-btn">Sign In</a>
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
                        <h3 class="title">I'm New Here</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        <form method="post" id="cregister-frm" class="singin-form">
                        <div class="form-group">
                    <label>First Name</label>
                    <input name="firstname" type="text" class="form-control" value="Annie">
                </div>
                <div class="form-group">
                    <label>Middle Name</label>
                    <input name="middlename" type="text" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input name="lastname" type="text" class="form-control" value="Mario">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" value="annie@example.com">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control form-control-lg">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input name="contact" type="text" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input name="address" type="text" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" value="123456789">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input name="cpassword" type="password" class="form-control" value="123456789">
                </div>
                <div class="form-group">
                    <label>Upload Image</label>
                    <div class="custom-file">
                        <input style="padding-top: 15px;" type="file" class="custom-file-input" id="customFile" name="image" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg" required>
                        <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                        <div class="image-preview">
                        <img id="cimg"  src="<?= validate_image('') ?>" alt="Image Preview">
                    </div>
                        
                    </div>
                </div>
                
                            
                            <div class="form-group">
                                <button name="signup" type="submit" class="axil-btn btn-bg-primary submit-btn">Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

</div>

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
<script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?php echo base_url ?>dist/js/adminlte.min.js"></script> -->
<!-- Select2 -->
<script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
	        	$('#cimg').attr('src', '<?= validate_image('') ?>');
        }
	}
  $(function(){
    end_loader();
    $('body').height($(window).height())
    $('.select2').select2({
        placeholder:"Please Select Here",
        width:'100%'
    })
    $('.select2-selection').addClass("form-border")
    $('.pass_view').click(function(){
        var _el = $(this).closest('.input-group')
        var type = _el.find('input').attr('type')
        if(type == 'password'){
            _el.find('input').attr('type','text').focus()
            $(this).find('i.fa').removeClass('fa-eye-slash').addClass('fa-eye')
        }else{
            _el.find('input').attr('type','password').focus()
            $(this).find('i.fa').addClass('fa-eye-slash').removeClass('fa-eye')

        }
    })

    $('#cregister-frm').submit(function(e){
        e.preventDefault();
        var _this = $(this)
            $('.err-msg').remove();
        var el = $('<div>')
            el.addClass("alert err-msg")
            el.hide()
        if(_this[0].checkValidity() == false){
            _this[0].reportValidity();
            return false;
        }
        if($('#password').val() != $('#cpassword').val()){
            el.addClass('alert-danger').text('Password does not match.')
            _this.append(el)
            el.show('slow')
            $('html,body').scrollTop(0)
            return false;
        }
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Users.php?f=save_client",
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
                    location.href= './login.php';
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
    })
  })
</script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>