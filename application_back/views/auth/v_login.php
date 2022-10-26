<?php 
  echo $header; 
  echo link_tag('assets/plugins/iCheck/square/blue.css');
?>
<style type="text/css">
     body{
            background:#efefef url('<?php echo base_url('assets/img/darkbluee.jpg');?>');
            background-repeat: repeat;
            background-position: center;
            background-size: 150%;
           font-family: arial;
        }
       
        
        .box{
            width: 50px;height:450px;border-top: transparent;
           /* -webkit-border-radius: 10px;
            -moz-border-radius: 10px;*/
        }
        @media only screen and (max-width : 1130px) {
            /*body{
                background:#efefef url('{{ asset('assets/img/bg-login.png') }}');

            }
            img {
                margin: 0 auto;
                width: 80%;
            }*/
            
            .box{
                width: 45%;height:50%;
            }
        }
        @media only screen and (max-width : 1000px) {
            /*body{
                background:#efefef url('{{ asset('assets/img/bg-login.png') }}');

            }
            img {
                margin: 0 auto;
                width: 80%;
            }*/
            
            .box{
                width: 65%;height:53%;
            }
        }
        @media only screen and (max-width : 880px) {
            /*body{
                background:#efefef url('{{ asset('assets/img/bg-login.png') }}');

            }
            img {
                margin: 0 auto;
                width: 80%;
            }*/
            body{
              
              position: absolute;
            }
            .box{
                width: 140%;height:140%;
            }
        }
        @media only screen and (max-width : 760px) {
            /*body{
                background:#efefef url('{{ asset('assets/img/bg-login.png') }}');

            }
            img {
                margin: 0 auto;
                width: 80%;
            }*/
            body{
              
              position: absolute;
            }
            .box{
                width: 120%;height:120%;
            }
        }
        @media only screen and (max-width : 668px) {
            /*body{
                background:#efefef url('{{ asset('assets/img/bg-login.png') }}');

            }
            img {
                margin: 0 auto;
                width: 80%;
            }*/
            body{
             
              position: absolute;
            }
            .box{
                width: 100%;height:100%;
            }
        }
        @media only screen and (max-width : 568px) {
            /*body{
                background:#efefef url('{{ asset('assets/img/bg-login.png') }}');

            }
            img {
                margin: 0 auto;
                width: 80%;
            }*/
            body{
              
              position: absolute;
            }
            .box{
                width: 110%;height:110%;
            }
        }
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
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
    
    </style>
</head>
<body>
  <div class="preloader">
        <div class="loading">
          <!--<img src="<?php echo base_url('assets/img/logo.jpg');?>" width="100"><br>-->
        <img src="<?php echo base_url('assets/img/loadbar.gif');?>" width="70">
        <p>Harap Tunggu</p>
      </div>
      </div>
    <div class="col-md-12 col-md-offset-2 col-sm-offset-3 col-xs-offset-1 row" style="margin-bottom: 5px;margin-top: 105px;margin-right: 55px;">
      <div class="col-md-6 box clearfix" style="background-color:white;">
                <br>
                <div class="login-logo" style="margin-bottom: 5px;">
                  
                    <img src="<?php echo base_url('assets/img/logo.png');?>" width="130px">
                    <br>
                    <br>
                    <div class="col-md-8 col-md-offset-2">
                        <p style="font-size:14px;">Scan the QR code to download the app from google playstore</p>
                    </div>
                    
                </div>
                <div>
                   
                </div>
                <p style="font-size:10px;text-align: center">Latest Version 1.3.7</p>
            </div>    
      <div class="col-md-6 box clearfix" style="background-color:grey;">  
                <br>
                <p style="font-size:16px;text-align: center;color: white">PT Akkarya Jaya</p>
                <div class="col-md-10 col-md-offset-1">
                    <h3 style="color:white;">LOGIN</h3>
                    <form id="form-login" role="form" method="POST" action="<?php echo base_url('Login/auth');?>">
                    
                    <div class="form-group has-feedback">
                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
                    <div class="row" style="padding: 0">
                      <div class="col-xs-12 col-md-12 col-sm-12 col-md-offset-0 col-xs-offset-0 row">
                        <button type="submit" class="btn btn-danger btn-block btn-flat" style="font-weight: bold;">LOGIN</button>
                      </div>
                      <br>
                    </div>
                    <br><br>
                    <div class="row" style="text-align: center;">
                      <br><br>
                      <a href="#"> <p style="font-size:16px;text-align: center;color: white">Forgot Password?</p></a>
                    </div>
                    <br>
                  </form>
                </div>
      </div>
    </div>
      
  </body>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    $(".preloader").fadeOut();

    $('#form-login').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Email field is required.'
                        },
                        
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password field is required.'
                        }                       
                    }
                }                                                     
            }
        }).on('success.form.bv', function (e) {
                $('#success_message').slideDown({opacity: "show"}, "slow");
                $('#form-login').data('bootstrapValidator').resetForm();
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    console.log(result);
                }, 'json');
            });

  });
</script>
</body>
</html>
