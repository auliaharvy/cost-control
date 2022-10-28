<?php
echo $header;
echo link_tag('assets/plugins/iCheck/square/blue.css');
?>
<style type="text/css">
  .preloader {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: #b5b7b9;
    opacity: .8;
  }

  .preloader .loading {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    font: 14px arial;
  }
</style>
</head>

<body class="hold-transition login-page">
  <div class="preloader">
    <div class="loading">
      <img src="<?php echo base_url('assets/img/loadbar.gif'); ?>" width="70">
      <p>Harap Tunggu</p>
    </div>
  </div>
  <div class="login-box">
    <div class="col-md-12 offset-md-4 col-sm-12 offset-5">
      <img src="<?php echo base_url('assets/img/logo.png'); ?>" width="100" height="100">
    </div>
    <div class="login-logo">
      <a href=""><b>COST</b>CONTROL</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <form action="<?php echo base_url('Login/auth'); ?>" method="post">
        <div class="form-group has-feedback">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="username" class="form-control" placeholder="Username" name="username">
          </div>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="password">
          </div>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <!-- /.col -->
        <div class="col-xs-push-8 col-xs-4 text-center">
          <button type="submit" class="btn btn-info btn-circle">LOGIN</button>
        </div>
        <!-- /.col -->
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
      $(".preloader").fadeOut();
    });
  </script>
</body>

</html>