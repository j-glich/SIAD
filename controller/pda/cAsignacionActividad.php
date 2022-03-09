<?php
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';
if($opcion == 1){
  $carga = $_POST['sp_cargaH'];
  $clave_docente = $_POST['clv_docente'];
}
if($opcion == 2){
  $cve_subcat = $_POST['cve_subcat'];
  $id_producto = $_POST['id_producto'];
  $hrs_producto = $_POST['hrs_producto'];
  $desc_producto = $_POST['desc_producto'];
  $dias_entrega = $_POST['dias_entrega'];
  $evidencia = $_POST['evidencia'];
}

 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/pda/mAsignacionActividad.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/mDocentes.php");

 /* Bloque de control para poder realizar la actualización de los registros */



/**      ******************** Pendiente*/ 
// if(isset($_REQUEST['sp_cargaH'])){
  // return add_carga($_REQUEST['cve_docente'], $_REQUEST['sp_cargaH']);
//}

function add_actividad($cve_docente, $cve_pr){

   return  mAddActividad($cve_docente, $cve_pr);

}

 function listar_producto($clave){
    return liProductoXClave($clave);
  }

  function listar_docentes(){
    return li_docentes();
    
  }


?>