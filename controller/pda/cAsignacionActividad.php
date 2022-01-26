<?php
 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mAsignacionActividad.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/mDocentes.php");

 /* Bloque de control para poder realizar la actualización de los registros */



/**      ******************** Pendiente*/ 
// if(isset($_REQUEST['sp_cargaH'])){
  // return add_carga($_REQUEST['cve_docente'], $_REQUEST['sp_cargaH']);
//}

function add_actividad($cve_docente, $cve_pr){

   return  mAddActividad($cve_docente, $cve_pr);

}

 function listar_producto(){
    return li_productos();
  }

  function listar_docentes(){
    return li_docentes();
    
  }


?>