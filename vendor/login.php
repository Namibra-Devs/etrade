<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
         <center style="margin-top: 2rem;"><img width="300px" height="200px" src="../assets/images/bg/bg-image-15.png" alt="System Logo" class="" id="logo-img"></center>
  <div class="login-box">

    <?php if ($_settings->chk_flashdata('success')) : ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
      </script>
    <?php endif; ?>

    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="./login.php" class="h1"><b>Vendor Login</b></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form id="vlogin-frm" action="" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="username" autofocus placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6">
                <a href="<?= base_url ?>">Back to Site</a>
              </div>
              <div class="col-6 text-right">
                <a href="<?=base_url.'forgot-password.php?ref=2'?>">Forgot Password?</a>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12 text-center">
                <span>Don't have an account? </span><a href="<?= base_url . 'vendor/register.php' ?>">Create an Account</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script>
      $(function() {
        end_loader();
        $('#vlogin-frm').submit(function(e) {
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
          start_loader();
          $.ajax({
            url: _base_url_ + "classes/Login.php?f=login_vendor",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
              console.error(err)
              el.addClass('alert-danger').text("An error occurred");
              _this.prepend(el)
              el.show('.modal')
              end_loader();
            },
            success: function(resp) {
              if (typeof resp == 'object' && resp.status == 'success') {
                location.href = './login.php';
              } else if (resp.status == 'failed' && !!resp.msg) {
                el.addClass('alert-danger').text(resp.msg);
                _this.prepend(el)
                el.show('.modal')
              } else {
                el.text("An error occurred");
                console.error(resp)
              }
              $("html, body").scrollTop(0);
              end_loader()
            }
          })
        })
      })
    </script>
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
       
            location.reload()
            // console.log(resp.msg);
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