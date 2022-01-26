<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Indicadores</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/lib/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/lib/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../public/lib/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/lib/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/lib/css/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../public/lib/css/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../public/lib/css/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../public/lib/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/lib/css/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../public/lib/css/bootstrap3-wysihtml5.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../public/lib/css/pace.min.css">
  <link rel="stylesheet" href="../public/main.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition fixed skin-purple sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IND</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>IND</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less 
    navbar navbar-expand-lg navbar-dark primary-color
    navbar navbar-static-top -->
    <nav class=" navbar navbar-expand-lg navbar-dark primary-color">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="../cerrarSesion.php">
              <i class="fa fa-sign-out"></i>
            </a>

          </li>
          <!-- Notifications: style can be found in dropdown.less -->

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li >
            <a href="#" >
              <?php
              //define('ruta',$_SERVER['DOCUMENT_ROOT']);
            
                include_once '../includes/session.php';
                include_once '../config/conexion.php';

                $session->login('Javier Pérez');
                $session->usuarioLogeado();
                $session->tipoUsuario('1');
                $session->periodo('20213');
                $session->area('ISC');
                  if(isset($_SESSION['user_id'])){

               ?>
              <span class="hidden-xs"><?php echo $_SESSION['user_id']  ?></span>
            <?php } ?>
            </a>

          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      
            <?php
                  echo '<ul class="sidebar-menu" data-widget="tree">
                  <li class="treeview">
                    <a href="#">
                      <i id="atr" class="fa  fa-chevron-right"></i>
                      <span>Proceso y producto &nbsp&nbsp&nbsp'.$_SESSION['area'].'</span>
                      <span class="pull-right-container">
                        <span class="label label-primary pull-right"></span>
                      </span>
                    </a>
                    <ul class="treeview-menu">';
                  echo '<li><a onclick="form(\''.'pda'.'/'.'rubros'.'.php\')" href="#"><i class="fa fa-clone"></i>rubros</a></li>';              
                  echo '<li><a onclick="form(\''.'pda'.'/'.'categoria'.'.php\')" href="#"><i class="fa fa-clone"></i>Categorías</a></li>';              
                  echo '<li><a onclick="form(\''.'pda'.'/'.'subcategoria'.'.php\')" href="#"><i class="fa fa-clone"></i>Subcategorias</a></li>';           
                  echo '<li><a onclick="form(\''.'pda'.'/'.'producto'.'.php\')" href="#"><i class="fa fa-clone"></i>Producto</a></li>';           
                  echo '<li><a onclick="form(\''.'pda'.'/'.'carga_horaria'.'.php\')" href="#"><i class="fa fa-folder-open"></i>Carga Horaria</a></li>';
                  echo '<li><a onclick="form(\''.'pda'.'/'.'asignacion_actividad'.'.php\')" href="#"><i class="fa fa-check-square-o"></i>Asignación Actividad</a></li>';           
                  echo '<li><a onclick="form(\''.'pda'.'/'.'evaluación'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Evaluación</a></li>';           
                  echo '<li><a onclick="form(\''.'pda'.'/'.'cierre_evaluacion'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Subcaterorias</a></li>';
                  echo '<li><a onclick="form(\''.'pda'.'/'.'entrega_evidencia'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Entrega de evidencias</a></li>';              
                  echo '<li><a onclick="form(\''.'pda'.'/'.'constancia_cumplimiento'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Constancia Cumplimiento</a></li>';
                  echo '<li><a onclick="form(\''.'pda'.'/'.'generar_pda_8'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Constancia Cumplimiento</a></li>';
                  
                

            ?>
              
          </ul>
          
        </li>
        </ul>
    </section>

   
    <!-- /.sidebar -->
  </aside>