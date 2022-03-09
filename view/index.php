<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
  //include('../config/routes.php');

  include_once '../includes/session.php';
  include_once '../includes/functions.php';

 if($session->usuarioLogeado()=="") {
  redirect("../login.php",false);
  }else{ 
    include("header.php");
    //require_once('layouts/header.php');
$carga = (isset($_GET['sp_registro'])) ? $_GET['sp_registro'] : '0';
$sp_Carga_Cat = (isset($_GET['sp_ex_cat'])) ? $_GET['sp_ex_cat'] : null;
$sp_horas = (isset($_GET['sp_carga_horas'])) ? $_GET['sp_carga_horas'] : null;
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
}
 ?>


<script>
var carga_exito = <?php echo $carga ; ?>;
var sp_Carga_cat = "<?php echo $sp_Carga_Cat ; ?>";
var sp_horas ="<?php echo $sp_horas ; ?>";
if(carga_exito == 1){
  form('pda/asignacion_actividadc.php?sp_Carga_Cat='+sp_Carga_cat +"&sp_horas=" +sp_horas);
}else if(carga_exito ==2){
  form('pda/carga_horaria2.php');
}
</script>
