<?php 
try {
  require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/config/newcnx.php");
} catch (\Exception $e) {
  require_once("../config/newcnx.php");
}
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$rb_clave = $_POST['rb_clave'];
$titulo = $_POST['titulo'];
$desc = ($_POST['desc']) ;
$opcion = ($_POST['opcion']);
require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/models/pda/moRubro.php");
?>