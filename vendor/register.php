<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
 <?php require_once('../config.php') ?>
 <body class="hold-transition">
  <script>
    start_loader()
  </script>
    <style>
        body {
            background-color: #fff;
        }
        .registration-form {
            max-width: 500px;
            margin: 20px auto; 
            padding: 20px;
            background-color: #fff;
            border-top: 3px solid blue;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .registration-form h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        .registration-form .form-control {
            border-radius: 0;
        }
        .registration-form .btn-primary {
            border-radius: 0;
            width: 100%;
        }
       
        #cimg {
            max-width: 100%;
            height: auto;
            margin: 10px 0; 
            background-color: #fff; 
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<div class="justify-content-center align-items-center flex-row h-100">
    <center style="margin-top: 2rem;"><img width="50px" height="50px" src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo" class="img-thumbnail rounded-circle" id="logo-img"></center>
  <!-- <div class="clear-fix my-2"></div> -->
    <div class="registration-form">
        <h1>Create a Seller Account</h1>
        <form id="vregister-frm" action="" method="post">
            <!-- Form fields -->
            <div class="form-group">
                <label for="shop_name">Shop Name</label>
                <input type="text" id="shop_name" autofocus name="shop_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="shop_owner">Shop Owner Fullname</label>
                <input type="text" id="shop_owner" name="shop_owner" class="form-control" required>
            </div>
            <!-- Add more form fields as needed -->

            <!-- Additional styling enhancements -->
            <div class="form-group">
                <label for="logo" class="control-label">Shop Logo</label>
                <div class="custom-file">
                    <input type="file" id="logo" name="img" class="custom-file-input" onchange="displayImg(this, $(this))" accept="image/png, image/jpeg" required>
                    <label class="custom-file-label" for="logo">Choose file</label>
                </div>
                <small class="form-text text-muted">Accepted file types: PNG, JPEG</small>
                <div class="mt-2">
                    <img src="<?= validate_image('') ?>" alt="Shop Logo" id="cimg" class="img-thumbnail">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" id="password" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <div class="input-group">
                    <input type="password" id="cpassword" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!-- End of form fields -->

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
            <div class="text-center">
                <a href="<?= base_url ?>">Back to Site</a> | 
                <a href="<?= base_url.'vendor/login.php' ?>">Already have an Account</a>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script>
        // Add your JavaScript code here
        $(function() {
            // Password visibility toggle
            $('.fa-eye-slash').click(function() {
                var input = $(this).closest('.input-group').find('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    input.attr('type', 'password');
                    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });

            // File input styling
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });

            // Form submission
            $('#vregister-frm').submit(function(e) {
                e.preventDefault();
                // Add your form submission logic here
            });
        });

        function displayImg(input, _this) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#cimg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#cimg').attr('src', '<?= validate_image('') ?>');
            }
        }
    </script>
</body>
</html>
