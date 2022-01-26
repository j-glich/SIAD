<?php
include_once 'includes/load.php';
include_once 'includes/session.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CIMA | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/lib/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/lib/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/lib/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/lib/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="public/lib/css/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="public/lib/css/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="public/lib/css/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="public/lib/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="public/lib/css/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="public/lib/css/bootstrap3-wysihtml5.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="public/lib/css/pace.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>CIMA</b> <span class="glyphicon glyphicon-cloud"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión aquí</p>
    <div class="box-body">

    <?php if (isset($_GET['e'])) {?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
        Error con la conexión al servidor verifica tu conexión...
      </div>
   <?php } echo display_msg($msg); ?>
    </div>
    <form action="validarLogin.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nombreUsuario" placeholder="Usuario" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="contrasenaUsuario" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery/jquery.min.js"></script-->
<!-- jQuery 3 -->
<script
  src="public/lib/js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="public/lib/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="public/lib/js/icheck.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="public/lib/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="public/lib/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="public/lib/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="public/lib/js/demo.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
