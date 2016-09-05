<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= APP_NAME ?> | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= bower('bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= bower('font-awesome/css/font-awesome.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= assets('css/AdminLTE.min.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a>PETRON <b><?= APP_NAME ?></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="<?= base_url('login') ?>" method="post" id="login-form">
          <div class="alert alert-danger" id="errors" hidden>
          </div>
          <div class="form-group has-feedback">
            <input type="username" class="form-control" placeholder="Username" name="login_username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="login_password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </form>
        <hr>
        <a href="#">I forgot my password</a><br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= bower('jquery/dist/jquery.min.js')?>"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#login-form').submit(function(e){
          e.preventDefault();
          
          var $this = $(this);

          $('[type=submit]').addClass('disabled');

          $.post($this.attr('action'), $this.serialize())
          .done(function(response){
            if(response.result){
              window.location.replace('<?= base_url('home')?>');
            }else{
                $('#errors').removeAttr('hidden').html('<ul class="list-unstyled"><li>'+response.errors.join('</li><li>')+'</li></ul>');
            }
          })
          .fail(function(){
            alert('An internal error has occured! Please try again!');
          })
          .always(function(){
            $('[type=submit]').removeClass('disabled');
          })
        });

      })
    </script>
  </body>
</html>
