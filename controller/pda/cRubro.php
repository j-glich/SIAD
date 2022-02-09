<?php

 require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/pda/mRubro.php");
 /* Bloque de control para poder realizar la actualización de los registros */
if(isset($_REQUEST['titulo'])){
  up_rubro($_REQUEST['rb_clave'], $_REQUEST['titulo'], $_REQUEST['desc']);
}

/**      ******************** */ 
 function listar_rubros(){
    return li_rubros();
  }
  function up_rubro($clave, $titulo, $desc){
    mUpRubro($clave, $titulo, $desc);

  }
  function del_rubro($rb_cve){
    mDelRubro($rb_cve, '', '');
  }
  function listar_rubro($rb_cve){
    return liRubroXClave($rb_cve);
  }
?>



