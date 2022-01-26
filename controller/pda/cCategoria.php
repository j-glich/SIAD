<?php
 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mCategoria.php");


 /* Bloque de control para poder realizar la actualización de los registros */


//if(isset($_REQUEST['rb_clave'])&&isset($_REQUEST['titulo'])&&isset($_REQUEST['desc'])){
if(isset($_REQUEST['actualizar'])){
  echo "si lo hace";
  up_categoria($_REQUEST['cat_clave'], $_REQUEST['titulo'], $_REQUEST['desc']);

}

/**      ******************** */ 


 function listar_categorias(){
    return li_categorias();
  }

  function up_categoria($clave, $titulo, $desc){
    mUpCategoria($clave, $titulo, $desc);

  }


  function del_categoria($cat_cve){
    mDelCategoria($cat_cve, '', '');
  }

  function listar_categoria($cat_cve){
    return liCategoriaXClave($cat_cve);
  }
?>