<?php
  /* Bloque de control programado por jair para residencia profecional  */
  $cat_clave = $_POST['cat_clave'];
  $titulo = $_POST['titulo'];
  $desc = ($_POST['desc']) ;
  $opcion = ($_POST['opcion']);
 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mCategoria.php");

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

