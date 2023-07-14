<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition">
    <script>
        start_loader()
    </script>
    <style>
        body {
            background-color: #ffffff;
            font-family: "DM Sans", sans-serif;
        }

        .form-control:focus{
            /* border-color: #57b357; */
        }

        .registration-form {
            max-width: 500px;  
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-top: 3px solid #007bff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .registration-form h154 {
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

        /* .text-center > a {
            color: #57b357;
        } */

        /* .btn.btn-primary{
            background-color:  var(--color-primary);
            border-color:  var(--color-primary);
        } */
    </style>
    </head>
    <div class="justify-content-center align-items-center flex-row h-100">
        <?
        //  echo $_SESSION['system_info']['cover'];
        ?>
        <?php
        //  var_dump( $_SESSION['system_info']) 
        ?>

        <!-- <center style="margin-top: 2rem;"><img width="" height="" src="<?= validate_image($_settings->info('title_logo')) ?>" alt="System Logo" class="" id="logo-img"></center> -->
        <center style="margin-top: 2rem;"><img width="300px" height="200px" src="../assets/images/bg/bg-image-15.png" alt="System Logo" class="" id="logo-img"></center>
        <!-- <div class="clear-fix my-2"></div> -->
        <div class="registration-form">
            <h1>Create a Seller Account</h1>
            <form id="vregister-frm" action="" method="post">
                <input type="hidden" name="id">
                <!-- Form fields -->
                <div class="form-group">
                    <label for="shop_name">Shop Name</label>
                    <input type="text" id="shop_name" autofocus name="shop_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shop_owner">Shop Owner Fullname</label>
                    <input type="text" id="shop_owner" name="shop_owner" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email Address</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label">Contact #</label>
                    <input type="text" id="contact" name="contact" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shop_type_id" class="control-label">Shop Type</label>
                    <select type="text" id="shop_type_id" name="shop_type_id" class="form-control" required>
                        <!-- <option value="" disabled selected></option> -->
                        <?php
                        $types = $conn->query("SELECT * FROM `shop_type_list` where delete_flag = 0 and `status` = 1 order by `name` asc ");
                        while ($row = $types->fetch_assoc()) :
                        ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i class="fa fa-eye-slash"></i></a>
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
                                <a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i class="fa fa-eye-slash"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
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

                <!-- <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div> -->

                <!-- End of form fields -->

                <div class="form-group">
                    <!-- <button type="submit" class="btn btn-primary">Create Account</button> -->
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
                <div class="text-center">
                    <a href="<?= base_url ?>">Back to Site</a> |
                    <a href="<?= base_url . 'vendor/login.php' ?>">Already have an Account</a>
                    <!-- <a href="#">Back to Site</a> |
                    <a href="#">Already have an Account</a> -->
                </div>
            </form>
        </div>


        <!-- jQuery -->
        <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <!-- <script src="<?php echo base_url ?>dist/js/adminlte.min.js"></script> -->
        <!-- Select2 -->
        <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

        <script>
            // var base_url = "<?= base_url ?>"
            function displayImg(input, _this) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#cimg').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#cimg').attr('src', '<?= validate_image('') ?>');
                }
            }
            $(function() {
                end_loader();
                $('body').height($(window).height())
                $('.select2').select2({
                    placeholder: "Please Select Here",
                    width: '100%'
                })
                $('.select2-selection').addClass("form-border")
                $('.pass_view').click(function() {
                    var _el = $(this).closest('.input-group')
                    var type = _el.find('input').attr('type')
                    if (type == 'password') {
                        _el.find('input').attr('type', 'text').focus()
                        $(this).find('i.fa').removeClass('fa-eye-slash').addClass('fa-eye')
                    } else {
                        _el.find('input').attr('type', 'password').focus()
                        $(this).find('i.fa').addClass('fa-eye-slash').removeClass('fa-eye')

                    }
                })

                $('#vregister-frm').submit(function(e) {
                    e.preventDefault();
                    var _this = $(this)
                    $('.err-msg').remove();
                    var el = $('<div>')
                    el.addClass("alert err-msg")
                    el.hide()
                    if (_this[0].checkValidity() == false) {
                        _this[0].reportValidity();
                        return false;
                    }
                    if ($('#password').val() != $('#cpassword').val()) {
                        el.addClass('alert-danger').text('Password does not match.')
                        _this.append(el)
                        el.show('slow')
                        $('html,body').scrollTop(0)
                        return false;
                    }
                    start_loader();
                    $.ajax({
                        url: _base_url_ + "classes/Users.php?f=save_vendor",
                        data: new FormData($(this)[0]),
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: 'POST',
                        type: 'POST',
                        dataType: 'json',
                        error: err => {
                            console.error(err);
                            el.addClass('alert-danger').text("An error occured");
                            _this.prepend(el)
                            el.show('.modal')
                            end_loader();
                        },
                        success: function(resp) {
                            if (typeof resp == 'object' && resp.status == 'success') {
                                // location.href = './login.php';
                                location.href = _base_url_ + "waitlist.php";
                            } else if (resp.status == 'failed' && !!resp.msg) {
                                el.addClass('alert-danger').text(resp.msg);
                                _this.prepend(el)
                                el.show('.modal')
                            } else {
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
</body>

</html>