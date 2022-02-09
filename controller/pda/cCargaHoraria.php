<?php
 define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/pda/mSubcategoria.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/mDocentes.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/pda/mCargaHoraria.php"); 

/**      ******************** */ 

function add_carga($cve_docente, $cargaH){
   return mAddCarga($cve_docente, $cargaH);
}

 function listar_subcategoria(){
    return li_categorias();
  }

  function listar_docentes(){
    return li_docentes();
  }


?>