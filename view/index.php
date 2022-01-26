<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
  //include('../config/routes.php');

  include_once '../includes/session.php';
  include_once '../includes/functions.php';

 // if($session->usuarioLogeado()=="") {
   // redirect("../login.php",false);
  //}else{ 
    include("header.php");
    //require_once('layouts/header.php');

//header('Location: view/index.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <section id="alerta">
    </section>
  </section>

    <!-- Main content -->
    <section class="content">
      <div id="area">

      </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php  require_once ("footer.php");
//}
 ?>


</script>
