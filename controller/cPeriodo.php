<?php
 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/mPeriodo.php");

 function listar_periodos(){
    return li_periodos();
  }

?>